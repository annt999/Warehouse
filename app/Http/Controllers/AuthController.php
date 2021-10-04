<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public static function login(Request $request)
    {
        if (\Auth::check())
        {
            return redirect()->route('home');
        }
        if ($request->isMethod('get'))
        {

            return view('auth.login');
        }
        /* Handle the login form */
        $credentials = $request->only('user_name', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors(['message' => __('message.invalid_login')])->withInput();
    }
    public static function logout()
    {
        Auth::logout();
        return view('auth.login');
    }

    public static function register()
    {
        return view('auth.register');
    }
}
