<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Notify;
use App\Models\Category;
use App\Models\Language;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserServiceRate;
use App\Rules\FileTypeValidate;
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
        return view('admin.pages.users.edit-user', compact('user', 'languages'));
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
        $user->status = ($userData['status'] == 'on') ? 0 : 1;
        $user->email_verification = ($userData['email_verification'] == 'on') ? 0 : 1;
        $user->sms_verification = ($userData['sms_verification'] == 'on') ? 0 : 1;

        if (isset($userData['language_id'])) {
            $user->language_id = @$userData['language_id'];
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
                $user->save();

                $transaction = new Transaction();
                $transaction->user_id = $user->id;
                $transaction->trx_type = '+';
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
        $this->mail($user, null, [], $req['subject'], $req['message']);

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
}
