<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Http\Traits\Notify;
use App\Models\AgentCommissionRate;
use App\Models\ApiProvider;
use App\Models\Category;
use App\Models\Order;
use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Ixudra\Curl\Facades\Curl;
use Stevebauman\Purify\Facades\Purify;

class OrderController extends Controller
{
    use Notify;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with(['users', 'service'])->latest()->where('user_id', Auth::id())->paginate();
//        dd($orders);
        return view('agent.pages.order.show', compact('orders'));
    }

    public function search(Request $request)
    {
        $search = @$request->search;
        $status = @$request->status;
        $dateSearch = @$request->date_order;

        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);
        $orders = Order::where('user_id', Auth::id())
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
        return view('agent.pages.order.show', compact('orders'));
    }


    public function statusSearch(Request $request, $name = 'awaiting')
    {
        $status = @$name;
        $orders = Order::with('service', 'users')
            ->where(['user_id' => Auth::id()])
            ->when($status != -1, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->paginate(config('basic.paginate'));
        return view('agent.pages.order.show', compact('orders'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $serviceId = @$request->serviceId;
        if (isset($serviceId)) {
            $data['selectService'] = Service::where('service_status', 1)->userRate()->with('category')->find($serviceId);
        }
        $data['categories'] = Category::with('service')
            ->whereHas('service', function ($query) {
                $query->where('service_status', 1)->userRate();
            })
            ->get();
        return view('agent.pages.order.add', $data, compact('serviceId'));
    }

    public function userservice(Request $request)
    {
        $serid = $request->ser_id;
        $service = Service::where('id', $serid)->userRate()->first();
        $user = Auth::user();
        if ($user != null) {
            if ($user->is_special == 1 && $service->special_price != null) {
                $service->price = $service->special_price;
            }
        }
        return $service;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $req = Purify::clean($request->all());
        $rules = [
            'category' => 'required|integer|min:1|not_in:0',
            'service' => 'required|integer|min:1|not_in:0',
//            'link' => 'required',
//            'quantity' => 'required|integer',
//            'check' => 'required',
        ];
        if (!isset($request->drip_feed)) {
            $rules['runs'] = 'required|integer|not_in:0';
            $rules['interval'] = 'required|integer|not_in:0';
        }
//        $validator = Validator::make($req, $rules);
//        if ($validator->fails()) {
//            return back()->withErrors($validator)->withInput();
//        }
//        $coupon = Coupon::where('code',$request->coupon)->where('status',1)->get()->first();

        $service = Service::userRate()->findOrFail($request->service);
        if ($service->category->type == 'CODE' || $service->category->type == 'OTHER') {
            $serviceCode = $service->service_code->where('is_used', 0)->first();
            if ($serviceCode == null) {
                return back()->with('error', trans("No Code Available ,Please Contact with Support To Order Code."))->withInput();
            }
        }
        $user = Auth::user();
        if ($user != null) {
            if ($user->is_special == 1 && $service->special_price != null) {
                $service->price = $service->special_price;
            }
        }


        $basic = (object)config('basic');

        $quantity = $request->quantity;

        if ($service->drip_feed == 1) {
            if (!isset($request->drip_feed)) {
                $rules['runs'] = 'required|integer|not_in:0';
                $rules['interval'] = 'required|integer|not_in:0';
                $validator = Validator::make($req, $rules);
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }
                $quantity = $request->quantity * $request->runs;
            }
        }
        if ($service->min_amount <= $quantity && $service->max_amount >= $quantity) {
            $userRate = ($service->user_rate) ?? $service->price;
//            if ($coupon != null && $coupon->number_of_beneficiaries != null && $coupon->number_of_use != $coupon->number_of_beneficiaries){
//                $price = round(($quantity * $userRate), 2);
//                if ($coupon->is_percent == 1){
//                    $price = $price * $coupon->sale /100;
//                }else{
//                    $price -= $coupon->sale;
//                }
//            }else{
//
//            }

            $price = round(($quantity * $userRate), 2);
            $user = Auth::user();
            if ($user->balance < $price) {
                if ($user->is_debt != 1 || $user->balance + $user->debt_balance < $price){
                    return back()->with('error', trans("Insufficient balance in your wallet."))->withInput();
                }

            }
            $order = new Order();
            $order->user_id = $user->id;
            $order->category_id = $req['category'];
            $order->service_id = $req['service'];

            $order->link = $req['link'];
//            dd($order);
            $order->quantity = $req['quantity'];
            $order->status = 'processing';
            $order->price = $price;
            $order->runs = isset($req['runs']) && !empty($req['runs']) ? $req['runs'] : null;
            $order->interval = isset($req['interval']) && !empty($req['interval']) ? $req['interval'] : null;


            if ($service->category->type == 'CODE' || $service->category->type == 'OTHER') {
                $serviceCode = $service->service_code->where('is_used', 0)->first();
                if ($serviceCode != null) {
                    $order->codes = trans('Service code is : ').$serviceCode->code.trans(', and id is ').$serviceCode->id;
                }
            }elseif ($service->category->type == 'GAME'){
                $order->details = trans('Player Id is : ').$req['link'].trans(', and Name is ').$req['player_name'].trans(', and Service Id is ').$req['service'];
            }
//            if (isset($service->api_provider_id)) {
//                $apiproviderdata = ApiProvider::find($service->api_provider_id);
//                $apiservicedata = Curl::to($apiproviderdata['url'])->withData(['key' => $apiproviderdata['api_key'], 'action' => 'add', 'service' => $service->api_service_id, 'link' => $req['link'], 'quantity' => $req['quantity'], 'runs' => $req['runs'], 'interval' => $req['interval']])->post();
//                $apidata = json_decode($apiservicedata);
//
//                if (isset($apidata->order)) {
//                    $order->status_description = "order: {$apidata->order}";
//                    $order->api_order_id = $apidata->order;
//                } else {
//                    $order->status_description = "error: {$apidata->error}";
//                }
//            }
            $order->save();
            if ($user->balance < $price) {
                if ($user->user_id != null && $user->parent->is_agent == 1 && $user->parent->is_approved == 1 && $user->is_debt == 1 && $user->balance + $user->debt_balance >= $price){
                    if ($user->balance >= 0){
                        $agentDiscount = $price - $user->balance;
                    }else{
                        $agentDiscount = $price ;
                    }

                    $user->balance -= $price;
                    $user->parent->balance -= $agentDiscount;
                    $user->save();
                    $user->parent->save();
                }else{
                    return back()->with('error', trans("Insufficient balance in your wallet."))->withInput();
                }

            }else{
                $user->balance -= $price;
                $user->save();
            }
            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->trx_type = '-';
            $transaction->amount = $price;
            $transaction->remarks = 'Place order';
            $transaction->trx_id = strRandom();
            $transaction->charge = 0;
            $transaction->save();

            if ($user->user_id != null && $user->parent->is_agent == 1 && $user->parent->is_approved == 1){
                $commision = new AgentCommissionRate();
                $rate = $service->agent_commission_rate ;
                $commision->user_id = $user->id;
                $commision->order_id = $order->id;
                $commision->commission_rate = ($service->price * $rate / 100) * $quantity ;
                $commision->save();

            }


            $msg = [
                'username' => $user->username,
                'price' => $price,
                'currency' => $basic->currency
            ];
            $action = [
                "link" => route('admin.order.edit', $order->id),
                "icon" => "fas fa-cart-plus text-white"
            ];
            $this->adminPushNotification('ORDER_CREATE', $msg, $action);

            if ($service->category->type == 'CODE' || $service->category->type == 'OTHER') {
                $serviceCode = $service->service_code->where('is_used', 0)->first();
                if ($serviceCode != null) {
//                    $this->sendMailSms($user, 'ORDER_CONFIRM_FOR_GAME', [
//                        'order_id' => $order->id,
//                        'order_at' => $order->created_at,
//                        'service' => optional($order->service)->service_title,
//                        'status' => $order->status,
//                        'paid_amount' => $price,
//                        'remaining_balance' => $user->balance,
//                        'currency' => $basic->currency,
//                        'transaction' => $transaction->trx_id,
//                        'your-code' => $serviceCode->code,
//
//                    ]);
                    $serviceCode->is_used = 1;
                    $serviceCode->user_id = $user->id;
                    $serviceCode->save();
                    return back()->with('success', trans('Your order has been submitted'));
                } else {
                    return back()->with('error', trans("No Code Available ,Please Contact with Support To Order Code."))->withInput();
                }
            }else{
                $this->sendMailSms($user, 'ORDER_CONFIRM', [
                    'order_id' => $order->id,
                    'order_at' => $order->created_at,
                    'service' => optional($order->service)->service_title,
                    'status' => $order->status,
                    'paid_amount' => $price,
                    'remaining_balance' => $user->balance,
                    'currency' => $basic->currency,
                    'transaction' => $transaction->trx_id,
                ]);
                return back()->with('success', trans('Your order has been submitted'));
            }





        } else {
            return back()->with('error',trans("Order quantity should be minimum") . $service->min_amount.trans('and maximum').  $service->max_amount)->withInput();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $order = Order::find($order->id);
        return view('agent.pages.order.edit', compact('order'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order = Order::find($order->id);
        $order->delete();
        return back()->with('success', trans('Successfully Deleted'));
    }

    public function statusChange(Request $request)
    {
        $req = Purify::clean($request->all());
        $order = Order::find($request->id);
        $order->status = $req['statusChange'];
        $order->save();
        return back()->with('success', trans('Successfully Updated'));
    }

    public function getservice(Request $request)
    {
        $service = Service::where('service_status')->where('service_title', 'LIKE', "%{$request->service}%")->get()->pluck('service_title');
        $user = Auth::user();
        if ($user != null) {
            if ($user->is_special == 1 && $service->special_price != null) {
                $service->price = $service->special_price;
            }
        }
        return response()->json($service);
    }

    public function massOrder()
    {
        return view('agent.pages.order.add_mass_order');
    }


    public function masOrderStore(Request $request)
    {
        $req = Purify::clean($request->all());
        $rules = [
            'mass_order' => 'required',
        ];
        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $orders = explode("\n", $req['mass_order']);

        $basic = (object)config('basic');

        foreach ($orders as $order) {
            $singleOrder = trim(explode("|", $order));
            $serviceid = Service::userRate()->find($singleOrder[0]);
            $user = Auth::user();
            if ($user != null) {
                if ($user->is_special == 1 && $serviceid->special_price != null) {
                    $serviceid->price = $serviceid->special_price;
                }
            }
            if ($serviceid) {
                $specificRate = ($serviceid->user_rate) ?? $serviceid->price;

                $orderM = new Order();
                $orderM->service_id = $singleOrder[0];
                $orderM->quantity = $singleOrder[1];
                $orderM->link = $singleOrder[2];


                $orderM->price = round(($singleOrder[1] * $specificRate), 2);
                if ($serviceid->service_status == 1) {

                    $user = $this->user;
                    $orderM->user_id = $user->id;


                    if (isset($singleOrder[1]) && !empty($singleOrder[1]) && $singleOrder[1] % 1 == 0) {
                        if ($serviceid->min_amount <= $singleOrder[1] && $serviceid->max_amount >= $singleOrder[1]) {

                            if (isset($singleOrder[2]) && !empty($singleOrder[2])) {
                                if ($user->balance >= $orderM->price) {
                                    $user->balance -= $orderM->price;
                                    $user->save();

                                    if (isset($service->api_provider_id)) {
                                        $apiproviderdata = ApiProvider::find($serviceid->api_provider_id);
                                        if ($apiproviderdata) {
                                            $apiservicedata = Curl::to($singleOrder[2])->withData(['key' => $apiproviderdata['api_key'], 'action' => 'add', 'service' => $serviceid->api_service_id, 'link' => $singleOrder[2], 'quantity' => $singleOrder[1]])->post();
                                            $apidata = json_decode($apiservicedata);
                                            if (isset($apidata->order)) {
                                                $orderM->status_description = "order: {$apidata->order}";
                                                $orderM->api_order_id = $apidata->order;
                                            } else {
                                                $orderM->status_description = "error: {$apidata->error}";
                                            }
                                        }
                                    }

                                    $transaction = new Transaction();
                                    $transaction->user_id = $user->id;
                                    $transaction->trx_type = '-';
                                    $transaction->amount = $orderM->price;
                                    $transaction->charge = 0;
                                    $transaction->remarks = 'Place order';
                                    $transaction->trx_id = strRandom();
                                    $transaction->save();

                                    $this->sendMailSms($user, 'ORDER_CONFIRM', [
                                        'order_id' => $orderM->id,
                                        'order_at' => $orderM->created_at,
                                        'service' => optional($orderM->service)->service_title,
                                        'status' => $orderM->status,
                                        'paid_amount' => $orderM->price,
                                        'remaining_balance' => $user->balance,
                                        'currency' => $basic->currency,
                                        'transaction' => $transaction->trx_id,
                                    ]);


                                    $msg = ['username' => $user->username, 'price' => $orderM->price, 'currency' => $basic->currency];
                                    $action = [
                                        "link" => route('admin.order.edit', $orderM->id),
                                        "icon" => "fas fa-cart-plus text-white"
                                    ];
                                    $this->adminPushNotification('ORDER_CREATE', $msg, $action);


                                } else {
                                    $orderM->reason = trans("Insufficient balance in your wallet");
                                    $orderM->status = trans('canceled');
                                }
                            } else {
                                $orderM->reason = trans("Link is Invalid");
                                $orderM->status =trans( 'canceled');
                            }

                        } else {
                            $orderM->reason = "Order quantity should be minimum {$serviceid->min_amount} and maximum {$serviceid->max_amount}";
                            $orderM->status = trans( 'canceled');
                        }
                    } else {
                        $orderM->reason = trans( "Invalid Quantity");
                        $orderM->status = trans( 'canceled');
                    }

                } else {
                    $orderM->reason = trans( "Service not available");
                    $orderM->status = trans( 'canceled');
                }
                $orderM->save();
            }

        }
        return back()->with('success', trans('Successfully Added'));
    }

}
