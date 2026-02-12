<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\App\Http\Controllers\DashboardLoginController;
use Modules\Auth\App\Livewire\Login;

Route::middleware(['auth', 'verified'])->group(function () {
    //
});

Route::middleware(['guest'])->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('dashboard/login', [DashboardLoginController::class, 'create'])->name('dashboard.login');
});

require __DIR__.'/auth.php';
