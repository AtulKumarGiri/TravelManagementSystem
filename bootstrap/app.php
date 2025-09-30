<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        /**
         * ---------------------------------------------------------
         * Middleware Groups
         * ---------------------------------------------------------
         */
        $middleware->group('api', [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

        /**
         * ---------------------------------------------------------
         * Middleware Aliases (like Kernel::$routeMiddleware)
         * ---------------------------------------------------------
         */
        $middleware->alias([
            // Role-based middlewares
            'admin'     => \App\Http\Middleware\AdminMiddleware::class,
            'partner'   => \App\Http\Middleware\PartnerMiddleware::class,
            'supplier'  => \App\Http\Middleware\SupplierMiddleware::class,
            'customer'  => \App\Http\Middleware\CustomerMiddleware::class,

            // Laravel default middlewares
            'auth'      => \App\Http\Middleware\Authenticate::class,
            'guest'     => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'verified'  => \App\Http\Middleware\EnsureEmailIsVerified::class,
        ]);

       

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
