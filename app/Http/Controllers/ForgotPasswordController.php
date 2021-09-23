<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailResetPassword;
use App\Mail\MailResetPassword;
use App\Services\UserService;
use Carbon\Carbon;
use DB;
use Hash;
use Illuminate\Http\Request;
use Str;

class ForgotPasswordController extends Controller
{
    public static function forgetPassword(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('auth.forgot_password');
        }
        $request->validate([
                               'email' => 'required|email|exists:users',
                           ]);
        $token = Str::random(64);
        if (! UserService::sendMailResetPassword($request->email, $token)) {
            return ['error' => __('message.server_error')];
        }

        return ['success' => __('message.send_mail_forgot_password_successfully')];

    }

    public function showResetPasswordForm($token) {
        return view('auth.reset_password', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
                               'password' => 'required|string|min:6|confirmed',
                               'password_confirmation' => 'required'
                           ]);
        return UserService::resetPassword($request);
    }
}
