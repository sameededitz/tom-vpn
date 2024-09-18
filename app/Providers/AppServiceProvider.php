<?php

namespace App\Providers;

use App\Listeners\UpdateLastLogin;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        Event::listen(
            UpdateLastLogin::class
        );

        Schema::defaultStringLength(191);

        RateLimiter::for('login-user', function (Request $request) {
            return Limit::perMinute(5)->by($request->email . $request->ip());
        });
    }
}
