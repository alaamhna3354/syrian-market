<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiProviderController;
use App\Http\Controllers\Controller;
use App\Http\Traits\Notify;
use App\Models\AgentCommissionRate;
use App\Models\ApiProvider;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Debt;
use App\Models\Order;
use App\Models\PriceRange;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserPriceRange;
use App\Services\PointsService;
use CoinGate\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Ixudra\Curl\Facades\Curl;
use Stevebauman\Purify\Facades\Purify;

class OrderController extends Controller
{
    use Notify;

    private $pointService;

    public function __construct(PointsService $pointsService)
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
        $this->pointService = $pointsService;
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
        return view('user.pages.order.show', compact('orders'));
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
        return view('user.pages.order.show', compact('orders'));
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
        return view('user.pages.order.show', compact('orders'));
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
        return view('user.pages.order.add', $data, compact('serviceId'));
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
    public function store(Request $request, $apiUser = null)
    {
        $req = $request->all();
        $rules = [
            'category' => 'required|integer|min:1|not_in:0',
            'service' => 'required|integer|min:1|not_in:0',
        ];

        $service = Service::userRate()->findOrFail($request->service);
        if ($service->category->type == 'CODE') {
            $serviceCode = $service->service_code->where('is_used', 0)->first();
            if ($serviceCode == null) {
                return back()->with('error', trans("No Code Available ,Please Contact with Support To Order Code."))->withInput();
            }
        }
        $user = $apiUser ? $apiUser : Auth::user();
        if ($user != null) {
            if (!($service->price != null && $service->price != 0)) {
                $user_range = $user->priceRange;
                $range = $service->service_price_ranges()->where('price_range_id', $user_range->id)->first();
                $service->price = $range->price;
                $service->agent_commission_rate = $range->agent_commission_rate;
            }
        }
        $basic = (object)config('basic');
        if ($service->category->type == 'CODE' || $service->category->type == '5SIM' || $service->category->type == 'NUMBER')
            $quantity = 1;
        else
            $quantity = $request->quantity;

        if (($service->min_amount <= $quantity && $service->max_amount >= $quantity) || ($service->min_amount == 0 && $service->max_amount == 0)) {
            $userRate = ($service->user_rate) ?? $service->price;
            $price = round(($quantity * $userRate), 2);
            if ($service->category->type == 'SMM')
                $price = $price / 1000;
            $user = Auth::user();
            if ($user->balance < $price) {
                if ($apiUser)
                    return response()->json(['errors' => ['message' => trans("Insufficient balance.")]], 422);
                else
                    return back()->with('error', trans("Insufficient balance in your wallet."))->withInput();
            }
            $order = new Order();
            $order->user_id = $user->id;
            $order->category_id = @$service->category->id;
            $order->service_id = $req['service'];
            $order->link = $req['link'];
            $order->quantity = $req['quantity'];
            $order->status = 'processing';
            $order->price = $price;
            $order->runs = isset($req['runs']) && !empty($req['runs']) ? $req['runs'] : null;
            $order->interval = isset($req['interval']) && !empty($req['interval']) ? $req['interval'] : null;
            //////////////////////   place Order from custom provider ////////////////////////////
            if (isset($service->api_provider_id) && $service->api_provider_id != 0) {

                $apidata = $this->placeOrderFromCustomApiProvider($service, $quantity, $req['link'], @$req['player_name']);
                if ($service->api_provider_id == 1) {
                    if (isset($apidata['orderid'])) {
                        $order->status_description = "order: {$apidata['orderid']}";
                        $order->api_order_id = $apidata['orderid'];
                    } else {
                        if ($apiUser)
                            return response()->json(['errors' => ['message' => trans("This service is currently unavailable, try again later.")]], 422);
                        else
                            return back()->with('error', trans("This service is currently unavailable, try again later."))->withInput();
                        // $order->status_description = "error: {$apidata['message']}";
                    }
                } elseif ($service->api_provider_id == 2) {
                    if (isset($apidata['code']) && $apidata['code'] == 1) {
                        $order->status_description = "order: {$apidata['orderId']}";
                        $order->api_order_id = $apidata['orderId'];
                    } else {
                        if ($apiUser)
                            return response()->json(['errors' => ['message' => @$apidata['status']]], 422);
                        else
                            return back()->with('error', "error" . @$apidata['status'])->withInput();
                        // $order->status_description = "error: {$apidata['message']}";
                    }
                } elseif ($service->api_provider_id == 3) {
                    if (isset($apidata['status']) && $apidata['status'] == "success") {
                        $order->status_description = "order: {$apidata['order']}";
                        $order->api_order_id = $apidata['order'];
                    } else {
                        if ($apiUser)
                            return response()->json(['errors' => ['message' => @$apidata['status']]], 422);
                        else
                            return back()->with('error', "error" . @$apidata['status'])->withInput();
                        // $order->status_description = "error: {$apidata['message']}";
                    }
                }
            }
            ////////////////////// End  place Order from custom provider ////////////////////////////
            if ($service->category->type == 'CODE') {
                $serviceCode = $service->service_code->where('is_used', 0)->first();
                if ($serviceCode != null) {
                    $order->code = trans('Service code is : ') . $serviceCode->code . trans(', and id is ') . $serviceCode->id;
                }

            } elseif ($service->category->type == 'GAME') {
                $order->details = trans('Player Id is : ') . "<span id='number' style=\"color:blue\" onclick='copy(" . $req['link'] . ")' >" . $req['link'] . "</span>" . trans(', and Name is ') . $req['player_name'] . trans(', and Service Id is ') . $req['service'];
            } elseif ($service->category->type == '5SIM') {
                $codes = (new ApiProviderController)->fivesim($service->api_service_params);
                if ($codes == 0)
                    if ($apiUser)
                        return response()->json(['errors' => ['message' => trans("حاول لاحقا او تواصل مع مدير الموقع")]], 422);
                    else
                        return back()->with('error', trans("حاول لاحقا او تواصل مع مدير الموقع"))->withInput();
                else {
                    $order->code = $codes['phone'];
                    $order->order_id_api = $codes['id'];
                    $order->status = 'code-waiting';
                }
            } elseif ($service->category->type == 'NUMBER') {
                $order->code = $apidata['link'];
                $order->order_id_api = $apidata['order'];
                $order->status = 'code-waiting';
            }

            $order->save();

////////////////////////            change Price Range     /////////////////////////////
            if ($user->is_const_price_range == 0) {
                $lastUserPriceRange = UserPriceRange::where('user_id', $user->id)->orderBy('id', 'desc')->first();
//                dd($lastUserPriceRange);
                if ($lastUserPriceRange != null) {
                    $lastUserPriceRange->total += $price;
                    $lastUserPriceRange->save();
                } else {
                    $total = $price;
                    $userPriceRange = new UserPriceRange();
                    $userPriceRange->user_id = $user->id;
                    $userPriceRange->price_range_id = $user->price_range_id;
                    $userPriceRange->price_range_type = '+';
                    $userPriceRange->total = $total;
                    $userPriceRange->save();
                }
                $lastUserPriceRange = UserPriceRange::where('user_id', $user->id)->orderBy('id', 'desc')->first();
                $current_user_price_range = $user->priceRange;
                $nextPriceRange = PriceRange::find($current_user_price_range->id + 1);
                if ($nextPriceRange != null) {
                    if ($lastUserPriceRange->total >= $nextPriceRange->min_total_amount) {
                        $userPriceRange = new UserPriceRange();
                        $userPriceRange->user_id = $user->id;
                        $userPriceRange->price_range_id = $user->price_range_id;
                        $userPriceRange->price_range_type = '+';
                        $userPriceRange->total = 0;
                        $userPriceRange->save();
                        $user->price_range_id = $nextPriceRange->id;
                        $user->save();

                        $this->sendMailSms($user, 'CHANGE_USER_LEVEL', [
                            'thisLevel' => $nextPriceRange->name,
                            'lastLevel' => $current_user_price_range->name,

                        ]);
                        $msg = [
                            'username' => $user->username,
                            'level' => $nextPriceRange->name,
                            'status' => "promoted"
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

////////////////////////            End change Price Range     /////////////////////////////

            if ($service->category->type != '5SIM' && $service->category->type != 'NUMBER') {
                $user->balance -= $price;
                $user->save();
                $transaction = new Transaction();
                $transaction->user_id = $user->id;
                $transaction->trx_type = '-';
                $transaction->amount = $price;
                $transaction->remarks = 'Place order';
                $transaction->trx_id = strRandom();
                $transaction->charge = 0;
                $transaction->save();
                if ($service->points > 0)
                    $ptrx = $this->pointService->earnPoints('Buy', $service->points * $order->quantity, 'Earn ' . $service->points * $order->quantity . ' for buying ' . $service->category->category_title . ' > ' . $service->id . ' QTY ' . $order->quantity, $order->id);
                if ($user->user_id != null && $user->parent->is_agent == 1 && $user->parent->is_approved == 1) {
                    $commision = new AgentCommissionRate();
                    $rate = $service->agent_commission_rate;
                    $commision->user_id = $user->parent->id;
                    $commision->order_id = $order->id;
                    $commision->commission_rate = ($service->price * $rate / 100) * $quantity;
                    $commision->save();
                }
            }
            $result['status'] = 'success';
            $result['order'] = $order->id;
            $result['code'] = $order->code;
            $result['details'] = $order->details;
            $result['order_status']=$order->status;
            $result['price']= $order->price;
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
            if ($service->category->type == 'CODE') {
                $serviceCode = $service->service_code->where('is_used', 0)->first();
                if ($serviceCode != null) {
                    $serviceCode->is_used = 1;
                    $serviceCode->user_id = $user->id;
                    $serviceCode->save();
                    $order->status = "completed";
                    $order->save();
                    if ($user->is_agent == 1 && $user->is_approved == 1) {
                        if ($apiUser)
                            return response()->json($result, 200);
                        else
                            return redirect(route('agent.order.index'))->with('success', trans('Your order has been submitted'));
                    } else {
                        if ($apiUser)
                            return response()->json($result, 200);
                        else
                            return redirect(route('user.order.index'))->with('success', trans('Your order has been submitted'));
                    }

//                    return back()->with('success', trans('Your order has been submitted'));
                } else {
                    if ($apiUser)
                        return response()->json(['errors' => ['message' => trans("No Code Available ,Please Contact with Support To Order Code.")]], 422);
                    else
                        return back()->with('error', trans("No Code Available ,Please Contact with Support To Order Code."))->withInput();
                }
            } elseif ($service->category->type == '5SIM') {
                if ($user->is_agent == 1 && $user->is_approved == 1) {
                    if ($apiUser)
                        return response()->json($result, 200);
                    else
                        return redirect(route('agent.order.index'))->with('success', trans('Your order has been submitted'));
                } else {
                    if ($apiUser)
                        return response()->json($result, 200);
                    else
                        return redirect(route('user.order.index'))->with('success', trans('Your order has been submitted'));
                }

            } else {

                if ($user->is_agent == 1 && $user->is_approved == 1) {
                    if ($apiUser)
                        return response()->json($result, 200);
                    else
                        return redirect(route('agent.order.index'))->with('success', trans('Your order has been submitted'));
                } else {
                    if ($apiUser)
                        return response()->json($result, 200);
                    else
                        return redirect(route('user.order.index'))->with('success', trans('Your order has been submitted'));
                }
            }

        } else {
            if ($apiUser)
                return response()->json(['errors' => ['message' => "Order quantity should be minimum {$service->min_amount} and maximum {$service->max_amount}"]], 422);
            else
                return back()->with('error', "Order quantity should be minimum {$service->min_amount} and maximum {$service->max_amount}")->withInput();
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
        return view('user.pages.order.edit', compact('order'));
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
        return view('user.pages.order.add_mass_order');
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
                                $orderM->status = trans('canceled');
                            }

                        } else {
                            $orderM->reason = "Order quantity should be minimum {$serviceid->min_amount} and maximum {$serviceid->max_amount}";
                            $orderM->status = trans('canceled');
                        }
                    } else {
                        $orderM->reason = trans("Invalid Quantity");
                        $orderM->status = trans('canceled');
                    }

                } else {
                    $orderM->reason = trans("Service not available");
                    $orderM->status = trans('canceled');
                }
                $orderM->save();
            }

        }
        return back()->with('success', trans('Successfully Added'));
    }

    public function finish5SImOrder($id, $result)
    {
        $order = Order::find($id);
        $user = $order->users;
        if ($user->balance < $order->price) {
            $notify[] = ['error', 'Insufficient balance. Please deposit and try again!'];
            return back()->withNotify($notify);
        }
        $user->balance -= $order->price;
        $user->save();
        $order->status = 'completed';
        $order->verify = $result['sms'][0]['code'] ?? $result['smsCode'] ?? ' ';
        $order->save();

        //Create Transaction
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->trx_type = '-';
        $transaction->amount = $order->price;
        $transaction->remarks = 'Place order';
        $transaction->trx_id = strRandom();
        $transaction->charge = 0;
        $transaction->save();
        if ($order->service->point > 0)
            $this->pointService->earnPoints('Buy', $order->service->point, 'Earn ' . $order->service->point . ' for buying product number ' . $order->service, $order->id);

        if ($user->user_id != null && $user->parent->is_agent == 1 && $user->parent->is_approved == 1) {
            $commision = new AgentCommissionRate();
            $rate = $order->service->agent_commission_rate;
            $commision->user_id = $user->parent->id;
            $commision->order_id = $order->id;
            $commision->commission_rate = ($order->service->price * $rate / 100);
            $commision->save();

        }
        return $result['sms'][0]['code'] ?? $result['smsCode'];
//        $notify[] = ['success', 'Successfully placed your order!'];
//        return back()->withNotify($notify);

    }

    public function placeOrderFromCustomApiProvider($service, $quantity, $playerId, $playerName = null)
    {
        $apiproviderdata = ApiProvider::find($service->api_provider_id);
        if ($apiproviderdata->id == 1) {
            $order_token = (string)Str::orderedUuid();
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://private-anon-4f7942c0cb-as7abcard.apiary-proxy.com/api/v1/createOrder/");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            if ($service->api_service_params == 'amount') {
                $fields = <<<EOT
            {
         "items": [
          {
             "denomination_id": $service->api_service_id,
            "qty": 1,
            "amount": $quantity
           }
          ],
          "args": {
            "playerid": "{$playerId}"
          },
          "orderToken": "{$order_token}"
        }
        EOT;
            } else {
                $fields = <<<EOT
{
  "items": [
    {
      "denomination_id": $service->api_service_id,

      "qty": $quantity
    }
  ],
  "args": {
    "playerid": "{$playerId}"
  },
  "orderToken": "{$order_token}"
}
EOT;
            }
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "Authorization: Bearer " . $apiproviderdata->api_key
            ));
            $response = curl_exec($ch);
            $info = curl_getinfo($ch);
            curl_close($ch);

// var_dump($info["http_code"]);
// dd($response);
        } elseif ($apiproviderdata->id == 2) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiproviderdata->url . "RequestOrder?API={$apiproviderdata->api_key}&productId={$service->api_service_id}&amount=$quantity&playernumber=$playerId&playername=" . str_replace(' ', '%20', $playerName));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            $response = curl_exec($ch);
            $info = curl_getinfo($ch);
            curl_close($ch);
//            $response='{"Code": 1, "Status": "1 - عملية التحويل تمت بنجاح", "OrderId": 123, "PlayerNumber": "123456", "PlayerName": "PlayerName", "BalanceBefor": 10, "BalanceAfter": 9.5, "Value1": 1, "Value2":-0.5}';
        } else {
            $this->base_url = $apiproviderdata->url;
            $params = [
                'key' => $apiproviderdata->api_key,
                'action' => 'add',
                'service' => $service->api_service_id,
                'link' => @$playerId,
                'quantity' => $quantity,
                'runs' => 1,
                'interval' => 1

            ];
            $response = Curl::to($this->base_url)
                ->withData($params)->post();
//            $response ='{"status":"success","order":37,"link":"15793308141"}';
//            $url = $this->base_url;
//            curl_setopt($ch, CURLOPT_URL, $url);
//            curl_setopt($ch, CURLOPT_POST, 1);
//            curl_setopt($ch, CURLOPT_HEADER, 0);
//            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//            $response = curl_exec($ch);
//            dd($response);
//            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//            if ($httpcode!=200) {
//                Log::info($httpcode);
//                Log::info(curl_getinfo($ch));
//                Log::info(json_decode($response, True));
//            }
        }
        return json_decode($response, true);
    }
}
