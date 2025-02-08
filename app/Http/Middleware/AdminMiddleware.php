<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
    //     // Check if user is logged in and has 'admin' role
    //     if (!Auth::check() || Auth::user()->role !== 'admin') {
    //         // abort(403, 'Unauthorized Access');
    //     }

    //     return $next($request);
    // }

        if (!Auth::check() || !Auth::user()->isAdmin()) {
            // abort(403, 'Unauthorized Access');

            return $next($request);
        }
    }
}
