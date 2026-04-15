<?php

use Illuminate\Support\Facades\Route;
use Modules\Tenancy\App\Http\Controllers\TenancyController;

Route::domain(domain())->group(function () {
    Route::middleware(['auth:api'])->prefix('v1')->group(function () {
        Route::apiResource('tenancies', TenancyController::class);
    });
});
