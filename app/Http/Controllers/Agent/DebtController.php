<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Http\Traits\Notify;
use App\Models\Debt;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DebtController extends Controller
{
    use Notify;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $debts = Debt::where('agent_id',$this->user->id)->get();
        return view('agent.pages.debt.show', compact('debts'));
    }

    public function myDebt()
    {
        $debts = Debt::where('user_id',$this->user->id)->get();
        return view('agent.pages.debt.show', compact('debts'));
    }

    public function search(Request $request)
    {
//        $search = $request->all();
//        $dateSearch = $request->date_time;
//        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);
//        $debts = Debt::when(isset($search['debt_id']), function ($query) use ($search) {
//            return $query->where('id',  $search['debt_id']);
//        })
//            ->when(isset($search['user']), function ($query) use ($search) {
//                return $query->where('user_id', $search['user']);
//            })
//            ->when($date == 1, function ($query) use ($dateSearch) {
//                return $query->whereDate("created_at", $dateSearch);
//            })
//            ->when(isset($search['status']), function ($query) use ($search) {
//                return $query->where('status', $search['status']);
//            })->get();
//        return view('agent.pages.debt.show', compact('debts', 'search'));
        $debts = Debt::all();
        return view('agent.pages.debt.show', compact('debts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
