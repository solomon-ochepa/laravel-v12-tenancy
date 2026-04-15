<?php

use Illuminate\Support\Facades\Route;
use Modules\User\App\Http\Controllers\ProfileController;

Route::domain(domain())->group(function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});
