<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserActive
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->is_active == config('common.active'))
        {
            return $next($request);
        }
        \Auth::logout();
        return redirect()->route('auth.login')->withErrors(['message' => __('This account has been disabled')]);
    }
}
