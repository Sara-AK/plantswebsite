<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Middleware\AdminMiddleware;
use App\Middleware\RoleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append(AdminMiddleware::class); // ✅ Register Admin Middleware
        // $middleware->append(RoleMiddleware::class);  // ✅ Register Role Middleware
        $middleware->alias([
            'role' => RoleMiddleware::class,  // ✅ Explicitly register role middleware
            'admin' => AdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->reportable(function (Throwable $e) {
            //
        });
    })
    ->create();
