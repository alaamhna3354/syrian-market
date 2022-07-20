<?php

namespace App\Http\Controllers;

use App\Models\BalanceCoupon;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Stevebauman\Purify\Facades\Purify;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.pages.coupon.show-coupon', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.coupon.add-coupon');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        $req = Purify::clean($request->all());
        $rules = [
            'code' => 'required|string|max:20',
            'code' => Rule::unique('coupons'),
            'sale' => 'required|numeric',
        ];
        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $coupon = new Coupon();
        $coupon->code = $req['code'];
        $coupon->sale = $req['sale'];
        $coupon->number_of_beneficiaries = $req['number_of_beneficiaries'];
        $coupon->from = $req['from'];
        $coupon->to = $req['to'];
        $coupon->number_of_use = 0;
        $coupon->is_percent = $req['is_percent'];
        $coupon->status = $req['status'];
        $coupon->save();
        return back()->with('success', trans('Successfully Updated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.pages.coupon.edit-coupon', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//       dd($request);
        $req = Purify::clean($request->all());
        $coupon = Coupon::find($request->id);
        $rules = [
            'code' => 'required|string|max:20',
            'code' => Rule::unique('coupons')->ignore($id),
            'sale' => 'required|numeric',
        ];
        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        $coupon->code = $req['code'];
        $coupon->sale = $req['sale'];
        $coupon->number_of_beneficiaries = $req['number_of_beneficiaries'];
        $coupon->from = $req['from'];
        $coupon->to = $req['to'];
        $coupon->is_percent = $req['is_percent'];
        $coupon->status = $req['status'];
        $coupon->save();
        return back()->with('success', trans('Successfully Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
