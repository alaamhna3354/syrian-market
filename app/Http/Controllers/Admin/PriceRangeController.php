<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BalanceCoupon;
use App\Models\PriceRange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Stevebauman\Purify\Facades\Purify;

class PriceRangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ranges = PriceRange::all();
        return view('admin.pages.price_range.index',compact('ranges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.price_range.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $req = Purify::clean($request->all());
        $range = new PriceRange();
        $rules = [
            'name' => 'required|string|max:20',
            'name' => Rule::unique('price_ranges'),
            'min_total_amount' => 'required|numeric',
            'limit_days' => 'required|numeric',
        ];
        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $range->name = $req['name'];
        $range->min_total_amount = $req['min_total_amount'];
        $range->limit_days = $req['limit_days'];
        if ($range->save()){
            return back()->with('success', 'Successfully Updated');
        }else{
            return back()->with('error', 'Sorry Try Again Later');
        }
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
        $range = PriceRange::findOrFail($id);
        return view('admin.pages.price_range.edit',compact('range'));
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
        $range = PriceRange::find($id);
        $rules = [
            'name' => 'required|string|max:20',
            'name' => Rule::unique('price_ranges')->ignore($id),
            'min_total_amount' => 'required|numeric',
            'limit_days' => 'required|numeric',
        ];
        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $range->name = $req['name'];
        $range->min_total_amount = $req['min_total_amount'];
        $range->limit_days = $req['limit_days'];
        if ($range->save()){
            return back()->with('success', 'Successfully Updated');
        }else{
            return back()->with('error', 'Sorry Try Again Later');
        }
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
