<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRoleChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roles)
    {

        $role = explode('|', $roles);

        if (Auth::user() &&  in_array(auth()->user()->role , $role)) {
            return $next($request);
        }

        //If user role is student
//        if(Auth::check() && (auth()->user()->role === 'Super' || auth()->user()->role === 'Admin'))
//        {
//            return route('admin.dashboard');
//        }
//
//        //If user role is teacher
//        if(Auth::check() && auth()->user()->role ==='SellMan')
//        {
//            return  route('admin.order');
//        }

        abort(403, 'Unauthorized action.');

    }
}
