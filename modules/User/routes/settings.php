<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Modules\User\app\Livewire\Settings\Appearance;
use Modules\User\app\Livewire\Settings\Password;
use Modules\User\app\Livewire\Settings\Profile;
use Modules\User\app\Livewire\Settings\TwoFactor;

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::livewire('settings/profile', Profile::class)->name('profile.edit');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::livewire('settings/password', Password::class)->name('user-password.edit');
    Route::livewire('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::livewire('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
