<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\App\Http\Controllers\DashboardLoginController;

Route::domain(domain())->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('dashboard/login', [DashboardLoginController::class, 'create'])->name('dashboard.login');
    });
});

Route::middleware(['universal', 'with_tenancy'])->group(function () {
    require __DIR__.'/auth.php';
});
