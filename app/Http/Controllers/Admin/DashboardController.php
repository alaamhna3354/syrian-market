<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload;
use App\Models\ApiProvider;
use App\Models\Fund;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\User;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Stevebauman\Purify\Facades\Purify;
use Image;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    use Upload;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function dashboard()
    {
        $last30 = date('Y-m-d', strtotime('-30 days'));

        $data['totalAmountReceived'] = Fund::where('status', 1)->sum('amount');
        $data['totalOrder'] = Order::count();
        $data['totalProviders'] = ApiProvider::count();

        $users = User::selectRaw('COUNT(id) AS totalUser')
            ->selectRaw('SUM(balance) AS totalUserBalance')
            ->selectRaw('COUNT((CASE WHEN created_at >= CURDATE()  THEN id END)) AS todayJoin')
            ->get()->makeHidden(['fullname', 'mobile'])->toArray();

        $data['userRecord'] = collect($users)->collapse();


        $transactions = Transaction::selectRaw('SUM((CASE WHEN remarks LIKE "DEPOSIT Via%" AND created_at >=' . $last30 . ' THEN charge WHEN remarks LIKE "Place order%" AND created_at >=' . $last30 . ' THEN amount END)) AS profit_30_days')
            ->selectRaw('SUM((CASE WHEN remarks LIKE "DEPOSIT Via%" AND created_at >= CURDATE() THEN charge WHEN remarks LIKE "Place order%" AND created_at >= CURDATE() THEN amount END)) AS profit_today')
            ->get()->toArray();
        $data['transactionProfit'] = collect($transactions)->collapse();;


        $tickets = Ticket::where('created_at', '>', Carbon::now()->subDays(30))
            ->selectRaw('count(CASE WHEN status = 3  THEN status END) AS closed')
            ->selectRaw('count(CASE WHEN status = 2  THEN status END) AS replied')
            ->selectRaw('count(CASE WHEN status = 1  THEN status END) AS answered')
            ->selectRaw('count(CASE WHEN status = 0  THEN status END) AS pending')
            ->get()->toArray();
        $data['tickets'] = collect($tickets)->collapse();


        $orders = Order::where('created_at', '>', Carbon::now()->subDays(30))
            ->selectRaw('count(id) as totalOrder')
            ->selectRaw('count(CASE WHEN status = "completed"  THEN status END) AS completed')
            ->selectRaw('count(CASE WHEN status = "processing"  THEN status END) AS processing')
            ->selectRaw('count(CASE WHEN status = "pending"  THEN status END) AS pending')
            ->selectRaw('count(CASE WHEN status = "progress"  THEN status END) AS inProgress')
            ->selectRaw('count(CASE WHEN status = "partial"  THEN status END) AS partial')
            ->selectRaw('count(CASE WHEN status = "canceled"  THEN status END) AS canceled')
            ->selectRaw('count(CASE WHEN status = "refunded"  THEN status END) AS refunded')
            ->selectRaw('COUNT((CASE WHEN created_at >= CURDATE()  THEN id END)) AS todaysOrder')
            ->get()->map(function ($value) {


                return [
                    'records' => [
                        'totalOrder' => $value->totalOrder,
                        'todaysOrder' => $value->todaysOrder,
                        'complete' => $value->completed,
                        'processing' => $value->processing,
                        'pending' => $value->pending,
                        'inProgress' => $value->inProgress,
                        'partial' => $value->partial,
                        'canceled' => $value->canceled,
                        'refunded' => $value->refunded,
                    ],
                    'percent' => [
                        'complete' => ($value->completed) ? round(($value->completed / $value->totalOrder) * 100, 2) : 0,
                        'processing' => ($value->processing) ? round(($value->processing / $value->totalOrder) * 100, 2): 0,
                        'pending' => ($value->pending) ? round(($value->pending / $value->totalOrder) * 100, 2): 0,
                        'inProgress' => ($value->inProgress) ? round(($value->inProgress / $value->totalOrder) * 100, 2): 0,
                        'partial' => ($value->partial) ? round(($value->partial / $value->totalOrder) * 100, 2): 0,
                        'canceled' => ($value->canceled) ? round(($value->canceled / $value->totalOrder) * 100, 2): 0,
                        'refunded' => ($value->refunded) ? round(($value->refunded / $value->totalOrder) * 100, 2): 0,
                    ]
                ];
            });


        $data['orders'] = collect($orders)->collapse();

        $data['bestSale'] = Order::with('service')
            ->selectRaw('service_id ,COUNT(service_id) as count, sum(quantity) as quantity')
            ->groupBy('service_id')->orderBy('count', 'DESC')->take(10)->get();



        $orderStatistics = Order::where('created_at', '>', Carbon::now()->subDays(30))
            ->selectRaw('count(CASE WHEN status = "completed"  THEN status END) AS completed')
            ->selectRaw('count(CASE WHEN status = "processing"  THEN status END) AS processing')
            ->selectRaw('count(CASE WHEN status = "pending"  THEN status END) AS pending')
            ->selectRaw('count(CASE WHEN status = "progress"  THEN status END) AS progress')
            ->selectRaw('count(CASE WHEN status = "partial"  THEN status END) AS partial')
            ->selectRaw('count(CASE WHEN status = "canceled"  THEN status END) AS canceled')
            ->selectRaw('count(CASE WHEN status = "refunded"  THEN status END) AS refunded')
            ->selectRaw('DATE_FORMAT(created_at, "%d %b") as date')
            ->orderBy('created_at')
            ->groupBy(DB::raw("DATE(created_at)"))->get();

        $statistics['date'] = [];
        $statistics['completed'] = [];
        $statistics['processing'] = [];
        $statistics['pending'] = [];
        $statistics['progress'] = [];
        $statistics['partial'] = [];
        $statistics['canceled'] = [];
        $statistics['refunded'] = [];
        foreach ($orderStatistics as $k => $val) {
            array_push($statistics['date'], trim($val->date));
            array_push($statistics['completed'], ($val->completed != null) ? $val->completed : 0);
            array_push($statistics['processing'], ($val->processing != null) ? $val->processing : 0);
            array_push($statistics['pending'], ($val->pending != null) ? $val->pending : 0);
            array_push($statistics['progress'], ($val->progress != null) ? $val->progress : 0);
            array_push($statistics['partial'], ($val->partial != null) ? $val->partial : 0);
            array_push($statistics['canceled'], ($val->canceled != null) ? $val->canceled : 0);
            array_push($statistics['refunded'], ($val->refunded != null) ? $val->refunded : 0);
        }

        $data['latestUser'] = User::latest()->limit(5)->get();


        return view('admin.pages.dashboard', $data, compact('statistics'));
    }

    public function profile()
    {
        $admin = $this->user;
        return view('admin.pages.admin.profile', compact('admin'));
    }


    public function profileUpdate(Request $request)
    {
        $req = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'name' => 'sometimes|required',
            'username' => 'sometimes|required|unique:admins,username,' . $this->user->id,
            'email' => 'sometimes|required|email|unique:admins,email,' . $this->user->id,
            'phone' => 'sometimes|required',
            'address' => 'sometimes|required',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])]
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user = $this->user;
        if ($request->hasFile('image')) {
            try {
                $old = $user->image ?: null;
                $user->image = $this->uploadImage($request->image, config('location.admin.path'), config('location.admin.size'), $old);
            } catch (\Exception $exp) {
                return back()->with('error', 'Image could not be uploaded.');
            }
        }
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        return back()->with('success', 'Updated Successfully.');
    }


    public function password()
    {
        return view('admin.pages.admin.password');
    }

    public function passwordUpdate(Request $request)
    {
        $req = Purify::clean($request->all());

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:5|confirmed',
        ]);

        $request = (object)$req;
        $user = $this->user;
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', "Password didn't match");
        }
        $user->update([
            'password' => bcrypt($request->password)
        ]);
        return back()->with('success', 'Password has been Changed');
    }
}
