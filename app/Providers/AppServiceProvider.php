<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;

class AppServiceProvider extends ServiceProvider
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
        // Ensure password reset links use the configured APP_URL (avoids wrong origin in emails)
        ResetPassword::createUrlUsing(function ($notifiable, $token) {
            $path = route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false);

            $appUrl = rtrim(config('app.url') ?? env('APP_URL', ''), '/');

            return $appUrl . '/' . ltrim($path, '/');
        });
    }
}
