<?php

namespace App\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    // public function handle(Request $request, Closure $next, $role)
    // {
    //     if (!Auth::check() || Auth::user()->role !== $role) {
    //         abort(403, 'Unauthorized Access');
    //     }

    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next, $role = null)
    {
        if (!$role) {
            dd("Middleware role parameter is missing!"); // Debugging output
        }

        if (!Auth::check() || Auth::user()->role !== $role) {
            abort(403, 'Unauthorized Access');
        }

        return $next($request);
    }

}
