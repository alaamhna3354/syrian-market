<?php

namespace App\Http\Controllers;

use App\Http\Traits\Notify;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class VerificationController extends Controller
{
    use Notify;
    public function checkValidCode($user, $code, $add_min = 10000)
    {
        if (!$code) return false;
        if (!$user->sent_at) return false;
        if ($user->sent_at->addMinutes($add_min) < Carbon::now()) return false;
        if ($user->verify_code !== $code) return false;
        return true;
    }
    public function check()
    {
        $user = auth()->user();
        if (!$user->status) {
            Auth::logout();
        }
        elseif (!$user->email_verification) {
            if (!$this->checkValidCode($user, $user->verify_code)) {
                $user->verify_code = code(6);
                $user->sent_at = Carbon::now();
                $user->save();
                $this->mail($user, 'VERIFICATION_CODE', [
                    'code' => $user->verify_code
                ]);
            }
            $page_title = 'Email Verification';
            return view(template().'auth.verification.email', compact('user', 'page_title'));
        }
        elseif (!$user->sms_verification) {
            if (!$this->checkValidCode($user, $user->verify_code)) {
                $user->verify_code = code(6);
                $user->sent_at = Carbon::now();
                $user->save();

                $this->sms($user, 'VERIFICATION_CODE', [
                    'code' => $user->verify_code
                ]);

            }
            $page_title = 'SMS Verification';
            return view(template().'auth.verification.sms', compact('user', 'page_title'));
        }
        return redirect()->route('user.home');
    }


    public function resendCode()
    {

        $type = request()->type;
        $user  = Auth::user();



        if ($this->checkValidCode($user, $user->verify_code, 2)) {
            $target_time = $user->sent_at->addMinutes(2)->timestamp;
            $delay = $target_time - time();
            throw ValidationException::withMessages(['resend' => 'Please Try after ' . $delay . ' Seconds']);
        }
        if (!$this->checkValidCode($user, $user->verify_code)) {
            $user->verify_code = code(6);
            $user->sent_at = Carbon::now();
            $user->save();
        } else {
            $user->verify_code = $user->verify_code;
            $user->sent_at = Carbon::now();
            $user->save();
        }


        if ($type === 'email') {
            $this->mail($user,'VERIFICATION_CODE',[
                'code' => $user->verify_code
            ]);

            return back()->with('success', 'Email verification code has been sent');
        } elseif ($type === 'mobile') {
            $this->sms($user,'VERIFICATION_CODE',[
                'code' => $user->verify_code
            ]);
            return back()->with('success', 'SMS verification code has been sent');
        } else {
            throw ValidationException::withMessages(['error' => 'Sending Failed']);
        }
    }

    public function mailVerify(Request $request)
    {
        $rules = [
            'code' => 'required',
        ];
        $msg = [
            'code.required' => 'Email verification code is required',
        ];
        $validate = $this->validate($request, $rules, $msg);
        $user = Auth::user();

        if ($this->checkValidCode($user, $request->code)) {
            $user->email_verification = 1;
            $user->verify_code = null;
            $user->sent_at = null;
            $user->save();
            return redirect()->intended(route('user.home'));
        }
        throw ValidationException::withMessages(['error' => 'Verification code didn\'t match!']);
    }

    public function smsVerify(Request $request)
    {
        $rules = [
            'code' => 'required',
        ];
        $msg = [
            'code.required' => 'Email verification code is required',
        ];
        $validate = $this->validate($request, $rules, $msg);
        $user = Auth::user();

        if ($this->checkValidCode($user, $request->code)) {
            $user->sms_verification = 1;
            $user->verify_code = null;
            $user->sent_at = null;
            $user->save();

            return redirect()->intended(route('user.home'));
        }
        throw ValidationException::withMessages(['error' => 'Verification code didn\'t match!']);
    }
}
