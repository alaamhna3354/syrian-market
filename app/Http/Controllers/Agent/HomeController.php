<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Http\Traits\Notify;
use App\Http\Traits\Upload;
use App\Models\Agent;
use App\Models\BalanceCoupon;
use App\Models\Category;
use App\Models\Debt;
use App\Models\Fund;
use App\Models\Gateway;
use App\Models\Language;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

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
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data['walletBalance'] = $this->user->balance;
        $data['totalTrx'] = Transaction::where('user_id', $this->user->id)->count();
        $data['totalDeposit'] = Fund::where('user_id', $this->user->id)->where('status', 1)->sum('amount');
        $data['ticket'] = Ticket::where('user_id', $this->user->id)->count();

        $order['total'] = Order::where('user_id', $this->user->id)->count();
        $order['processing'] = Order::where('user_id', $this->user->id)->where('status', 'processing')->count();
        $order['pending'] = Order::where('user_id', $this->user->id)->where('status', 'pending')->count();
        $order['completed'] = Order::where('user_id', $this->user->id)->where('status', 'completed')->count();
        $data['transactions'] = Transaction::where('user_id', $this->user->id)->orderBy('id', 'DESC')->limit(5)->get();

        return view('agent.pages.dashboard', $data, compact('order'));
    }

    public function use_spare_balance()
    {
        $user = Auth::user();
//        if ($user->debt == 0) {
            if ($user->is_debt == 1) {
                if ($user->debt_balance > 0) {
                    $user->balance += $user->debt_balance;
                    $user->is_debt = 0;
                    $user->debt += $user->debt_balance;
                    $user->save();
                    if ($user->parent != null) {
                        $user->parent->balance -= $user->debt_balance;
                        $user->parent->save();
                    }

                    $transactionForUser = new Transaction();
                    $transactionForUser->user_id = $user->id;
                    $transactionForUser->trx_type = '+';
                    $transactionForUser->amount = $user->debt_balance;
                    $transactionForUser->remarks = 'Charge Balance From reserve balance';
                    $transactionForUser->trx_id = strRandom();
                    $transactionForUser->charge = 0;

                    $fund = new Fund();
                    $fund->user_id = $user->id;
                    $fund->gateway_id = null;
                    $fund->gateway_currency = config('basic.currency_symbol') == "$" ? 'USD' : config('basic.currency_symbol');
                    $fund->amount = $user->debt_balance;
                    $fund->charge = 0;
                    $fund->rate = 0;
                    $fund->final_amount = $user->debt_balance;
                    $fund->btc_amount = 0;
                    $fund->btc_wallet = "";
                    $fund->transaction = strRandom();
                    $fund->try = 0;
                    $fund->status = 1;

                    $debt = new Debt();
                    $debt->order_id = 0;
                    $debt->user_id = $user->id;

                    $debt->debt = $user->debt_balance;
                    $debt->status = 1;
                    $debt->despite = 0;
                    if ($user->parent != null) {
                        $debt->is_for_admin = 0;
                        $debt->agent_id = $user->user_id;
                    }else{
                        $debt->is_for_admin = 1;
                        $debt->agent_id = 0;
                    }
                    $debt->save();
                    $transactionForUser->save();
                    $fund->save();

                    $msg = [
                        'amount' => $user->debt_balance,
                        'currency' => $fund->gateway_currency,
                        'main_balance' => $user->balance,
                        'username' => $user->username
                    ];
                    $action = [
                        "link" => '#',
                        "icon" => "fa fa-money-bill-alt text-white"
                    ];
                    $this->adminPushNotification('USE_SPARE_BALANCE', $msg, $action);
                } else {
                    return back()->with('error',trans('sorry You do not have a reserve balance') );
                }

            } else {
                return back()->with('error',trans('sorry You are not entitled to benefit from the reserve balance, please contact the agent') );
            }
//        } else {
//            return back()->with('error', 'sorry You are not entitled to benefit from the reserve balance, You have debts ');
//        }


        return back()->with('success', trans('Balance Is Updated Successfully.'));
    }


    public function transaction()
    {
        $transactions = $this->user->transaction()->orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view('agent.pages.transaction.index', compact('transactions'));
    }

    public function useBalanceCoupon()
    {
        $transactions = $this->user->transaction()->orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view('agent.pages.use_balance_coupon', compact('transactions'));
    }

    public function addBalanceCoupon(Request $request)
    {

        $this->validate($request, [
            'code' => 'required'
        ]);
        $user = Auth::user();

        $x = 0;
//        dd($user);
        $coupon = BalanceCoupon::where('code', $request['code'])->first();

        if ($coupon != null && $coupon->is_sold != 1 && $coupon->status != 0) {
            $balance = $coupon->balance;


            $user->balance += $balance;
            $user->balance += $x;

            if ($user->save()) {
                $coupon->is_sold = 1;
                $coupon->user_id = $user->id;
                if ($coupon->save()) {
                    $transaction = new Transaction();
                    $transaction->user_id = $user->id;
                    $transaction->trx_type = '+';
                    $transaction->amount = $coupon->balance;
                    $transaction->remarks = 'Use Balance Coupon';
                    $transaction->trx_id = strRandom();
                    $transaction->charge = 0;


                    $fund = new Fund();
                    $fund->user_id = $user->id;
                    $fund->gateway_id = 0;
                    $fund->gateway_currency = config('basic.currency_symbol') == "$" ? 'USD' : config('basic.currency_symbol');
                    $fund->amount = $coupon->balance;
                    $fund->charge = 0;
                    $fund->rate = 0;
                    $fund->final_amount = $coupon->balance;
                    $fund->btc_amount = 0;
                    $fund->btc_wallet = "";
                    $fund->transaction = strRandom();
                    $fund->try = 0;
                    $fund->status = 1;


                    if ($transaction->save() && $fund->save()) {
                        return back()->with('success',trans('Balance Is Updated Successfully.') );
                    } else {
                        return back()->with('error', trans('Please Try Again There Are An Error'));
                    }
                } else {
                    return back()->with('error', trans('Please Try Again There Are An Error'));
                }
            } else {
                return back()->with('error', trans('Please Try Again There Are An Error'));
            }
        } else {
            return back()->with('error', trans('Coupon Is Not Found.'));
        }
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


        return view('agent.pages.transaction.index', compact('transactions'));

    }

    public function fundHistory()
    {
        $funds = Fund::where('user_id', $this->user->id)->where('status', '!=', 0)->orderBy('id', 'DESC')->with('gateway')->paginate(config('basic.paginate'));
        return view('agent.pages.transaction.fundHistory', compact('funds'));
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

        return view('agent.pages.transaction.fundHistory', compact('funds'));

    }


    public function addFund()
    {
        $gateways = Gateway::where('status', 1)->orderBy('sort_by', 'ASC')->get();
        return view('agent.pages.addFund', compact('gateways'));
    }


    public function apiKey()
    {
        $api_token = Auth::user()->api_token;
        return view('agent.pages.apiKey', compact('api_token'));
    }

    public function search(Request $request)
    {
        $search = $request->all();
        $searchCat = Category::when(isset($search['category_title']), function ($query) use ($search) {
            return $query->where('category_title', 'LIKE', "%{$search['category_title']}%");
        })
            ->when(isset($search['category_status']), function ($query) use ($search) {
                return $query->where('category_title', $search['category_status']);
            })
            ->get();
        $searchCat->append($search);
        return view('admin.pages.services.show-category', compact('searchCat'));
    }


    public function profile()
    {
        $user = Auth::user();
        $languages = Language::where('is_active', 1)->orderBy('short_name')->get();
        return view('agent.pages.profile.myprofile', compact('user', 'languages'));
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
                    $ext = strtolower($image->getClientOriginalExtension());
                    if (($image->getSize() / 1000000) > 2) {
                        return $fail(trans("Images MAX  2MB ALLOW!"));
                    }
                    if (!in_array($ext, $allowedExtensions)) {
                        return $fail(trans("Only png, jpg, jpeg images are allowed"));
                    }
                }
            ]
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            $path = config('location.user.path');
            try {

                $user->image = $this->uploadImage($image, $path);
            } catch (\Exception $exp) {
                return back()->with('error', trans('Could not upload your ') . $image)->withInput();
            }
        }
        $user->save();
        return back()->with('success', trans('Updated Successfully.'));
    }


    public function updateInformation(Request $request)
    {
        $req = Purify::clean($request->all());
        $user = Auth::user();

        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => "sometimes|required|alpha_dash|min:5|unique:users,username," . $user->id,
            'address' => 'required',
            'language_id' => 'required|sometimes',
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
        $user->firstname = $req['firstname'];
        $user->lastname = $req['lastname'];
        $user->username = $req['username'];
        $user->address = $req['address'];

        if (isset($req['language_id'])) {
            $user->language_id = $req['language_id'];
        }
        $user->save();

        return back()->with('success', trans('Updated Successfully.'));
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
        $user = Auth::user();
        try {
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = bcrypt($request->password);
                $user->save();
                return back()->with('success', trans('Password Changes successfully.'));
            } else {
                throw new \Exception(trans('Current password did not match'));
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

    }

    public function showAgentRegistrationForm()
    {
        $user = Auth::user();
        $languages = Language::where('is_active', 1)->orderBy('short_name')->get();
        return view('user.pages.profile.registerAsAgent', compact('user', 'languages'));
    }

    public function registerAsAgent(Request $request, User $user)
    {
//        dd($request);

        $req = Purify::clean($request->all());
        $rules = [
            'fullname' => 'required|string|max:150',
            'whatsapp' => 'required|string',
            'email' => 'required',
            'company_name' => 'required',
            'company_address' => 'required',
            'country' => 'required|string',
            'region' => 'required',
            'note' => 'required',
            'expected_purchasing_power' => 'required|numeric',
        ];
        $validator = Validator::make($req, $rules);
//        if ($validator->fails()) {
//            return back()->withErrors($validator)->withInput();
//        }
        if ($user->balance >= config('basic.min_balance')) {
            if ($user->debt == 0){
                $user->is_agent = 1;
                $user->is_approved = 0;
                if ($user->save()) {
                    $agent = new Agent();
                    $agent->fullname = $req['fullname'];
                    $agent->whatsapp = $req['whatsapp'];
                    $agent->email = $req['email'];
                    $agent->company_name = $req['company_name'];
                    $agent->company_address = $req['company_address'];
                    $agent->country = $req['country'];
                    $agent->region = $req['region'];
                    $agent->expected_purchasing_power = $req['expected_purchasing_power'];
                    $agent->note = $req['note'];
                    $agent->status = 1;
                    $agent->user_id = $user->id;
                    if ($agent->save()) {
                        $msg = [
                            'username' => $user->username,
                        ];
                        $action = [
                            "link" => route('admin.user-edit', $user->id),
                            "icon" => "fas fa-user text-white"
                        ];

                        $this->adminPushNotification('AGENT_REQUEST', $msg, $action);
                    } else {
                        return back()->with('error', trans('Please Try Again Later'))->withInput();
                    }
                } else {
                    return back()->with('error', trans('Please Try Again Later'))->withInput();
                }
            }else{
                return back()->with('error', trans('You must pay off all your debts first'))->withInput();
            }


        } else {
            return back()->with('error', trans('Your balance must be at least') .config('basic.min_balance').'$')->withInput();
        }

        return back()->with('success', trans('The Admin will see your request soon'));


    }

}
