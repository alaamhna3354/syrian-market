<?php

namespace App\Http\Controllers\User;

use App\Helper\GoogleAuthenticator;
use App\Http\Controllers\Controller;
use App\Http\Traits\Notify;
use App\Http\Traits\Upload;
use App\Models\Country;
use App\Models\CountryService;
use App\Models\Coupon;
use App\Models\Fund;
use App\Models\Gateway;
use App\Models\Language;
use App\Models\SendingPurpose;
use App\Models\SendMoney;
use App\Models\SourceFund;
use App\Models\Template;
use App\Models\Ticket;
use App\Models\Transaction;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Stevebauman\Purify\Facades\Purify;
use Facades\App\Services\BasicService;

use hisorange\BrowserDetect\Parser as Browser;

class HomeController extends Controller
{
    use Upload, Notify;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
        $this->theme = template();
    }

    public function calculation(Request $request)
    {

        $this->validate($request, [
            'amount' => 'required|numeric',
            'sendCountry' => 'required|numeric',
            'getCountry' => 'required|numeric',
            'country_service' => 'required|numeric', // serviceId
            'payout_network' => 'required', //
            'sendReceive' => ['required', Rule::in(["send", "receive"])],
        ], [
            'sendCountry.required' => "Sender country is required",
            'getCountry.required' => "Please select a currency to receive",
            'country_service.required' => "Service is required",
            'payout_network.required' => "Provider must be required",
            'amount.required' => "Enter Amount",
        ]);


        $country = Country::select('id', 'name', 'slug', 'code', 'minimum_amount', 'rate', 'facilities', 'image')->whereIn('id', [$request->sendCountry, $request->getCountry])->where('status', 1)->get();
        if ($request->has('sendCountry')) {
            $sendCountry = $country->where('id', $request->sendCountry)->first();
            if (!$sendCountry) {
                session()->flash('error', 'Sender Country Not Found');
                return back()->withInput();
            }

           if($request->amount < $sendCountry->minimum_amount ){
               session()->flash('error', 'Minimum amount '.getAmount($sendCountry->minimum_amount,config('basic.fraction_number')). " ".$sendCountry->code);
               return back()->withInput();
           }
        }

        if ($request->has('getCountry')) {
            $receiveCountry = $country->where('id', $request->getCountry)->first();
            if (!$receiveCountry) {
                session()->flash('error', 'Receiver Country Not Found');
                return back()->withInput();
            }
            if (!$receiveCountry->facilities) {
                session()->flash('error', 'Receiver Country Service Not Available');
                return back()->withInput();
            }
            $receiveCountryFacilities = collect($receiveCountry->facilities)->where('id', $request->country_service)->first();
            if (!$receiveCountryFacilities) {
                session()->flash('error', 'Receiver Country Service Not Available');
                return back()->withInput();
            }


            $provider = CountryService::tobase()->where([
                'id' => $request->payout_network,
                'country_id' => $receiveCountry->id,
                'service_id' => $receiveCountryFacilities->id,
                'status' => 1
            ])->first();

            if (!$provider) {
                session()->flash('error', 'Provider must be required');
                return back()->withInput();
            }
        }


        $amount = $request->amount;
        $rate = $receiveCountry['rate'] / $sendCountry['rate'];


        $data['rate'] = round($rate, config('basic.fraction_number'));

        $data['send_currency'] = $sendCountry['code'];
        $data['receive_currency'] = $receiveCountry['code'];

        if ($request->sendReceive == "send") {
            $data['send_amount'] = $amount;
            $data['fees'] = round(getCharge($amount, $receiveCountry->id, $receiveCountryFacilities->id), 2);
            $data['total_payable'] = round($amount + $data['fees'], config('basic.fraction_number'));
            $data['recipient_get'] = round($amount * $rate, 2);
        }

        if ($request->sendReceive == "receive") {
            $data['send_amount'] = round($amount / $rate, 2);
            $data['fees'] = round(getCharge($amount, $receiveCountry->id, $receiveCountryFacilities->id) / $rate, 2);
            $data['total_payable'] = round(($amount / $rate) + $data['fees'], config('basic.fraction_number'));
            $data['recipient_get'] = round($amount, 2);
        }

        $invoice = invoice();


        $sendMoney = new  SendMoney();
        $sendMoney->invoice = $invoice;
        $sendMoney->user_id = $this->user->id;
        $sendMoney->send_currency_id = $sendCountry['id'];
        $sendMoney->receive_currency_id = $receiveCountry['id'];
        $sendMoney->service_id = $receiveCountryFacilities->id;
        $sendMoney->country_service_id = $provider->id;
        $sendMoney->send_curr_rate = $sendCountry['rate'];
        $sendMoney->send_curr = $sendCountry['code'];
        $sendMoney->receive_curr = $receiveCountry['code'];
        $sendMoney->rate = $rate;
        $sendMoney->send_amount = $data['send_amount'];
        $sendMoney->fees = $data['fees'];
        $sendMoney->payable_amount = $data['total_payable'];
        $sendMoney->recipient_get_amount = $data['recipient_get'];
        $sendMoney->save();

        return redirect()->route('user.sendMoney', $sendMoney);
    }

    public function sendMoney(SendMoney $sendMoney)
    {
        $user = $this->user;
        if ($sendMoney->user_id != $user->id) {
            abort(401);
        }
        if ($sendMoney->status != '0') {
            session()->flash('error', 'You are not eligible to change request.');
            return redirect()->route('user.transfer-log');
        }

        $data['page_title'] = "RECIPIENT DETAILS";
        $data['sendMoney'] = $sendMoney;
        $data['sourceFunds'] = SourceFund::select('title')->get();
        $data['sendingPurpose'] = SendingPurpose::select('title')->get();
        return view($this->theme . 'user.operation.recipient-form', $data);
    }

    public function sendMoneyFormData(SendMoney $sendMoney, Request $request)
    {

        $user = $this->user;
        if ($sendMoney->user_id != $user->id) {
            abort(401);
        }

        if ($sendMoney->status != '0') {
            session()->flash('error', 'You are not eligible to change request.');
            return redirect()->route('user.transfer-log');
        }

        $rules = [];
        $rules['recipient_name'] = ['required', 'max:91'];
        $rules['recipient_contact_no'] = ['required', 'max:20'];
        $rules['recipient_email'] = ['required', 'email', 'max:30'];
        $rules['fund_source'] = ['required', 'max:255'];
        $rules['purpose'] = ['required', 'max:255'];
        $rules['promo_code'] = ['nullable', 'numeric'];
        $inputField = [];
        if (optional($sendMoney->provider)->services_form) {
            foreach ($sendMoney->provider->services_form as $key => $cus) {
                $rules[$key] = [$cus->validation];
                if ($cus->type == 'file') {
                    array_push($rules[$key], trim($cus->validation));
                    array_push($rules[$key], 'max:' . trim($cus->field_length));
                }
                if ($cus->type == 'text') {
                    array_push($rules[$key], trim($cus->validation));
                    if ($cus->length_type == 'max') {
                        array_push($rules[$key], 'max:' . trim($cus->field_length));
                    } elseif ($cus->length_type == 'digits') {
                        array_push($rules[$key], 'digits:' . trim($cus->field_length));
                    }
                }
                if ($cus->type == 'textarea') {
                    array_push($rules[$key], trim($cus->validation));
                    array_push($rules[$key], 'max:' . trim($cus->field_length));
                }
                $inputField[] = $key;
            }
        }


        $this->validate($request, $rules);
        $user = $this->user;


        $req = Purify::clean($request->all());
        $req = (object)$req;


        $path = config('location.send_money.path') . date('Y') . '/' . date('m') . '/' . date('d');
        $collection = collect($req);
        $reqField = [];
        if (optional($sendMoney->provider)->services_form) {
            foreach ($collection as $k => $v) {

                foreach (optional($sendMoney->provider)->services_form as $inKey => $inVal) {
                    if ($k != $inKey) {
                        continue;
                    } else {

                        if ($inVal->type == 'file') {
                            if ($request->hasFile($inKey)) {
                                try {
                                    $reqField[$inKey] = [
                                        'field_name' => $this->uploadImage($request[$inKey], $path),
                                        'file_location' => $path,
                                        'type' => $inVal->type,
                                    ];
                                } catch (\Exception $exp) {
                                    session()->flash('error', 'Could not upload your ' . $inKey);
                                    return back()->withInput();
                                }
                            }
                        } else {
                            $reqField[$inKey] = $v;
                            $reqField[$inKey] = [
                                'field_name' => $v,
                                'type' => $inVal->type,
                            ];
                        }
                    }
                }
            }
            $sendMoney['user_information'] = $reqField;
        } else {
            $sendMoney['user_information'] = null;
        }
        $sendMoney->recipient_contact_no = $req->recipient_contact_no;
        $sendMoney->recipient_email = $req->recipient_email;
        $sendMoney->fund_source = $req->fund_source;
        $sendMoney->purpose = $req->purpose;


        if ($request->promo_code != null) {
            $coupon = Coupon::where('code', trim($request->promo_code))->whereNull('user_id')->first();
            if (!$coupon) {
                session()->flash('error', 'Invalid promo code');
                return back()->withInput();
            }
            if ($sendMoney->promo_code == null) {
                $sendMoney->discount = ($sendMoney->payable_amount * $coupon->reduce_fee) / 100;
                $sendMoney->promo_code = $coupon->code;

                $coupon->user_id = $user->id;
                $coupon->used_at = Carbon::now();
                $coupon->update();
            }
        }


        $sendMoney->status = 2; //Draft
        $sendMoney->save();


        session()->put('invoice', $sendMoney->invoice);
        return redirect()->route('user.addFund');
    }

    public function sendMoneyAction(SendMoney $sendMoney, $actionType)
    {
        if(!in_array(strtolower($actionType),['fillup','payment','details'])){abort(404);}
        $user = $this->user;
        if ($sendMoney->user_id != $user->id) {
            abort(401);
        }
        if($sendMoney->status == 0 && $sendMoney->payment_status == 0 &&  $actionType == "fillup"){
            return redirect()->route('user.sendMoney',$sendMoney);
        }else if($sendMoney->status == 2 && $sendMoney->payment_status == 0 &&  $actionType == "payment"){
            session()->put('invoice', $sendMoney->invoice);
            return redirect()->route('user.addFund');
        }else if($sendMoney->status != 0 && $actionType == "details"){


            $templateSection = ['contact-us'];
            $contactUs = Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name');

            $contactUs = $contactUs['contact-us'][0];

            $data['contact'] = [
                'email'=>$contactUs->description->email,
                'phone'=>$contactUs->description->phone,
                'address'=>$contactUs->description->address
            ];


            $status = '';
            if($sendMoney->status == 0 && $sendMoney->payment_status == 0){
                $status = 'Information Need';
            }elseif($sendMoney->status == 2 && $sendMoney->payment_status == 0){
                $status = 'Sender Not Pay Yet';
            }
            elseif($sendMoney->status == 3 || $sendMoney->payment_status == 2){
                $status = 'Cancelled';
            }elseif($sendMoney->status == 1 && $sendMoney->payment_status == 1){
                $status = 'Completed';
            }
            elseif($sendMoney->status == 2 && $sendMoney->payment_status == 1){
                $status = 'Processing';
            }elseif($sendMoney->status == 2 && $sendMoney->payment_status == 3){
                $status = 'Payment Hold';
            }

            $data['invoice'] = [
                'Transaction' => $sendMoney->invoice,
                'Status' => $status,
                'TransactionDate' => ($sendMoney->paid_at)? dateTime($sendMoney->paid_at) : dateTime($sendMoney->created_at),
                'Service' => optional($sendMoney->service)->name,
                'ServiceProvider' => optional($sendMoney->provider)->name,
                'SendAmount' => getAmount($sendMoney->send_amount, config('basic.fraction_number')).' '.$sendMoney->send_curr,
                'Fees' => getAmount($sendMoney->fees, config('basic.fraction_number')).' '.$sendMoney->send_curr,
                'discountYes' => $sendMoney->discount,
                'Discount' => getAmount($sendMoney->discount, config('basic.fraction_number')).' '.$sendMoney->send_curr,
                'TotalSendAmount' => getAmount($sendMoney->totalPay, config('basic.fraction_number')).' '.$sendMoney->send_curr,
                'RecipientAmount' => getAmount($sendMoney->recipient_get_amount, config('basic.fraction_number')).' '.$sendMoney->receive_curr,
                'Rate' => '1 '.$sendMoney->send_curr. ' = '.getAmount($sendMoney->rate, config('basic.fraction_number')). ' '.$sendMoney->receive_curr,

                'Sender' => [
                    'Name' =>optional($sendMoney->user)->fullname,
                    'Phone' =>optional($sendMoney->user)->phone,
                    'Address' =>optional($sendMoney->user)->address,
                ],
                'FundingSource'=>$sendMoney->fund_source,
                'SendingPurpose'=>$sendMoney->purpose,

                'Recipient' => [
                    'Name' =>$sendMoney->recipient_name,
                    'Email' =>$sendMoney->recipient_email,
                    'Phone' =>$sendMoney->recipient_contact_no,
                ]
            ];




            $pdf = PDF::loadView($this->theme .'layouts.invoice', $data);
            return $pdf->stream('invoice.pdf');
        }else if ($sendMoney->status == '0') {
            session()->flash('error', 'You are not eligible to action this request.');
            return redirect()->route('user.transfer-log');
        }
        abort(404);

    }

    public function transferLog()
    {
        $user = $this->user;
        $data['page_title'] = "TRANSFER LOG";
        $data['sendMoneys'] = SendMoney::where('user_id', $user->id)->latest()->paginate(config('basic.paginate'));
        return view($this->theme . 'user.operation.transferLog', $data);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('user.transfer-log');
    }


    public function transaction()
    {
        $transactions = $this->user->transaction()->orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view($this->theme . 'user.transaction.index', compact('transactions'));
    }

    public function transactionSearch(Request $request)
    {
        $search = $request->all();
        $dateSearch = $request->datetrx;
        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);
        $transaction = Transaction::where('user_id', $this->user->id)->with('user')
            ->when(@$search['transaction_id'], function ($query) use ($search) {
                return $query->where('trx_id', 'LIKE', "%{$search['transaction_id']}%");
            })

            ->when(@$search['remark'], function ($query) use ($search) {
                return $query->where('remarks', 'LIKE', "%{$search['remark']}%");
            })
            ->when($date == 1, function ($query) use ($dateSearch) {
                return $query->whereDate("created_at", $dateSearch);
            })
            ->paginate(config('basic.paginate'));
        $transactions = $transaction->appends($search);
        return view($this->theme . 'user.transaction.index', compact('transactions'));
    }

    public function fundHistory()
    {
        $funds = Fund::where('user_id', $this->user->id)->where('status', '!=', 0)->orderBy('id', 'DESC')->with('gateway')->paginate(config('basic.paginate'));
        return view($this->theme . 'user.transaction.fundHistory', compact('funds'));
    }

    public function fundHistorySearch(Request $request)
    {
        $search = $request->all();

        $dateSearch = $request->date_time;
        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);

        $funds = Fund::orderBy('id', 'DESC')->where('user_id', $this->user->id)->where('status', '!=', 0)
            ->when(isset($search['name']), function ($query) use ($search) {
                return $query->where('transaction', 'LIKE', $search['name']);
            })
            ->when($date == 1, function ($query) use ($dateSearch) {
                return $query->whereDate("created_at", $dateSearch);
            })
            ->when(isset($search['status']), function ($query) use ($search) {
                return $query->where('status', $search['status']);
            })
            ->with('gateway')
            ->paginate(config('basic.paginate'));
        $funds->appends($search);
        return view($this->theme . 'user.transaction.fundHistory', compact('funds'));
    }


    public function addFund()
    {
        $invoice = session()->get('invoice');
        if ($invoice == null) {
            abort(403);
        }
         $sendMoney = SendMoney::latest()->where(['invoice' => $invoice, 'status' => 2])->with(['sendCurrency:id,name,rate'])->first();
        if (!$sendMoney) {
            return redirect()->route('user.transfer-log')->with('error', 'Invalid Payment Request');
        }

        if ($sendMoney->payment_status == 1) {
            return redirect()->route('user.transfer-log')->with('success', 'Payment has been completed');
        }
        if ($sendMoney->payment_status == 3) {
            return redirect()->route('user.transfer-log')->with('error', 'Payment has been rejected');
        }
        if ($sendMoney->payment_status == 3) {
            return redirect()->route('user.transfer-log')->with('warning', 'Wait for payment approval by admin');
        }


        $data['totalPayment'] = round($sendMoney->totalBaseAmountPay, config('basic.fraction_number'));
        $data['gateways'] = Gateway::where('status', 1)->orderBy('sort_by', 'ASC')->get();
        return view($this->theme . 'user.addFund', $data);
    }


    public function profile()
    {
        $user = $this->user;
        $languages = Language::all();
        return view($this->theme . 'user.profile.myprofile', compact('user', 'languages'));
    }

    public function updateProfile(Request $request)
    {

        $allowedExtensions = array('jpg', 'png', 'jpeg');

        $image = $request->image;
        $this->validate($request, [
            'image' => [
                'required',
                'max:4096',
                function ($fail) use ($image, $allowedExtensions) {
                    $ext = strtolower($image->extension());
                    if (!in_array($ext, $allowedExtensions)) {
                        return $fail("Only png, jpg, jpeg images are allowed");
                    } else {
                        if (($image->getSize() / 1000000) > 2) {
                            return $fail("Images MAX  2MB ALLOW!");
                        }
                    }

                }
            ]
        ]);
        $user = $this->user;
        if ($request->hasFile('image')) {
            $path = config('location.user.path');
            try {
                $user->image = $this->uploadImage($image, $path);
            } catch (\Exception $exp) {
                return back()->with('error', 'Could not upload your ' . $image)->withInput();
            }
        }
        $user->save();
        return back()->with('success', 'Updated Successfully.');
    }

    public function updateInformation(Request $request)
    {

        $languages = Language::all()->map(function ($item) {
            return $item->id;
        });

        $req = Purify::clean($request->all());
        $user = $this->user;
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => "sometimes|required|alpha_dash|min:5|unique:users,username," . $user->id,
            'address' => 'required',
            'language_id' => Rule::in($languages),
        ];
        $message = [
            'firstname.required' => 'First Name field is required',
            'lastname.required' => 'Last Name field is required',
        ];

        $validator = Validator::make($req, $rules, $message);
        if ($validator->fails()) {
            $validator->errors()->add('profile', '1');
            return back()->withErrors($validator)->withInput();
        }
        $user->language_id = $req['language_id'];
        $user->firstname = $req['firstname'];
        $user->lastname = $req['lastname'];
        $user->username = $req['username'];
        $user->address = $req['address'];
        $user->save();
        return back()->with('success', 'Updated Successfully.');
    }

    public function updatePassword(Request $request)
    {

        $rules = [
            'current_password' => "required",
            'password' => "required|min:5|confirmed",
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $validator->errors()->add('password', '1');
            return back()->withErrors($validator)->withInput();
        }
        $user = $this->user;
        try {
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = bcrypt($request->password);
                $user->save();
                return back()->with('success', 'Password Changes successfully.');
            } else {
                throw new \Exception('Current password did not match');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function twoStepSecurity()
    {
        $basic = (object)config('basic');
        $ga = new GoogleAuthenticator();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($this->user->username . '@' . $basic->site_title, $secret);
        $previousCode = $this->user->two_fa_code;

        $previousQR = $ga->getQRCodeGoogleUrl($this->user->username . '@' . $basic->site_title, $previousCode);
        return view($this->theme . 'user.twoFA.index', compact('secret', 'qrCodeUrl', 'previousCode', 'previousQR'));
    }

    public function twoStepEnable(Request $request)
    {
        $user = $this->user;
        $this->validate($request, [
            'key' => 'required',
            'code' => 'required',
        ]);
        $ga = new GoogleAuthenticator();
        $secret = $request->key;
        $oneCode = $ga->getCode($secret);

        $userCode = $request->code;
        if ($oneCode == $userCode) {
            $user['two_fa'] = 1;
            $user['two_fa_verify'] = 1;
            $user['two_fa_code'] = $request->key;
            $user->save();
            $browser = new Browser();
            $this->mail($user, 'TWO_STEP_ENABLED', [
                'action' => 'Enabled',
                'code' => $user->two_fa_code,
                'ip' => request()->ip(),
                'browser' => $browser->browserName() . ', ' . $browser->platformName(),
                'time' => date('d M, Y h:i:s A'),
            ]);
            return back()->with('success', 'Two Factor has been enabled.');
        } else {
            return back()->with('error', 'Wrong Verification Code.');
        }

    }

    public function twoStepDisable(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);
        $user = $this->user;
        $ga = new GoogleAuthenticator();

        $secret = $user->two_fa_code;
        $oneCode = $ga->getCode($secret);
        $userCode = $request->code;

        if ($oneCode == $userCode) {
            $user['two_fa'] = 0;
            $user['two_fa_verify'] = 1;
            $user['two_fa_code'] = null;
            $user->save();
            $browser = new Browser();
            $this->mail($user, 'TWO_STEP_DISABLED', [
                'action' => 'Disabled',
                'ip' => request()->ip(),
                'browser' => $browser->browserName() . ', ' . $browser->platformName(),
                'time' => date('d M, Y h:i:s A'),
            ]);

            return back()->with('success', 'Two Factor has been disabled.');
        } else {
            return back()->with('error', 'Wrong Verification Code.');
        }
    }




}
