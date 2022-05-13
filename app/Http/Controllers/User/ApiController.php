<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function index()
    {
        $data['api_token'] = Auth::user()->api_token;
        if (Auth::check()) {
            return view('user.pages.api.index', $data);
        }
        return redirect()->route('apiDocs');
    }

    public function apiGenerate()
    {
        $user = Auth::user();
        $user->api_token = Str::random(20);
        $user->save();
        return $user->api_token;
    }
}
