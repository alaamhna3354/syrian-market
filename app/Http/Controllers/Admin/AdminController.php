<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins=Admin::all();
        return view('admin.pages.admin.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $adminData = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'name' => 'sometimes|required',
            'username' => 'required|unique:admins,username,' ,
            'email' => 'required|email|unique:admins,email,',
            'phone' => 'required',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'password' => 'required|min:5|same:password_confirmation',
        ];
        $message = [
            'name.required' => ' Name is required',
        ];

        $Validator = Validator::make($adminData, $rules, $message);
        if ($Validator->fails()) {
            return back()->withErrors($Validator)->withInput();
        }
        $admin=new Admin();
        if ($request->hasFile('image')) {
            try {
                $admin->image = $this->uploadImage($request->image, config('location.admin.path'), config('location.admin.size'));
            } catch (\Exception $exp) {
                return back()->with('error', trans('Image could not be uploaded.'));
            }
        }
        $admin->name = $adminData['name'];
        $admin->username = $adminData['username'];
        $admin->email = $adminData['email'];
        $admin->phone = $adminData['phone'];
        $admin->address = $adminData['address'];
        $admin->status = ($adminData['status'] == 'on') ? 0 : 1;
        $admin->password = bcrypt($request->password);
        if(isset($adminData['role']))
            $admin->role = $adminData['role'] ;
        $admin->save();
        return redirect()->route('admin.admins.index')->with('success', trans('Added Successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('admin.pages.admin.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $adminData = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'name' => 'sometimes|required',
            'username' => 'sometimes|required|unique:admins,username,' . $admin->id,
            'email' => 'sometimes|required|email|unique:admins,email,' . $admin->id,
            'phone' => 'sometimes|required',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])]
        ];
        $message = [
            'name.required' => ' Name is required',
        ];

        $Validator = Validator::make($adminData, $rules, $message);
        if ($Validator->fails()) {
            return back()->withErrors($Validator)->withInput();
        }
        if ($request->hasFile('image')) {
            try {
                $old = $admin->image ?: null;
                $admin->image = $this->uploadImage($request->image, config('location.admin.path'), config('location.admin.size'), $old);
            } catch (\Exception $exp) {
                return back()->with('error', trans('Image could not be uploaded.'));
            }
        }
        $admin->name = $adminData['name'];
        $admin->username = $adminData['username'];
        $admin->email = $adminData['email'];
        $admin->phone = $adminData['phone'];
        $admin->address = $adminData['address'];
        $admin->status = ($adminData['status'] == 'on') ? 0 : 1;
        if(isset($adminData['role']))
        $admin->role = $adminData['role'] ;
        $admin->save();
        return back()->with('success', trans('Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }


    public function passwordUpdate(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:5|same:password_confirmation',
        ]);
        $admin = Admin::findOrFail($id);
        $admin->password = bcrypt($request->password);
        $admin->save();

        return back()->with('success',trans('Updated Successfully.') );
    }

}
