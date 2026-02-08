<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        using: function () {
            // Central web routes
            foreach (config('tenancy.central_domains', []) as $domain) {
                Route::middleware('web')
                    ->domain($domain)
                    ->group(base_path('routes/web.php'));
            }

            //  Tenant web routes
            if (file_exists($file = base_path('routes/tenant/web.php'))) {
                Route::middleware(['web', 'tenant'])->group($file);
            }
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->group('tenant', [
            InitializeTenancyByDomainOrSubdomain::class,
            PreventAccessFromCentralDomains::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
