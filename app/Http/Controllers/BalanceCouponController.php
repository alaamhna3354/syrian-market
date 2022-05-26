<?php

namespace App\Http\Controllers;

use App\Models\BalanceCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;
use App\Http\Traits\Upload;
use Illuminate\Validation\Rule;

class BalanceCouponController extends Controller
{
    use Upload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = BalanceCoupon::all();
        return view('admin.pages.balance_coupon.show-coupon', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.balance_coupon.add-coupon');
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
            'code' => Rule::unique('balance_coupons'),
            'balance' => 'required|numeric',
        ];
        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $balance = new BalanceCoupon();
        if ($request->hasFile('image')) {
            try {
                $balance->qr_code = $this->uploadImage($request['image'], config('location.category.path'), config('location.category.size'));
            } catch (\Exception $exp) {
                return back()->with('error', 'Image could not be uploaded.');
            }
        }
        $balance->code = $req['code'];
        $balance->balance = $req['balance'];
        $balance->status = $req['status'];
        $balance->save();
        return back()->with('success', 'Successfully Updated');
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
        $coupon = BalanceCoupon::find($id);
        return view('admin.pages.balance_coupon.edit-coupon', compact('coupon'));
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

        $req = Purify::clean($request->all());
        $coupon = BalanceCoupon::find($request->id);
        $rules = [
            'code' => 'required|string|max:20',
            'code' => Rule::unique('balance_coupons')->ignore($id),
            'balance' => 'required|numeric',
        ];
        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            try {
                $old = $coupon->qr_code;
                $coupon->qr_code = $this->uploadImage($request->image, config('location.category.path'), config('location.category.size'), $old);
            } catch (\Exception $exp) {
                return back()->with('error', 'Image could not be uploaded.');
            }
        }
        $coupon->code = $req['code'];
        $coupon->balance = $req['balance'];
        $coupon->status = $req['status'];
        $coupon->save();
        return back()->with('success', 'Successfully Updated');
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
