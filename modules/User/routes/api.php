<?php

use Illuminate\Support\Facades\Route;

Route::domain(domain())->group(function () {
    Route::middleware(['auth:api'])->prefix('v1')->group(function () {
        //
    });
});
