<?php

namespace App\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role = null)
    {
        if (!$role) {
            abort(500, 'Middleware role parameter is missing! Check your route definitions.');
        }

        if (!Auth::check()) {
            abort(403, 'User is not authenticated!');
        }

        if (Auth::user()->role !== $role) {
            abort(403, 'Unauthorized Access! Your role: ' . Auth::user()->role . ', Required role: ' . $role);
        }

        return $next($request);
    }
}
