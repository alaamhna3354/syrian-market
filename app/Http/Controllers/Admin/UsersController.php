<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Notify;
use App\Models\AgentCommissionRate;
use App\Models\Category;
use App\Models\Debt;
use App\Models\Fund;
use App\Models\Language;
use App\Models\Order;
use App\Models\PriceRange;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserPriceRange;
use App\Models\UserServiceRate;
use App\Rules\FileTypeValidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Stevebauman\Purify\Facades\Purify;

class UsersController extends Controller
{
    use Notify;

    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view('admin.pages.users.show-user', compact('users'));
    }

    public function agents()
    {
        $users = User::orderBy('id', 'DESC')->where('is_agent', 1)->paginate(config('basic.paginate'));
        return view('admin.pages.users.show-agent', compact('users'));
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
            ->paginate(config('basic.paginate'));
        return view('admin.pages.users.show-user', compact('users', 'search'));
    }

    public function changePriceRange()
    {
        $users = User::where('is_const_price_range', 0)->where('price_range_id','>',1)->get();
        foreach ($users as $user) {
//            if ($user->id == 15){
            $lastUserPriceRangeChange = UserPriceRange::where('user_id', $user->id)->orderBy('id', 'desc')->first();

            if ($lastUserPriceRangeChange != null) {
                $total = $lastUserPriceRangeChange->total;

                $orders = Order::whereDate('created_at', '<=', $lastUserPriceRangeChange->created_at->format('Y-m-d'))->get();

                $limitDays = $user->priceRange->limit_days;

                $now = Carbon::now();
                $dateDiffDay = $now->diff(date("m/d/Y H:i", strtotime($lastUserPriceRangeChange->created_at)))->d;
                $dateDiffHour = $now->diff(date("m/d/Y H:i", strtotime($lastUserPriceRangeChange->created_at)))->h;
                $dateDiff = ($dateDiffDay * 24) + $dateDiffHour;
                if ($dateDiff == $limitDays) {
                    if ($total < $user->priceRange->min_total_amount_to_stay) {
                        $user->price_range_id = $user->price_range_id - 1;
                        if ($user->save()) {
                            $userPriceRange = new UserPriceRange();
                            $userPriceRange->user_id = $user->id;
                            $userPriceRange->price_range_id = $user->price_range_id;
                            $userPriceRange->price_range_type = '-';
                            $userPriceRange->total = 0;
                            $userPriceRange->save();
                            $nextPriceRange = $user->priceRange;
                            $msg = [
                                'username' => $user->username,
                                'level' => $nextPriceRange->name,
                                'status' => "demotion"
                            ];
                            $action = [
                                "link" => route('admin.user-edit', $user->id),
                                "icon" => "fas fa-plus text-white"
                            ];
                            $this->adminPushNotification('CHANGE_LEVEL', $msg, $action);
                            $this->userPushNotification($user, 'CHANGE_LEVEL', $msg, $action);
                        }
                    }
                } elseif ($dateDiff > $limitDays) {

                    $hours = $dateDiff % $limitDays;

                    $dateOfOrders = Carbon::now()->subHours($hours);

                    $ordersTotal = Order::where('user_id', $user->id)->whereDate('created_at', '>=', $dateOfOrders)->sum('price');

                    if ($ordersTotal < $user->priceRange->min_total_amount_to_stay) {

                        $user->price_range_id = $user->price_range_id - 1;
                        if ($user->save()) {

                            $userPriceRange = new UserPriceRange();
                            $userPriceRange->user_id = $user->id;
                            $userPriceRange->price_range_id = $user->price_range_id;
                            $userPriceRange->price_range_type = '-';
                            $userPriceRange->total = 0;
                            $userPriceRange->save();
                            $nextPriceRange = PriceRange::findOrFail($user->price_range_id);
                            $msg = [
                                'username' => $user->username,
                                'level' => $nextPriceRange->name,
                                'status' => "demotion"
                            ];
                            $action = [
                                "link" => route('admin.user-edit', $user->id),
                                "icon" => "fas fa-plus text-white"
                            ];
                            $this->adminPushNotification('CHANGE_LEVEL', $msg, $action);
                            $this->userPushNotification($user, 'CHANGE_LEVEL', $msg, $action);
                        }
                    }
                }


            } else {

                $userPriceRange = new UserPriceRange();
                $userPriceRange->user_id = $user->id;
                $userPriceRange->price_range_id = $user->price_range_id;
                $userPriceRange->price_range_type = '+';
                $userPriceRange->total = 0;
                $userPriceRange->save();
            }
        }
//        }
    }

    public function agentsSearch(Request $request)
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
            ->when(isset($search['is_approved']), function ($query) use ($search) {
                return $query->where('is_approved', $search['is_approved']);
            })
            ->where('is_agent', 1)
            ->paginate(config('basic.paginate'));
        return view('admin.pages.users.show-agent', compact('users', 'search'));
    }

    public function approve(Request $request, $id)
    {
        $user = User::find($id);
        $agent = null ;
        if ($user['is_approved'] == 0) {
            $is_approved = 1;
//            $user->user_id = 0;
            $msg = [
                'status' => "Accepted",
            ];
            $action = [
                "link" => '#',
                "icon" => "fa fa-money-bill-alt text-white"
            ];
        } else {
            $is_approved = 0;
            $agent = $user->agent();
            $msg = [
                'status' => "Refused",
            ];
            $action = [
                "link" => '#',
                "icon" => "fa fa-money-bill-alt text-white"
            ];


        }
        $user->is_approved = $is_approved;
        $user->is_agent = $is_approved;

        $user->save();
        if ($agent != null){
            $agent->delete();
        }

        $this->userPushNotification($user, 'APPROVE_AGENT', $msg, $action);


        return back()->with('success', 'Successfully Updated');
    }

    public function transaction($id)
    {
        $user = User::findOrFail($id);
        $userid = $user->id;
        $transaction = $user->transaction()->paginate(config('basic.paginate'));
        return view('admin.pages.users.transactions', compact('user', 'userid', 'transaction'));
    }

    public function funds($id)
    {
        $user = User::findOrFail($id);
        $userid = $user->id;

        $funds = $user->funds()->paginate(config('basic.paginate'));
        return view('admin.pages.users.fund-log', compact('user', 'userid', 'funds'));
    }

    public function transfer($id)
    {
//        dd($id);
        $user = User::findOrFail($id);
        $userid = $user->id;
        $children = $user->children;
        $users_ids = [];
        if (count($children) > 0){
            foreach ($children as $key=>$child){
                $users_ids[$key] = $child->id;
            }
        }

        $commissions = AgentCommissionRate::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', date('Y'))
            ->paginate(config('basic.paginate'));

        $commissionsThisMonth = AgentCommissionRate::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', date('Y'))
            ->paginate(config('basic.paginate'));

        $totalCommissions = AgentCommissionRate::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', date('Y'))->where('is_paid', 0)
            ->wherein('user_id', $users_ids)
            ->paginate(config('basic.paginate'));
        $totalCommissionsThisMonth = AgentCommissionRate::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', date('Y'))->where('is_paid', 0)
            ->wherein('user_id', $users_ids)
            ->paginate(config('basic.paginate'));
//        dd($totalCommissionsThisMonth);
        $commission_rate = 0;
        $this_month_commission_rate = 0;
        $totalCommission_rate = 0;
        $totalThis_month_commission_rate = 0;
        foreach ($commissions as $key => $commission) {
            $agent = $commission->user;
            if ($agent->parent->id == $userid) {
                $commission_rate += $commission->commission_rate;
            } else {
                $commissions->forget($key);
            }
        }
        foreach ($commissionsThisMonth as $key1 => $commissionThisMonth) {
            $agent = $commissionThisMonth->user;
            if ($agent->parent->id == $userid) {
                $this_month_commission_rate += $commissionThisMonth->commission_rate;
            } else {
                $commissionsThisMonth->forget($key1);
            }
        }
        foreach ($totalCommissions as $key => $commission) {
            $agent = $commission->user;
            if ($agent->parent->id == $userid) {
                $totalCommission_rate += $commission->commission_rate;
            } else {
                $totalCommissions->forget($key);
            }
        }
        foreach ($totalCommissionsThisMonth as $key1 => $commissionThisMonth) {
            $agent = $commissionThisMonth->user;
            if ($agent->parent->id == $userid) {
                $totalThis_month_commission_rate += $commissionThisMonth->commission_rate;
            } else {
                $totalCommissionsThisMonth->forget($key1);
            }
        }


        return view('admin.pages.users.transfer', compact('totalCommission_rate','totalThis_month_commission_rate','user', 'userid', 'commissionsThisMonth', 'commissions', 'commission_rate', 'this_month_commission_rate'));
    }

    public function transferEarn(Request $request)
    {
        $id = $request->id;

        $user = User::findOrFail($id);
        $userid = $user->id;
        $children = $user->children;
        $users_ids = [];
        if (count($children) > 0){
            foreach ($children as $key=>$child){
                $users_ids[$key] = $child->id;
            }
        }
        $commissions = AgentCommissionRate::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', date('Y'))
            ->where('is_paid', 0)
            ->wherein('user_id', $users_ids)
            ->paginate(config('basic.paginate'));
        $commission_rate = 0;
        if (count($commissions) == 0) {
            return back()->with('error', 'All Earnings of last month was been transfer before');
        }
        foreach ($commissions as $key => $commission) {
            $agent = $commission->user;
            if ($agent->parent->id == $userid) {
                $commission_rate += $commission->commission_rate;
                $commission->is_paid = 1;
            } else {
                $commissions->forget($key);
            }
        }
        $user->balance += $commission_rate;
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->trx_type = '+';
        $transaction->amount = $commission_rate;
        $transaction->remarks = 'ارباح مشتريات مستخدميه';
        $transaction->trx_id = strRandom();
        $transaction->charge = 0;


        $fund = new Fund();
        $fund->user_id = $user->id;
        $fund->gateway_id = 0;
        $fund->gateway_currency = config('basic.currency_symbol') == "$" ? 'USD' : config('basic.currency_symbol');
        $fund->amount = $commission_rate;
        $fund->charge = 0;
        $fund->rate = 0;
        $fund->final_amount = $commission_rate;
        $fund->btc_amount = 0;
        $fund->btc_wallet = "";
        $fund->transaction = strRandom();
        $fund->try = 0;
        $fund->status = 1;

        if ($user->save()) {
            $fund->save();
            $transaction->save();
            foreach ($commissions as $commission) {
                $commission->save();
            }
            return back()->with('success', 'Successfully Added Earnings to Agent Balance');
        } else {
            return back()->with('error', 'Try Again Later there was an error now');
        }
//        dd($commission_rate);
//        return view('admin.pages.users.transfer', compact('user', 'userid', 'commissions','commission_rate'));
    }
    public function transferThisMonthEarn(Request $request)
    {
        $id = $request->id;

        $user = User::findOrFail($id);
        $children = $user->children;
        $users_ids = [];
        if (count($children) > 0){
            foreach ($children as $key=>$child){
                $users_ids[$key] = $child->id;
            }
        }

        $userid = $user->id;
        $commissions = AgentCommissionRate::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', date('Y'))
            ->where('is_paid', 0)
            ->wherein('user_id', $users_ids)
            ->get();
        $commission_rate = 0;
        if (count($commissions) == 0) {
            return back()->with('error', 'All Earnings of last month was been transfer before');
        }
        foreach ($commissions as $key => $commission) {
            $agent = $commission->user;
            if ($agent->parent->id == $userid) {
                $commission_rate += $commission->commission_rate;
                $commission->is_paid = 1;
            } else {
                $commissions->forget($key);
            }
        }
        $user->balance += $commission_rate;

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->trx_type = '+';
        $transaction->amount = $commission_rate;
        $transaction->remarks = 'ارباح مشتريات مستخدميه';
        $transaction->trx_id = strRandom();
        $transaction->charge = 0;


        $fund = new Fund();
        $fund->user_id = $user->id;
        $fund->gateway_id = 0;
        $fund->gateway_currency = config('basic.currency_symbol') == "$" ? 'USD' : config('basic.currency_symbol');
        $fund->amount = $commission_rate;
        $fund->charge = 0;
        $fund->rate = 0;
        $fund->final_amount = $commission_rate;
        $fund->btc_amount = 0;
        $fund->btc_wallet = "";
        $fund->transaction = strRandom();
        $fund->try = 0;
        $fund->status = 1;
        if ($user->save()) {
            $fund->save();
            $transaction->save();
            foreach ($commissions as $commission) {
                $commission->save();
            }
            return back()->with('success', 'Successfully Added Earnings to Agent Balance');
        } else {
            return back()->with('error', 'Try Again Later there was an error now');
        }
//        dd($commission_rate);
//        return view('admin.pages.users.transfer', compact('user', 'userid', 'commissions','commission_rate'));
    }

    public function userOrders($id)
    {
//        dd($id);
        $user = User::findOrFail($id);
        $userid = $user->id;


        return view('admin.pages.agent.user_order', compact('user', 'userid'));
    }

    public function userTransactions($id)
    {
//        dd($id);
        $user = User::findOrFail($id);
        $userid = $user->id;


        return view('admin.pages.agent.user_transactions', compact('user', 'userid'));
    }

    public function userDebts($id)
    {
//        dd($id);
        $user = User::findOrFail($id);
        $userid = $user->id;


        return view('admin.pages.agent.user_debts', compact('user', 'userid'));
    }

    public function debts($id)
    {
        $user = User::findOrFail($id);
        $userid = $user->id;


        return view('admin.pages.agent.debts', compact('user', 'userid'));
    }

    public function activeMultiple(Request $request)
    {

        if ($request->strIds == null) {
            session()->flash('error', 'You do not select User.');
            return response()->json(['error' => 1]);
        } else {
            User::whereIn('id', $request->strIds)->update([
                'status' => 1,
            ]);
            session()->flash('success', 'User Status Has Been Active');
            return response()->json(['success' => 1]);
        }
    }


    public function inactiveMultiple(Request $request)
    {

        if ($request->strIds == null) {
            session()->flash('error', 'You do not select User.');
            return response()->json(['error' => 1]);
        } else {
            User::whereIn('id', $request->strIds)->update([
                'status' => 0,
            ]);

            session()->flash('success', 'User Status Has Been Deactive');
            return response()->json(['success' => 1]);

        }
    }


    public function userEdit($id)
    {
        $user = User::findOrFail($id);
        $languages = Language::where('is_active', 1)->orderBy('short_name')->get();
        $ranges = PriceRange::all();
        $agents = User::where('is_agent',1)->where('is_approved',1)->get();
        return view('admin.pages.users.edit-user', compact('user','agents', 'languages', 'ranges'));
    }

    public function info($id)
    {
        $user = User::findOrFail($id);
        $languages = Language::where('is_active', 1)->orderBy('short_name')->get();
//        dd($user->children);
        $total = 0;
        foreach ($user->children as $child) {
            $orders = $child->order;
            foreach ($orders as $order) {
                $total += $order->price;
            }


//            dd($total);
        }
        foreach ($user->order as $ord) {

            $total += $ord->price;
//                dd($total);
        }
        return view('admin.pages.users.agent-info', compact('user', 'languages', 'total'));

    }

    public function userUpdate(Request $request, $id)
    {
        $userData = Purify::clean($request->except('_token', '_method'));
        $user = User::findOrFail($id);
        $rules = [
            'firstname' => 'sometimes|required',
            'lastname' => 'sometimes|required',
            'username' => 'sometimes|required|unique:users,username,' . $user->id,
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'phone' => 'sometimes|required',
            'language_id' => 'required|sometimes',
            'price_range_id' => 'required|sometimes',
            'debt_balance' => 'numeric',
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
                return back()->with('error', 'Image could not be uploaded.');
            }
        }


        $user->firstname = $userData['firstname'];
        $user->lastname = $userData['lastname'];
        $user->username = $userData['username'];
        $user->email = $userData['email'];
        $user->phone = $userData['phone'];
        $user->address = $userData['address'];
        if ($request['debt_balance'] != null) {
            $user->debt_balance = $userData['debt_balance'];
        }

        $user->status = ($userData['status'] == 'on') ? 0 : 1;
        if ($request['is_debt'] != null) {
            $user->is_debt = ($userData['is_debt'] == 'on') ? 0 : 1;
        }
        $user->email_verification = ($userData['email_verification'] == 'on') ? 0 : 1;
        $user->sms_verification = ($userData['sms_verification'] == 'on') ? 0 : 1;
//        $user->is_special = ($userData['is_special'] == 'on') ? 0 : 1;
        $user->is_const_price_range = ($userData['is_const_price_range'] == 'on') ? 0 : 1;
        if (isset($userData['language_id'])) {
            $user->language_id = @$userData['language_id'];
        }
        if (isset($userData['agent_id'])) {
            $user->user_id = @$userData['agent_id'];
        }
        if (isset($userData['price_range_id'])) {
            if ($user->price_range_id != $userData['price_range_id']) {
                $lastUserPriceRange = UserPriceRange::where('user_id', $user->id)->where('price_range_type', '-')->orderBy('id', 'desc')->first();

                if ($lastUserPriceRange != null) {
//                    dd(Order::where('user_id',$user->id)->whereDate('created_at','>=', $lastUserPriceRange->created_at->format('Y-m-d'))->get());
                    $total = Order::where('user_id', $user->id)->whereDate('created_at', '>=', $lastUserPriceRange->created_at->format('Y-m-d'))->sum('price');
//                    dd($total);
                } else {
                    $total = 0;
                }
                $userPriceRange = new UserPriceRange();
                $userPriceRange->user_id = $user->id;
                $userPriceRange->price_range_id = $user->price_range_id;
                $userPriceRange->price_range_type = $user->price_range_id > $userData['price_range_id'] ? '-' : '+';
                $userPriceRange->total = $user->price_range_id < $userData['price_range_id'] ? 0 : $total;
                $userPriceRange->save();
            }
            $user->price_range_id = @$userData['price_range_id'];
        }
        $user->save();

        return back()->with('success', 'Updated Successfully.');
    }

    public function passwordUpdate(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:5|same:password_confirmation',
        ]);
        $user = User::findOrFail($id);
        $user->password = bcrypt($request->password);
        $user->save();


        $this->sendMailSms($user, 'PASSWORD_CHANGED', [
            'password' => $request->password
        ]);
        return back()->with('success', 'Updated Successfully.');
    }


    public function userBalanceUpdate(Request $request, $id)
    {
        $userData = Purify::clean($request->all());
        if ($userData['balance'] == null) {
            return back()->with('error', 'Balance Value Empty!');
        } else {
            $control = (object)config('basic');
            $user = User::findOrFail($id);


            if ($userData['add_status'] == "1") {
                $user->balance += $userData['balance'];
                $user->debt += $userData['balance'];
                $user->save();

                $transaction = new Transaction();
                $transaction->user_id = $user->id;
                $transaction->trx_type = '+';
                $transaction->amount = $userData['balance'];
                $transaction->charge = 0;
                $transaction->remarks = 'Add Balance';
                $transaction->trx_id = strRandom();
                $transaction->save();

                $debt = new Debt();
                $debt->order_id = 0;
                $debt->user_id = $user->id;
                $debt->agent_id = 0;
                $debt->debt = $userData['balance'];
                $debt->status = 1;
                $debt->despite = 0;
                $debt->is_for_admin = 1;
                $debt->save();


                $msg = [
                    'amount' => getAmount($userData['balance']),
                    'currency' => $control->currency,
                    'main_balance' => $user->balance,
                    'transaction' => $transaction->trx_id
                ];
                $action = [
                    "link" => '#',
                    "icon" => "fa fa-money-bill-alt text-white"
                ];

                $this->userPushNotification($user, 'ADD_BALANCE', $msg, $action);


                $this->sendMailSms($user, 'ADD_BALANCE', [
                    'amount' => getAmount($userData['balance']),
                    'currency' => $control->currency,
                    'main_balance' => $user->balance,
                    'transaction' => $transaction->trx_id
                ]);

                return back()->with('success', 'Balance Add Successfully.');

            } else {

                if ($userData['balance'] > $user->balance) {
                    return back()->with('error', 'Insufficient Balance to deducted.');
                }
                $user->balance -= $userData['balance'];
                $user->save();


                $transaction = new Transaction();
                $transaction->user_id = $user->id;
                $transaction->trx_type = '-';
                $transaction->amount = $userData['balance'];
                $transaction->charge = 0;
                $transaction->remarks = 'Add Balance';
                $transaction->trx_id = strRandom();
                $transaction->save();


                $msg = [
                    'amount' => getAmount($userData['balance']),
                    'currency' => $control->currency,
                    'main_balance' => $user->balance,
                    'transaction' => $transaction->trx_id
                ];
                $action = [
                    "link" => '#',
                    "icon" => "fa fa-money-bill-alt text-white"
                ];

                $this->userPushNotification($user, 'DEDUCTED_BALANCE', $msg, $action);


                $this->sendMailSms($user, 'DEDUCTED_BALANCE', [
                    'amount' => getAmount($userData['balance']),
                    'currency' => $control->currency,
                    'main_balance' => $user->balance,
                    'transaction' => $transaction->trx_id,
                ]);


                return back()->with('success', 'Balance deducted Successfully.');
            }
        }


    }

    public function keyGenerate(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $user->api_token = Str::random(20);
        $user->save();

        return $user->api_token;
    }

    public function addDebtPayment($id)
    {
        $user = User::findOrFail($id);
        return view('admin.pages.users.add_debt_payment', compact('user'));
    }

    public function payDebt(Request $request, $id)
    {

        $req = Purify::clean($request->all());
        $rules = [
            'amount' => 'required|numeric|min:0',
        ];

        $message = [
            'amount.required' => 'Balance is required',
            'amount.numeric' => 'Balance is Must Be Number',
        ];
        $Validator = Validator::make($req, $rules, $message);

        if ($Validator->fails()) {
            return back()->withErrors($Validator)->withInput();
        }
        $user = User::findOrFail($id);
        $balance = $req['amount'];

//dd($balance);
        if ($balance <= $user->debt) {
            $user->debt -= $balance;


//            $transactionForUser = new Transaction();
//            $transactionForUser->user_id = $user->id;
//            $transactionForUser->trx_type = '-';
//            $transactionForUser->amount = $balance;
//            $transactionForUser->remarks = 'Pay A Debt';
//            $transactionForUser->trx_id = strRandom();
//            $transactionForUser->charge = 0;


            $debt = new Debt();
            $debt->order_id = 0;
            $debt->user_id = $user->id;
            $debt->agent_id = 0;
            $debt->debt = $balance;
            $debt->status = 1;
            $debt->is_for_admin = 1;
            $debt->despite = 1;
            $debt->save();

            $basic = (object)config('basic');
            if ($user->save()) {
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
                    return back()->with('success', 'Balance Added Successfully.');
//                } else {
//                    return back()->with('error', 'Balance Do Not Added Successfully.');
//                }

            } else {
                return back()->with('error', 'Balance Do Not Added Successfully.');
            }
        } else {

            return back()->with('error', 'The debt payment must not be greater than the debt.');

        }


    }


    public function sendEmail($id)
    {
        $user = User::findOrFail($id);
        return view('admin.pages.users.sendemail', compact('user'));
    }

    public function sendMailUser(Request $request, $id)
    {
        $req = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'subject' => 'sometimes|required',
            'message' => 'sometimes|required'
        ];
        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user = User::findOrFail($id);

        $state = $this->mail($user, null, [], $req['subject'], $req['message']);
        return back()->with('success', 'Mail Send Successfully');
    }


    public function sendMailUsers()
    {
        return view('admin.pages.users.alluser_messagebox');
    }

    public function sendMailUsersStore(Request $request)
    {
        $req = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'subject' => 'sometimes|required',
            'message' => 'sometimes|required'
        ];
        $validator = Validator::make($req, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $allUsers = User::where('status', 1)->get();
        foreach ($allUsers as $user) {
            $this->mail($user, null, [], $req['subject'], $req['message']);
        }
        return back()->with('success', 'Mail Send Successfully');
    }


    public function getService(Request $request)
    {
        $rules = [
            'category_id' => 'sometimes|required',
            'service_id' => 'sometimes|required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 200);
        }
        if ($request->has('category_id')) {

            $services = Service::where('category_id', $request->category_id)->orderBy('service_title')->get();
            return $services;
        }
        if ($request->has('service_id')) {

            $userServiceRate = UserServiceRate::where('user_id', $request->user_id)->where('service_id', $request->service_id)->first();
            if ($userServiceRate) {
                return $userServiceRate->price;
            }
            return 0;
        }
    }

    public function customRate($id)
    {
        $user = User::with('serviceRates', 'serviceRates.service:id,service_title,price')->findOrFail($id);
        $userServices = $user->serviceRates;
        $title = " ``$user->username`` Custom Rates";
        $categories = Category::where('status', 1)->get();
        return view('admin.pages.users.custom-rates', compact('user', 'userServices', 'title', 'categories'));
    }


    public function setServiceRate(Request $request)
    {
        $rules = [
            'category_id' => 'sometimes|required',
            'service_id' => 'sometimes|required',
            'user_id' => 'sometimes|required',
            'amount' => 'numeric|required|min:0',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 200);
        }

        $service = Service::find($request->service_id);
        if (!$service) {
            return response()->json(['errors' => ['error' => 'Invalid Service']], 200);
        }

        $user = User::find($request->user_id);
        if (!$user) {
            return response()->json(['errors' => ['error' => 'Invalid User']], 200);
        }

        if ($user->status == 0) {
            return response()->json(['errors' => ['error' => 'Invalid User']], 200);
        }

        $userServiceRate = UserServiceRate::firstOrNew([
            'user_id' => $user->id,
            'service_id' => $service->id
        ]);
        $userServiceRate->price = (float)$request->amount;
        $userServiceRate->save();
        $result = $user->serviceRates->map(function ($item) {
            return [
                'id' => $item->id,
                'user_id' => $item->user_id,
                'service_id' => $item->service_id,
                'price' => $item->price,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'service' => [
                    'id' => $item->service->id,
                    'service_title' => $item->service->service_title,
                    'price' => $item->service->price,
                    'provider_name' => $item->service->provider_name
                ]
            ];
        });

        return response()->json([
            'success' => 'Added Successfully',
            'userServices' => $result
        ], 200);

    }

    public function updateServiceRate(Request $request)
    {
        $rules = [
            'id' => 'sometimes|required',
            'amount' => 'numeric|required|min:0',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 200);
        }
        $data = UserServiceRate::find($request->id);
        $data->price = $request->amount;
        $data->save();
    }

    public function deleteServiceRate(Request $request)
    {
        $rules = [
            'id' => 'sometimes|required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 200);
        }
        $data = UserServiceRate::find($request->id);
        $data->delete();

        return response()->json([
            'success' => 'Delete Successfully'
        ], 200);
    }

    public function user_fundLog($id)
    {
        $user = User::findOrFail($id);
//        $userid = $user->id;
//
//        $funds = $user->funds()->paginate(config('basic.paginate'));
        return view('admin.pages.agent.user-fund-log', compact('user'));
    }

    public function user_fundLogSearch(Request $request,$id)
    {
        $search = $request->all();
        $user = User::findOrFail($id);
        $dateSearch = $request->datetrx;
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

        return view('admin.pages.agent.user-fund-log', compact('user'));
    }
}
