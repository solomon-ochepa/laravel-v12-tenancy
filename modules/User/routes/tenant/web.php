<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\User\App\Http\Controllers\Tenant\ProfileController;

Route::middleware(['tenant', 'auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
