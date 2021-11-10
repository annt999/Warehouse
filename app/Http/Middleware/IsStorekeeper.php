<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsStorekeeper
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
        if (!auth()->user()->isStorekeeper()) {
            abort(404);
        }
        return $next($request);
    }
}
