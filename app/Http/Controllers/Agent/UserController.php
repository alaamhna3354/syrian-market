<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Http\Traits\Notify;
use App\Models\BalanceCoupon;
use App\Models\Debt;
use App\Models\Fund;
use App\Models\Language;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Stevebauman\Purify\Facades\Purify;

class UserController extends Controller
{
    use Notify;

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

    public function index()
    {
        $users = $this->user->children()->orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view('agent.pages.user.show', compact('users'));
    }

    public function search(Request $request)
    {
        $search = $request->all();
        $dateSearch = $request->date_time;
        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);
        $users = User::when(isset($search['username']), function ($query) use ($search) {
            return $query->where('username', 'LIKE', "%{$search['username']}%");
        })
            ->when(isset($search['email']), function ($query) use ($search) {
                return $query->where('email', 'LIKE', "%{$search['email']}%");
            })
            ->when(isset($search['phone']), function ($query) use ($search) {
                return $query->where('phone', 'LIKE', "%{$search['phone']}%");
            })
            ->when($date == 1, function ($query) use ($dateSearch) {
                return $query->whereDate("created_at", $dateSearch);
            })
            ->when(isset($search['status']), function ($query) use ($search) {
                return $query->where('status', $search['status']);
            })
            ->where('user_id', $this->user->id)
            ->paginate(config('basic.paginate'));
        return view('agent.pages.user.show', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::where('is_active', 1)->orderBy('short_name')->get();
        $country_code = null;
        if (!empty($info['code'])) {
            $country_code = @$info['code'][0];
        }
        $countries = config('country');
        return view('agent.pages.user.add', compact('languages', 'countries', 'country_code'));
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $country_code = "AF,AL,DZ,AS,AD,AO,AI,AG,AR,AM,AW,AU,AZ,BH,BD,BB,BY,BE,BZ,BJ,BM,BT,BO,BA,BW,BR,IO,VG,BN,BG,BF,MM,BI,KH,CM,CA,CV,KY,CF,ID,CL,CN,CO,KM,CK,CR,CI,HR,CU,CY,CZ,CD,DK,DJ,DM,DO,EC,EG,SV,GQ,ER,EE,ET,FK,FO,FM,FJ,FI,FR,GF,PF,GA,GE,DE,GH,GI,GR,GL,GD,GP,GU,GT,GN,GW,GY,HT,HN,HK,HU,IS,IN,IR,IQ,IE,IL,IT,JM,JP,JO,KZ,KE,KI,XK,KW,KG,LA,LV,LB,LS,LR,LY,LI,LT,LU,MO,MK,MG,MW,MY,MV,ML,MT,MH,MQ,MR,MU,YT,MX,MD,MC,MN,ME,MS,MA,MZ,NA,NR,NP,NL,AN,NC,NZ,NI,NE,NG,NU,NF,KP,MP,NO,OM,PK,PW,PS,PA,PG,PY,PE,PH,PL,PT,PR,QA,CG,RE,RO,RU,RW,BL,SH,KN,MF,PM,VC,WS,SM,ST,SA,SN,RS,SC,SL,SG,SK,SI,SB,SO,ZA,KR,ES,LK,LC,SD,SR,SZ,SE,CH,SY,TW,TJ,TZ,TH,BS,GM,TL,TG,TK,TO,TT,TN,TR,TM,TC,TV,UG,UA,AE,GB,US,UY,VI,UZ,VU,VA,VE,VN,WF,YE,ZM,ZW";
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:91'],
            'lastname' => ['required', 'string', 'max:91'],
            'username' => ['required', 'alpha_dash', 'min:5', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone_code' => ['required'],
            'phone' => ['required'],
            'password' => ['required', 'string', 'confirmed'],
        ], [
            'firstname.required' => 'First Name Field is required',
            'lastname.required' => 'Last Name Field is required',
            'phone' => 'The :attribute field contains an invalid number.'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $agent = $this->user;
        $req = Purify::clean($request->all());
        $basic = (object)config('basic');
        $this->validator($req)->validate();
        if ($this->validator($req)->fails()) {
            return back()->withErrors($this->validator($req))->withInput();
        }
        $user = new User();
        $user->firstname = $req['firstname'];
        $user->lastname = $req['lastname'];
        $user->username = $req['username'];
        $user->email = $req['email'];
        $user->phone_code = $req['phone_code'];
        $user->phone = $req['phone'];
        $user->address = $req['address'];
        $user->language_id = $req['language_id'] ?? 1;
        $user->password = Hash::make($req['password']);
        $user->api_token = Str::random(60);
        $user->email_verification = ($basic->email_verification) ? 0 : 1;
        $user->sms_verification = ($basic->sms_verification) ? 0 : 1;
        $user->is_agent = 0;
        $user->is_approved = 0;
        $user->debt_balance = $req['dept_amount'];
//        dd($agent->id);
        $user->user_id = $agent->id;
        $user->price_range_id = 1;
        if ($req['dept'] == "on") {
            $user->is_debt = 1;
        } else {
            $user->is_debt = 0;
        }
//        if ($request->hasFile('image')) {
//            try {
//                $user->image = $this->uploadImage($request['image'], config('location.user.path'));
//            } catch (\Exception $exp) {
//                return back()->with('error', 'Image could not be uploaded.');
//            }
//        }
        if ($user->save()) {
            $msg = [
                'username' => $user->username,
            ];
            $action = [
                "link" => route('admin.user-edit', $user->id),
                "icon" => "fas fa-user text-white"
            ];

            $this->adminPushNotification('ADDED_USER', $msg, $action);
            return back()->with('success', trans('Successfully Updated'));
        } else {
            return back()->with('error', trans('User could not be Created.') );
        }

    }

    public function userEdit($id)
    {
        $user = User::findOrFail($id);
        $languages = Language::where('is_active', 1)->orderBy('short_name')->get();

        return view('agent.pages.user.edit-user', compact('user', 'languages'));
    }

    public function userUpdate(Request $request, $id)
    {
//        dd($request);
        $userData = Purify::clean($request->except('_token', '_method'));
        $user = User::findOrFail($id);
        $rules = [
            'firstname' => 'sometimes|required',
            'lastname' => 'sometimes|required',
            'username' => 'sometimes|required|unique:users,username,' . $user->id,
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'phone' => 'sometimes|required',
            'language_id' => 'required|sometimes',
            'dept_amount' => 'numeric',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])]
        ];
        $message = [
            'firstname.required' => 'First Name is required',
            'lastname.required' => 'Last Name is required',
        ];

        $Validator = Validator::make($userData, $rules, $message);

        if ($Validator->fails()) {
            return back()->withErrors($Validator)->withInput();
        }

        if ($request->hasFile('image')) {
            try {
                $old = $user->image ?: null;
                $user->image = $this->uploadImage($request->image, config('location.user.path'), config('location.user.size'), $old);
            } catch (\Exception $exp) {
                return back()->with('error', trans('Image could not be uploaded.'));
            }
        }


        $user->firstname = $userData['firstname'];
        $user->lastname = $userData['lastname'];
        $user->username = $userData['username'];
        $user->email = $userData['email'];
        $user->phone = $userData['phone'];
        $user->address = $userData['address'];
        if ($userData['dept'] == "on") {
            $user->is_debt = 1;
        } else {
            $user->is_debt = 0;
        }
        $user->debt_balance = $userData['dept_amount'];
//        $user->status = ($userData['status'] == 'on') ? 0 : 1;
//        $user->email_verification = ($userData['email_verification'] == 'on') ? 0 : 1;
//        $user->sms_verification = ($userData['sms_verification'] == 'on') ? 0 : 1;
//        $user->is_special = ($userData['is_special'] == 'on') ? 0 : 1;

        if (isset($userData['language_id'])) {
            $user->language_id = @$userData['language_id'];
        }
        $user->save();

        return back()->with('success', trans('Updated Successfully.'));
    }

    public function addBalance()
    {

        return view('agent.pages.user.add_balance');
    }

    public function addBalanceToUser(Request $request)
    {

        $req = Purify::clean($request->all());
        $rules = [
            'user_id' => 'required',
            'balance' => 'required|numeric|min:0',
        ];

        $message = [
            'user_id.required' => 'User Name is required',
            'balance.required' => 'Balance is required',
            'balance.numeric' => 'Balance is Must Be Number',
        ];
        $Validator = Validator::make($req, $rules, $message);

        if ($Validator->fails()) {
            return back()->withErrors($Validator)->withInput();
        }
        $agent = Auth::user();
        $user = User::findOrFail($req['user_id']);
        $balance = $req['balance'];
        if ($agent->balance > $balance) {
            $agent->balance -= $balance;
            $user->balance += $balance;
            $user->debt += $balance;

            $transactionForAgent = new Transaction();
            $transactionForAgent->user_id = $agent->id;
            $transactionForAgent->trx_type = '-';
            $transactionForAgent->amount = $balance;
            $transactionForAgent->remarks = 'Add Balance To His User';
            $transactionForAgent->trx_id = strRandom();
            $transactionForAgent->charge = 0;


            $transactionForUser = new Transaction();
            $transactionForUser->user_id = $user->id;
            $transactionForUser->trx_type = '+';
            $transactionForUser->amount = $balance;
            $transactionForUser->remarks = 'Charge Balance From Agent';
            $transactionForUser->trx_id = strRandom();
            $transactionForUser->charge = 0;


            $fund = new Fund();
            $fund->user_id = $user->id;
            $fund->gateway_id = null;
            $fund->gateway_currency = config('basic.currency_symbol') == "$" ? 'USD' : config('basic.currency_symbol');
            $fund->amount = $balance;
            $fund->charge = 0;
            $fund->rate = 0;
            $fund->final_amount = $balance;
            $fund->btc_amount = 0;
            $fund->btc_wallet = "";
            $fund->transaction = strRandom();
            $fund->try = 0;
            $fund->status = 1;

            $debt = new Debt();
            $debt->order_id = 0 ;
            $debt->user_id = $user->id;
            $debt->agent_id = $agent->id;
            $debt->debt = $balance;
            $debt->status = 1 ;
            $debt->despite = 0;
            $debt->save();

            $basic = (object)config('basic');
            if ($agent->save() && $user->save()) {
                if ($transactionForAgent->save() && $transactionForUser->save() && $fund->save()) {
                    $msg = [
                        'transaction' => $transactionForAgent->trx_id,
                        'amount' => $balance,
                        'currency' => $basic->currency,
                        'main_balance' => $agent->balance,
                    ];
                    $action = [
//                        "link" => route('admin.user.transaction', $transactionForAgent->id),
                        "icon" => "fas fa-cart-plus text-white",
                        "link" => "#"
                    ];
                    $this->adminPushNotification('ADD_BALANCE', $msg, $action);
                    return back()->with('success', trans('Balance Added Successfully.'));
                } else {
                    return back()->with('error', trans('Balance Do Not Added Successfully.'));
                }

            } else {
                return back()->with('error', trans('Balance Do Not Added Successfully.'));
            }

        } elseif ($agent->is_debt == 1) {
            if ($agent->balance + $agent->debt_balance > $balance) {
                $agent->balance -= $balance;
                $user->balance += $balance;

                $transactionForAgent = new Transaction();
                $transactionForAgent->user_id = $agent->id;
                $transactionForAgent->trx_type = '-';
                $transactionForAgent->amount = $balance;
                $transactionForAgent->remarks = 'Add Balance To His User';
                $transactionForAgent->trx_id = strRandom();
                $transactionForAgent->charge = 0;


                $transactionForUser = new Transaction();
                $transactionForUser->user_id = $user->id;
                $transactionForUser->trx_type = '+';
                $transactionForUser->amount = $balance;
                $transactionForUser->remarks = 'Charge Balance From Agent';
                $transactionForUser->trx_id = strRandom();
                $transactionForUser->charge = 0;


                $fund = new Fund();
                $fund->user_id = $user->id;
                $fund->gateway_id = null;
                $fund->gateway_currency = config('basic.currency_symbol') == "$" ? 'USD' : config('basic.currency_symbol');
                $fund->amount = $balance;
                $fund->charge = 0;
                $fund->rate = 0;
                $fund->final_amount = $balance;
                $fund->btc_amount = 0;
                $fund->btc_wallet = "";
                $fund->transaction = strRandom();
                $fund->try = 0;
                $fund->status = 1;

                $basic = (object)config('basic');
                if ($agent->save() && $user->save()) {
                    if ($transactionForAgent->save() && $transactionForUser->save() && $fund->save()) {
                        $msg = [
                            'transaction' => $transactionForAgent->trx_id,
                            'amount' => $balance,
                            'currency' => $basic->currency,
                            'main_balance' => $agent->balance,
                        ];
                        $action = [
                            "icon" => "fas fa-cart-plus text-white",
                            "link" => "#"
                        ];
                        $this->adminPushNotification('ADD_BALANCE', $msg, $action);
                        return back()->with('success',trans('Balance Added Successfully.') );
                    } else {
                        return back()->with('error', trans('Balance Do Not Added Successfully.'));
                    }

                } else {
                    return back()->with('error', trans('Balance Do Not Added Successfully.'));
                }
            } else {
                return back()->with('error', trans('You Do Not Have Enough Balance'));
            }
        } else {
            return back()->with('error',trans('You Do Not Have Enough Balance'));
        }


    }

    public function addDebtPayment()
    {

        return view('agent.pages.user.add_debt_payment');
    }

    public function payDebt(Request $request)
    {

        $req = Purify::clean($request->all());
        $rules = [
            'user_id' => 'required',
            'balance' => 'required|numeric|min:0',
        ];

        $message = [
            'user_id.required' => 'User Name is required',
            'balance.required' => 'Balance is required',
            'balance.numeric' => 'Balance is Must Be Number',
        ];
        $Validator = Validator::make($req, $rules, $message);

        if ($Validator->fails()) {
            return back()->withErrors($Validator)->withInput();
        }
        $user = User::findOrFail($req['user_id']);
        $agent = $user->parent;
        $balance = $req['balance'];

        if ($balance <= $user->debt){

            $user->debt -= $balance;


//            $transactionForUser = new Transaction();
//            $transactionForUser->user_id = $user->id;
//            $transactionForUser->trx_type = '-';
//            $transactionForUser->amount = $balance;
//            $transactionForUser->remarks = 'Pay A Debt';
//            $transactionForUser->trx_id = strRandom();
//            $transactionForUser->charge = 0;




            $debt = new Debt();
            $debt->order_id = 0 ;
            $debt->user_id = $user->id;
            $debt->agent_id = $agent->id;
            $debt->debt = $balance;
            $debt->status = 1 ;
            $debt->despite = 1;
            $debt->save();

            $basic = (object)config('basic');
            if ( $user->save()) {
//                if ($transactionForUser->save()) {
                    $msg = [
                        'transaction' => $debt->id,
                        'amount' => $balance,
                        'currency' => $basic->currency,
                        'main_balance' => $balance,
                    ];
                    $action = [
//                        "link" => route('admin.user.transaction', $transactionForAgent->id),
                        "icon" => "fas fa-cart-plus text-white",
                        "link" => "#"
                    ];
                    $this->adminPushNotification('ADD_DEBT_PAYMENT', $msg, $action);
                    return back()->with('success', trans('Balance Added Successfully.'));
//                } else {
//                    return back()->with('error', 'Balance Do Not Added Successfully.');
//                }

            } else {
                return back()->with('error', trans('Balance Do Not Added Successfully.'));
            }
        }else{

                return back()->with('error',trans('The debt payment must not be greater than the debt.') );

        }







    }

    public function usersOrder(){
        return view('agent.pages.user.orders');
    }

    public function usersOrderSearch(Request $request)
    {
        $search = @$request->order_id;
//        dd($search);
        $status = @$request->status;
        $dateSearch = @$request->date_order;
        $username = @$request->username;
        $agent = Auth::user();
        $children = $agent->children;
//        dd($children);
        foreach ($children as $key=>$child){
            $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);
            $orders[$key] = Order::where('user_id', $child->id)
                ->when($search, function ($query) use ($search) {
                    return $query->where('id', 'LIKE', "%{$search}%")
                        ->orWhereHas('service', function ($q) use ($search) {
                            return $q->where('service_title', 'LIKE', "%{$search}%");
                        });
                })
                ->when($status != -1, function ($query) use ($status) {
                    return $query->where('status', 'LIKE', "%{$status}%");
                })
                ->when($date == 1, function ($query) use ($dateSearch) {
                    return $query->whereDate("created_at", $dateSearch);
                })
                ->with('service', 'service.category', 'users')
                ->latest()
                ->paginate(config('basic.paginate'));
        }
        $user = Auth::user();
        $search = $request->all();
        $dateSearch = $request->datetrx;
        $ids = [];
        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);
        $transaction = Transaction::with('user')->orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        $user1 = User::with('transaction')->orderBy('id', 'asc')
            ->when($username, function ($query) use ($search) {
                return $query->where('username', 'LIKE', "%{$search['username']}%");
            })
            ->get();
        foreach ($user1 as $id){
            array_push($ids,$id->id);
        }
        foreach ($user->children as $key=>$userSearch){
            if (!in_array($userSearch->id,$ids)){
                $user->children->forget($key);
            }
        }
//        dd($orders);

        return view('agent.pages.user.orderSearch', compact('orders','user'));
    }

    public function usersDebtSearch(Request $request)
    {
        $search = $request->all();
        $user = Auth::user();
        $dateSearch = $request->datetrx;
//        dd($search['user_name']);
        $ids = [];
        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);
        $transaction = Transaction::with('user')->orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        $user1 = User::with('transaction')->orderBy('id', 'asc')
            ->when($search['user_name'], function ($query) use ($search) {
                return $query->where('username', 'LIKE', "%{$search['user_name']}%");
            })
            ->get();
        foreach ($user1 as $id){
            array_push($ids,$id->id);
        }
        foreach ($user->children as $key=>$userSearch){
            if (!in_array($userSearch->id,$ids)){
                $user->children->forget($key);
            }
        }
//        dd($user);

        return view('agent.pages.user.debts', compact('user'));
    }

    public function statusSearch(Request $request, $name = 'awaiting')
    {
        $status = @$name;
        $agent = Auth::user();
        $children = $agent->children;
        foreach ($children as $key=>$child) {
            $orders[$key] = Order::with('service', 'users')
                ->where(['user_id' => $child->id])
                ->when($status != -1, function ($query) use ($status) {
                    return $query->where('status', $status);
                })
                ->paginate(config('basic.paginate'));
        }
        return view('agent.pages.user.orderSearch', compact('orders'));
    }

}
