<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check() || !$request->user()->hasRole($roles)) {
            abort(404);
        }

        return $next($request);
    }
}
