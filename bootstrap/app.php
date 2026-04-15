<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Modules\Auth\App\Http\Middleware\Authenticate;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // web: __DIR__.'/../routes/web.php',
        using: function (Application $app) {
            // Root: Central routes (optional)
            Route::middleware('web')->group(route_path('web.php'));
            Route::middleware('api')->prefix('api')->name('api.')->group(route_path('api.php'));

            // Root: Tenant routes
            Route::middleware('tenant')->group(function () {
                Route::middleware(['web'])->group(route_path('tenant/web.php'));
                Route::middleware('api')->prefix('api')->name('api.')->group(route_path('tenant/api.php'));
            });
        },
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies('*');

        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);

        $middleware->group('universal', []);

        $middleware->group('tenant', [
            // 'with_tenancy',
            PreventAccessFromCentralDomains::class,
            InitializeTenancyByDomainOrSubdomain::class,
        ]);

        $middleware->group('with_tenancy', [
            InitializeTenancyByDomainOrSubdomain::class,
        ]);

        $middleware->alias([
            'auth' => Authenticate::class, // Replace the default 'auth' alias
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
