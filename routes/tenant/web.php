<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'tenant'])->group(function () {
    Route::get('/', fn () => view('tenant.welcome'))->name('home');
    Route::get('/dashboard', fn () => view('tenant.dashboard'))->middleware(['auth', 'verified'])->name('dashboard');
});
