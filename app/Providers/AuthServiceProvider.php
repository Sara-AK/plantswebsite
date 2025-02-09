<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Allow role removal only for non-admin users
        Gate::define('request-role-removal', function ($user) {
            return $user->role !== 'admin'; // Only non-admins can request role removal
        });
    }
}
