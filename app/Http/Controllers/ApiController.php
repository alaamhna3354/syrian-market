<?php

namespace App\Http\Controllers;

use App\Http\Traits\Notify;
use App\Models\AgentCommissionRate;
use App\Models\ApiProvider;
use App\Models\Category;
use App\Models\Order;
use App\Models\PriceRange;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserPriceRange;
use App\Models\UserServiceRate;
use Dompdf\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\DateTime;
use Stevebauman\Purify\Facades\Purify;

class ApiController extends Controller
{
    use Notify;
    private $serviceController;
    private $five_sim;

    public function __construct(\App\Http\Controllers\User\ServiceController $serviceController, ApiProviderController $apiProviderController)
    {
        $this->serviceController = $serviceController;
        $this->five_sim = $apiProviderController;
    }

    public function place_order()
    {
        return Order::all();
    }

    public function apiV1(Request $request)
    {
        $req = Purify::clean($request->all());
        $validator = Validator::make($req, [
            'key' => 'required',
            'action' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $actionList = ['balance', 'services', 'add', 'status', 'orders', 'categories', 'player','check_sms','sync_orders'];
        if (!in_array($req['action'], $actionList)) {
            return response()->json(['errors' => ['action' => trans("Invalid request action")]], 422);
        }

        $user = User::where('api_token', $req['key'])->first(['id', 'api_token', 'status', 'balance']);
        if (!$user) {
            return response()->json(['errors' => ['key' => "Invalid Key"]], 422);
        }
        if ($user->status == 0) {
            return response()->json(['errors' => ['message' => trans("This credential is no longer")]], 422);
        }


        $basic = (object)config('basic');
        if (strtolower($req['action']) == 'balance') {
            $result['status'] = 'success';
            $result['balance'] = $user->balance;
            $result['currency'] = $basic->currency;
            return response()->json($result, 200);

        }

        //Services
        elseif (strtolower($req['action']) == 'services') {
            $result = Service::where('service_status', 1)->orderBy('category_id', 'asc')->get()
                ->map(function ($service) use ($user) {
                    return [
                        'service' => $service->id,
                        'name' => $service->service_title,
                        'category' => optional($service->category)->category_title,
                        'category_id' => $service->category,
                        'rate' => $this->servicePrice($service,$user),
                        'min' => $service->min_amount,
                        'max' => $service->max_amount,
                        'is_available' => $service->is_available
                    ];
                });
            return response()->json($result, 200);

        }
        //Status
        elseif (strtolower($req['action']) == 'status') {

            $validator = Validator::make($req, [
                'order' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $order = Order::where('id', $req['order'])->where('user_id', $user->id)->first();
            if (!$order) {
                return response()->json(['errors' => ['message' => trans("Invalid Order")]], 422);
            }
            $result['status'] = $order->status;
            $result['currency'] = $basic->currency;
            $result['order'] = $order->id;
            $result['code'] = $order->code;
            $result['details'] = $order->details;
            $result['price']= $order->price;

            return response()->json($result, 200);

        }
        //Orders
        elseif (strtolower($req['action']) == 'orders') {
            $validator = Validator::make($req, [
                'orders' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $orders = explode(",", $req['orders']);
            $result = Order::whereIn('id', $orders)->where('user_id', $user->id)->get()->map(function ($order) {
                return [
                    'order' => $order->id,
                    'status' => $order->status,
                    'code' => $order->code,
                    'details' => $order->details,
                    'price' => $order->price
                ];
            });
            return response()->json($result, 200);

        }
        //Categories
        elseif (strtolower($req['action']) == 'categories') {
            $result = Category::where('status', 1)->get()
                ->map(function ($category) {
                    return [
                        'id' => $category->id,
                        'name' => $category->category_title,
                        'type' => $category->type,
                        'slug' => $category->slug,
                    ];
                });
            return response()->json($result, 200);
        }
        //Player
        elseif (strtolower($req['action']) == 'player') {
            $category = $req['category'];
            $player_id = $req['player'];
            if ($category && $player_id) {
                $player_name = $this->serviceController->getPlayerName($category, $player_id);
                return $player_name;
            }
            return response()->json(['errors' => $validator->errors()], 422);
        }
        //Add
        elseif (strtolower($req['action']) == 'add') {
            $validator = Validator::make($req, [
                'service' => 'required',
                'link' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $result = $this->placeOrder($req, $user);
            return $result;
        }
        //Check SMS
        elseif (strtolower($req['action']) == 'check_sms') {
            $validator = Validator::make($req, [
                'order' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $result = $this->five_sim->checkSMS($req['order']);
            return response()->json($result, 200);
        }

        //Sync Orders
        elseif (strtolower($req['action']) == 'sync_orders') {
            $date=now()->subMinutes(30);
            $result = Order::select('id','status')->where('user_id',$user->id)->where('updated_at','>=',$date)->where('updated_at','>','created_at')->get();
            return response()->json($result, 200);
        }
    }

    public function placeOrder($request, $user)
    {
        $service = Service::where('id', $request['service'])->where('service_status', 1)->where('is_available', 1)->first();

        if (!$service) {
            return response()->json(['errors' => ['message' => trans("Invalid Service")]], 422);
        }

        if ($service->category->type == 'CODE') {
            $serviceCode = $service->service_code->where('is_used', 0)->first();
            if ($serviceCode == null) {
                return response()->json(['errors' => ['message' => trans("No Code Available ,Please Contact with Support To Order Code.")]], 422);
            }
        }

        if ($user != null) {
            if (!($service->price != null && $service->price != 0)) {
                $user_range = $user->priceRange;
                $range = $service->service_price_ranges()->where('price_range_id', $user_range->id)->first();
                $service->price = $range->price;
                $service->agent_commission_rate = $range->agent_commission_rate;
            }
        }

        $basic = (object)config('basic');
        if ($service->category->type == 'CODE' || $service->category->type == '5SIM')
            $quantity = 1;
        else
            $quantity = $request['quantity'];

        if ($service->min_amount <= $quantity && $service->max_amount >= $quantity) {
            $userRate = ($service->user_rate) ?? $service->price;
            $price = round(($quantity * $userRate), 2);
            if ($user->balance < $price) {
                return response()->json(['errors' => ['message' => trans("Insufficient balance.")]], 422);
            }
            DB::beginTransaction();
            try {
                $order = new Order();
                $order->user_id = $user->id;
                $order->category_id = $service->category_id;
                $order->service_id = $request['service'];
                $order->link = $request['link'];
                $order->quantity = $request['quantity'];
                $order->status = 'processing';
                $order->price = $price;
                $order->runs = isset($request['runs']) && !empty($request['runs']) ? $request['runs'] : null;
                $order->interval = isset($request['interval']) && !empty($request['interval']) ? $request['interval'] : null;

                if ($service->category->type == 'CODE') {
                    $serviceCode = $service->service_code->where('is_used', 0)->first();
                    if ($serviceCode != null) {
                        $order->code = trans('Service code is : ') . $serviceCode->code . trans(', and id is ') . $serviceCode->id;
                    }

                } elseif ($service->category->type == 'GAME') {
                    $order->details = trans('Player Id is : ') . "<span id='number' style=\"color:blue\" onclick='copy(" . $request['link'] . ")' >" . $request['link'] . "</span>" . trans(', and Name is ') . $request['link'] . trans(', and Service Id is ') . $request['service'];
                } elseif ($service->category->type == '5SIM') {

                    $codes = (new ApiProviderController)->fivesim($service->api_service_params);
                    if ($codes == 0)
                        return response()->json(['error', [trans("حاول لاحقا او تواصل مع مدير الموقع")]], 422);
                    else {
                        $order->code = $codes['phone'];
                        $order->order_id_api = $codes['id'];
                        $order->status = 'code-waiting';
                    }
                }

                $order->save();
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

                    $current_user_price_range = $user->priceRange ? $user->priceRange : 1;
                    $nextPriceRange = PriceRange::find($current_user_price_range + 1);
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
                if ($service->category->type != '5SIM') {
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
                    if ($user->user_id != null && $user->parent->is_agent == 1 && $user->parent->is_approved == 1) {
                        $commision = new AgentCommissionRate();
                        $rate = $service->agent_commission_rate;
                        $commision->user_id = $user->parent->id;
                        $commision->order_id = $order->id;
                        $commision->commission_rate = ($service->price * $rate / 100) * $quantity;
                        $commision->save();

                    }
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
                $result['status'] = 'success';
                $result['order'] = $order->id;
                $result['code'] = $order->code;
                $result['details'] = $order->details;
                $result['order_status']=$order->status;
                $result['price']= $order->price;

                $this->adminPushNotification('ORDER_CREATE', $msg, $action);
                DB::commit();
                if ($service->category->type == 'CODE') {
                    $serviceCode = $service->service_code->where('is_used', 0)->first();
                    if ($serviceCode != null) {
                        $serviceCode->is_used = 1;
                        $serviceCode->user_id = $user->id;
                        $serviceCode->save();
                        $order->status = "completed";
                        $order->save();
                        return response()->json($result, 200);
                    } else {
                        return back()->with('error', trans("No Code Available ,Please Contact with Support To Order Code."))->withInput();
                    }
                } elseif ($service->category->type == '5SIM') {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 200);
                }
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json(['errors' => ['message' => $e->getMessage()]], 422);
            }
        } else {
            return response()->json(['error' => ["Order quantity should be minimum {$service->min_amount} and maximum {$service->max_amount}"]], 422);
        }
    }

    public function ServicePrice(Service $service,$user)
    {
        if (!($service->price != null && $service->price != 0)) {
            $range = $service->service_price_ranges()->where('price_range_id', 1)->first();
           return $price = $range->price;
        }
        else
        $userRate=UserServiceRate::select('price')
            ->where('service_id', $service->id)
            ->where('user_id',$user->id)->first();
            $price = ($userRate) ? ($userRate->price): $service->price;
            return $price;
    }
}
