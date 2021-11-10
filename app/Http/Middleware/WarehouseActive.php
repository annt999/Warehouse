<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class WarehouseActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->warehouse()->first()->is_active == config('common.active'))
        {
            return $next($request);
        }
        \Auth::logout();
        return redirect()->route('auth.login')->withErrors(['message' => __('This warehouse has been disabled')]);    }
}
