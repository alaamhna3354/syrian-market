<?php

namespace App\Http\Controllers;

use App\Http\Traits\Notify;
use App\Http\Traits\Upload;
use App\Models\Category;
use App\Models\Fund;
use App\Models\Gateway;
use App\Models\Language;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Transaction;
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

        return view('user.pages.dashboard', $data, compact('order'));
    }


    public function transaction()
    {
        $transactions = $this->user->transaction()->orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view('user.pages.transaction.index', compact('transactions'));
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


        return view('user.pages.transaction.index', compact('transactions'));

    }

    public function fundHistory()
    {
        $funds = Fund::where('user_id', $this->user->id)->where('status', '!=', 0)->orderBy('id', 'DESC')->with('gateway')->paginate(config('basic.paginate'));
        return view('user.pages.transaction.fundHistory', compact('funds'));
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

        return view('user.pages.transaction.fundHistory', compact('funds'));

    }


    public function addFund()
    {
        $gateways = Gateway::where('status', 1)->orderBy('sort_by', 'ASC')->get();
        return view('user.pages.addFund', compact('gateways'));
    }


    public function apiKey()
    {
        $api_token = Auth::user()->api_token;
        return view('user.pages.apiKey', compact('api_token'));
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
        $languages =  Language::where('is_active',1)->orderBy('short_name')->get();
        return view('user.pages.profile.myprofile', compact('user','languages'));
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
                        return $fail("Images MAX  2MB ALLOW!");
                    }
                    if (!in_array($ext, $allowedExtensions)) {
                        return $fail("Only png, jpg, jpeg images are allowed");
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
                return back()->with('error', 'Could not upload your ' . $image)->withInput();
            }
        }
        $user->save();
        return back()->with('success', 'Updated Successfully.');
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

        if(isset($req['language_id'])){
            $user->language_id = $req['language_id'];
        }
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
        $user = Auth::user();
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

}
