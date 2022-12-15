<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Notify;
use App\Models\Category;
use App\Models\Order;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class OrderManageController extends Controller
{
    use Notify;
    public function userOrder($id)
    {
        $user = User::with('order', 'order.service', 'order.service.category')->findOrFail($id);
        $userid = $user->id;
        return view('admin.pages.users.show-order-user', compact('user', 'userid'));
    }

    public function userOrderSearch(Request $request)
    {
        $search = @$request->search;
        $userid = @$request->user_id;
        $status = @$request->status;
        $dateSearch = @$request->date_order;

        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);
        $orders = Order::when($userid, function ($query) use ($userid) {
            return $query->where('user_id', $userid);
        })
            ->when($search, function ($query) use ($search) {
                return $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhereHas('service', function ($q) use ($search) {
                        return $q->where('service_title', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('users', function ($q) use ($search) {
                        return $q->where('email', 'LIKE', "%{$search}%")
                            ->orWhere('username', 'LIKE', "%{$search}%");
                    });
            })
            ->when($status != -1, function ($query) use ($status) {
                return $query->where('status', 'LIKE', "%{$status}%");
            })
            ->when($date == 1, function ($query) use ($dateSearch) {
                return $query->whereDate("created_at", $dateSearch);
            })
            ->with('service', 'service.category', 'users')
            ->paginate(config('basic.paginate'));

        return view('admin.pages.users.userordersearch', compact('orders', 'userid'));
    }


    public function userServiceEdit($id)
    {
        $order = Order::with('service', 'service.category')->find($id);
        $categories = Category::with('service')->has('service')->get();
        $service = Service::all();
        return view('admin.pages.users.edit-order-service', compact('order', 'categories', 'service'));
    }

    public function usersOrderChangeStatus(Request $request)
    {
        $status = $request->status;
        if ($request->strIds == null) {
            session()->flash('error', "You have not selected any order.");
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);
            if (count($ids) > 0) {
                $logs = Order::whereIn('id', $ids)->with('users')->get()->map(function ($item) use($status){

                    $user = $item->users;
                    if ($status == "refunded"){
                        $user->balance += $item->price;
                        $transaction1 = new Transaction();
                        $transaction1->user_id = $user->id;
                        $transaction1->trx_type = '+';
                        $transaction1->amount = $item->price;
                        $transaction1->remarks = 'استرجاع الرصيد بعد تحويل حالة الطلب الى مسترجع';
                        $transaction1->trx_id = strRandom();
                        $transaction1->charge = 0;

                        if ($item->agentCommissionRate != null){
                            $agentCommissionRate = $item->agentCommissionRate;
                            if ($agentCommissionRate->is_paid == 1){
                                $agent = $user->parent;
                                $agent->balance -= $agentCommissionRate->commission_rate;
                                if ($agent->save()){
                                    $transaction = new Transaction();
                                    $transaction->user_id = $agent->id;
                                    $transaction->trx_type = '-';
                                    $transaction->amount = $agentCommissionRate->commission_rate;
                                    $transaction->remarks = 'استرجاع الارباح من الوكيل بعد تحويل حالة الطلب الى مسترجع';
                                    $transaction->trx_id = strRandom();
                                    $transaction->charge = 0;
                                    $transaction->save();
                                }

                            }
                            $agentCommissionRate->delete();
                        }
                        if ($user->save()){
                            $transaction1->save();
                        }
                    }

                    $item->status = $status;
                    $item->updated_by=auth()->id();
                    $item->save();

                    $msg = [
                        'status' => $item->status,
                        'order_id' => $item->id,
                    ];
                    $action = [
                        "link" => '#',
                        "icon" => "fa fa-money-bill-alt text-white"
                    ];

                    $this->userPushNotification($user, 'CHANGED_STATUS', $msg, $action);

                    $msg = [
                        'order_id' => $item->id,
                        'status' => $status
                    ];
                    $action = [
                        "link" => '#',
                        "icon" => "fas fa-cart-plus text-white"
                    ];
                    @$this->userPushNotification($item->users, 'ORDER_STATUS_CHANGED', $msg, $action);
                    return $item;

                });

                return $logs;
            }
            session()->flash('success', trans('Order has been updated'));
            return response()->json(['success' => 1]);
        }
    }

    public function awaitingMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', trans('You do not select User Id!!'));
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);
            if (count($ids) > 0) {
                $order = Order::whereIn('id', $ids);
                $order->update([
                    'status' => 'awaiting',
                ]);
            }
            session()->flash('success', trans('Updated Successfully!!'));
            return response()->json(['success' => 1]);
        }
    }

    public function pendingMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', trans('You do not select User Id!!'));
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);
            if (count($ids) > 0) {
                $order = Order::whereIn('id', $ids);
                $order->update([
                    'status' => 'pending',
                ]);
            }
            session()->flash('success', trans('Updated Successfully!!'));
            return response()->json(['success' => 1]);
        }
    }

    public function processingMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', trans('You do not select User Id!!'));
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);
            if (count($ids) > 0) {
                $order = Order::whereIn('id', $ids);
                $order->update([
                    'status' => 'processing',
                ]);
            }
            session()->flash('success', trans('Updated Successfully!!'));
            return response()->json(['success' => 1]);
        }
    }

    public function inProgressMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', trans('You do not select User Id!!'));
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);
            if (count($ids) > 0) {
                $order = Order::whereIn('id', $ids);
                $order->update([
                    'status' => 'progress',
                ]);
            }
            session()->flash('success', trans('Updated Successfully!!'));
            return response()->json(['success' => 1]);
        }
    }

    public function completedMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', trans('You do not select User Id!!'));
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);
            if (count($ids) > 0) {
                $order = Order::whereIn('id', $ids);
                $order->update([
                    'status' => 'completed',
                ]);
            }
            session()->flash('success', trans('Updated Successfully!!'));
            return response()->json(['success' => 1]);
        }
    }

    public function partialMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', trans('You do not select User Id!!'));
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);
            if (count($ids) > 0) {
                $order = Order::whereIn('id', $ids);
                $order->update([
                    'status' => 'partial',
                ]);
            }
            session()->flash('success', trans('Updated Successfully!!'));
            return response()->json(['success' => 1]);
        }
    }

    public function cancelledMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', trans('You do not select User Id!!'));
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);
            if (count($ids) > 0) {
                $order = Order::whereIn('id', $ids);
                $order->update([
                    'status' => 'canceled',
                ]);
            }
            session()->flash('success', trans('Updated Successfully!!'));
            return response()->json(['success' => 1]);
        }
    }

    public function refundedMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', trans('You do not select User Id!!'));
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);

            if (count($ids) > 0) {
                $order = Order::whereIn('id', $ids);
                dd($order);
                $order->update([
                    'status' => 'refunded',
                ]);
            }
            session()->flash('success', trans('Updated Successfully!!'));
            return response()->json(['success' => 1]);
        }
    }



    public function getUsername(Request $request)
    {
        $user = User::where('username', 'LIKE', "%{$request->data}%")->get()->pluck('name');
        return response()->json($user);
    }
}
