<?php

namespace Modules\Auth\App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Modules\Auth\App\Actions\Fortify\CreateNewUser;
use Modules\Auth\App\Actions\Fortify\ResetUserPassword;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureActions();
        $this->configureViews();
        $this->configureRateLimiting();
    }

    /**
     * Configure Fortify actions.
     */
    private function configureActions(): void
    {
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::createUsersUsing(CreateNewUser::class);
    }

    /**
     * Configure Fortify views.
     */
    private function configureViews(): void
    {
        Fortify::loginView(fn () => tenant() ? view('auth::livewire.tenant.login') : view('auth::livewire.login'));
        Fortify::verifyEmailView(fn () => view('auth::livewire.verify-email'));
        Fortify::twoFactorChallengeView(fn () => view('auth::livewire.two-factor-challenge'));
        Fortify::confirmPasswordView(fn () => view('auth::livewire.confirm-password'));
        Fortify::registerView(fn () => view('auth::livewire.register'));
        Fortify::resetPasswordView(fn () => view('auth::livewire.reset-password'));
        Fortify::requestPasswordResetLinkView(fn () => view('auth::livewire.forgot-password'));
    }

    /**
     * Configure rate limiting.
     */
    private function configureRateLimiting(): void
    {
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });
    }
}
