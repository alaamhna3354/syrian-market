<?php

namespace App\Http\Controllers;

use App\Http\Traits\Notify;
use App\Models\Category;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Stevebauman\Purify\Facades\Purify;

class OrderController extends Controller
{
    use Notify;
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $page_title = "All Orders";
        $orders = Order::orderby('id','desc')->with('service', 'users')->has('service')->paginate(config('basic..paginate'));
        return view('admin.pages.order.show', compact('orders', 'page_title'));
    }

    /*
     * search
     */
    public function search(Request $request)
    {
        $search = $request->all();
        $dateSearch = $request->date_time;
        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);

        $orders = Order::with('service', 'users')
            ->when(isset($search['order_id']), function ($query) use ($search) {
                return $query->where('id', 'LIKE', "%{$search['order_id']}%");
            })
            ->when(isset($search['service']), function ($query) use ($search) {
                return $query->whereHas('service', function ($q) use ($search) {
                    return $q->where('service_title', 'LIKE', "%{$search['service']}%");
                });
            })
            ->when(isset($search['user']), function ($query) use ($search) {
                return $query->whereHas('users', function ($q) use ($search) {
                    $q->where('email', 'LIKE', "%{$search['user']}%")
                        ->orWhere('username', 'LIKE', "%{$search['user']}%");
                });
            })
            ->when(isset($search['status']), function ($query) use ($search) {
                return $query->where('status', 'LIKE', "%{$search['status']}%");
            })
            ->when($date == 1, function ($query) use ($dateSearch) {
                return $query->whereDate("created_at", $dateSearch);
            })
            ->paginate(config('basic.paginate'));

        $page_title = "Search Orders";
        return view('admin.pages.order.search', compact('orders', 'page_title'));
    }

    public function awaiting(Request $request, $name = 'awaiting')
    {
        $page_title = "Awaiting Orders";
        $orders = Order::orderby('id','desc')->with('service', 'users')->where('status', $name)->paginate(config('basic.paginate'));
        return view('admin.pages.order.show', compact('orders', 'page_title'));
    }

    public function pending(Request $request, $name = 'pending')
    {
        $page_title = "Pending Orders";
        $orders = Order::orderby('id','desc')->with('service', 'users')->where('status', $name)->paginate(config('basic.paginate'));
        return view('admin.pages.order.show', compact('orders', 'page_title'));
    }

    public function processing(Request $request, $name = 'processing')
    {
        $page_title = "Processing Orders";
        $orders = Order::orderby('id','desc')->with('service', 'users')->where('status', $name)->paginate(config('basic.paginate'));
        return view('admin.pages.order.show', compact('orders', 'page_title'));
    }

    public function progress(Request $request, $name = 'progress')
    {
        $page_title = "Progress Orders";
        $orders = Order::orderby('id','desc')->with('service', 'users')->where('status', $name)->paginate(config('basic.paginate'));
        return view('admin.pages.order.show', compact('orders', 'page_title'));
    }

    public function completed(Request $request, $name = 'completed')
    {
        $page_title = "Completed Orders";
        $orders = Order::orderby('id','desc')->with('service', 'users')->where('status', $name)->paginate(config('basic.paginate'));
        return view('admin.pages.order.show', compact('orders', 'page_title'));
    }

    public function partial(Request $request, $name = 'partial')
    {
        $page_title = "Partial Orders";
        $orders = Order::orderby('id','desc')->with('service', 'users')->where('status', $name)->paginate(config('basic.paginate'));
        return view('admin.pages.order.show', compact('orders', 'page_title'));
    }

    public function canceled(Request $request, $name = 'canceled')
    {
        $page_title = "Canceled Orders";
        $orders = Order::orderby('id','desc')->with('service', 'users')->where('status', $name)->paginate(config('basic.paginate'));
        return view('admin.pages.order.show', compact('orders', 'page_title'));
    }

    public function refunded(Request $request, $name = 'refunded')
    {
        $page_title = "Refunded Orders";
        $orders = Order::orderby('id','desc')->with('service', 'users')->where('status', $name)->paginate(config('basic.paginate'));
        return view('admin.pages.order.show', compact('orders', 'page_title'));
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order, $id)
    {
        $order = Order::with('users')->find($id);
        $categories = Category::with('service')->has('service')->get();
        return view('admin.pages.order.edit', compact('order', 'categories'));
    }

    /*
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order, $id)
    {
//        dd($request);
        $req = Purify::clean($request->all());
        $order = Order::with('users')->find($id);
        $user = $order->users;
        $order->start_counter = $req['start_counter'] == '' ? null : $req['start_counter'];
        $order->api_order_id = $request->api_order_id;
        $order->link = $req['link'];
        $order->remains = $req['remains'] == '' ? null : $req['remains'];
        if ($request->status) {
//            $order->status = $req['status'];
            if($req['status']=='refunded') {
                if ($order->status != 'refunded') {
                    $user->balance += $order->price;
                    $transaction1 = new Transaction();
                    $transaction1->user_id = $user->id;
                    $transaction1->trx_type = '+';
                    $transaction1->amount = $order->price;
                    $transaction1->remarks = 'استرجاع الرصيد بعد تحويل حالة الطلب الى مسترجع';
                    $transaction1->trx_id = strRandom();
                    $transaction1->charge = 0;

                    if ($order->agentCommissionRate != null){
                        $agentCommissionRate = $order->agentCommissionRate;
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

//                    dd($agentCommissionRate);
                        $agentCommissionRate->delete();
                    }
                    if ($user->save()){
                        $transaction1->save();
                    }

                }
            }
            $status = $order->status;
            $order->status = $req['status'];
        }
        $order->reason = $req['reason'];
        $order->updated_by=auth()->id();
        $order->save();
        $msg = [
            'status' => $order->status,
            'order_id' => $order->id,
        ];
        $action = [
            "link" => '#',
            "icon" => "fa fa-money-bill-alt text-white"
        ];
        if ($status != $order->status){
            $this->userPushNotification($user, 'CHANGED_STATUS', $msg, $action);
        }


        $this->sendMailSms($order->users, 'ORDER_UPDATE', [
            'order_id' => $order->id,
            'start_counter' => $order->start_counter,
            'link' => $order->link,
            'remains' => $order->remains,
            'order_status' => $order->status
        ]);
        return back()->with('success', trans( 'successfully updated'));
    }


    /*
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        $order->delete();
        return back()->with('success', trans( 'Successfully Deleted'));
    }

    public function statusChange(Request $request)
    {

        $req = $request->all();
        $order = Order::find($request->id);

        $user = $order->users;
        if($req['statusChange']=='refunded') {
            if ($order->status != 'refunded') {
                $user->balance += $order->price;
                $transaction1 = new Transaction();
                $transaction1->user_id = $user->id;
                $transaction1->trx_type = '+';
                $transaction1->amount = $order->price;
                $transaction1->remarks = 'استرجاع الرصيد بعد تحويل حالة الطلب الى مسترجع';
                $transaction1->trx_id = strRandom();
                $transaction1->charge = 0;

                if ($order->agentCommissionRate != null){
                    $agentCommissionRate = $order->agentCommissionRate;
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

//                    dd($agentCommissionRate);
                    $agentCommissionRate->delete();
                }
                if ($user->save()){
                    $transaction1->save();
                }

            }
        }
        $order->status = $req['statusChange'];
        $order->updated_by=auth()->id();
        $order->save();
        $msg = [
            'status' => $order->status,
            'order_id' => $order->id,
        ];
        $action = [
            "link" => '#',
            "icon" => "fa fa-money-bill-alt text-white"
        ];

        $this->userPushNotification($user, 'CHANGED_STATUS', $msg, $action);
        return back()->with('success', trans( 'Successfully Updated'));
    }


    public function getuser(Request $request)
    {
        $user = User::where('name', 'LIKE', "%{$request->user}%")->get()->pluck('name');
        return response()->json($user);
    }




    /*
     * user drop search
     */
    public function getusersearch(Request $request)
    {
        $user = User::where('name', 'LIKE', "%{$request->user_name}%")->get()->pluck('name');
        return response()->json($user);
    }

    /*
     * user search
     */
    public function getTrxUserSearch(Request $request)
    {
        $users = User::where('name', 'LIKE', "%{$request->data}%")->get()->pluck('name');
        return response()->json($users);
    }

    /*
     * TRX
     */
    public function gettrxidsearch(Request $request)
    {
        $transaction = Transaction::where('trx_id', 'LIKE', "%{$request->trxid}%")->get()->pluck('trx_id');
        return response()->json($transaction);
    }

    public function transaction()
    {
        $transaction = Transaction::with('user')->orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view('admin.pages.transaction.index', compact('transaction'));
    }

    /*
     * transaction search
     */
    public function transactionSearch(Request $request)
    {
        $search = $request->all();

        $dateSearch = $request->datetrx;
        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);
        $transaction = Transaction::with('user')->orderBy('id', 'DESC')
            ->when($search['transaction_id'], function ($query) use ($search) {
                return $query->where('trx_id', 'LIKE', "%{$search['transaction_id']}%");
            })
            ->when($search['user_name'], function ($query) use ($search) {
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('email', 'LIKE', "%{$search['user_name']}%")
                        ->orWhere('username', 'LIKE', "%{$search['user_name']}%");
                });
            })
            ->when($search['remark'], function ($query) use ($search) {
                return $query->where('remarks', 'LIKE', "%{$search['remark']}%");
            })
            ->when($date == 1, function ($query) use ($dateSearch) {
                return $query->whereDate("created_at", $dateSearch);
            })
            ->paginate(config('basic.paginate'));
        $transaction =  $transaction->appends($search);

        return view('admin.pages.transaction.index', compact('transaction'));
    }

    public function inventory()
    {
        $users = User::with('transaction')->orderBy('id', 'asc')->get();
        $user = User::findOrFail(2);
//        dd($user->transactions());
        $transaction = Transaction::with('user')->orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view('admin.pages.inventory.index', compact('transaction','users'));
    }
    public function inventorySearch(Request $request)
    {
        $search = $request->all();

        $dateSearch = $request->datetrx;
        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);
        $transaction = Transaction::with('user')->orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        $users = User::with('transaction')->orderBy('id', 'asc')
            ->when($search['user_name'], function ($query) use ($search) {
                return $query->where('username', 'LIKE', "%{$search['user_name']}%");
            })
            ->get();
        $transaction =  $transaction->appends($search);

        return view('admin.pages.inventory.index', compact('transaction','users'));
    }
}
