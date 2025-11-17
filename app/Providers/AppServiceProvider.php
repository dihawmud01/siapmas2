<?php

namespace App\Providers;

use App\Models\SP;
use App\Observers\SPObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();

        if (config('app.env') === 'production') {
            \URL::forceScheme('https');
        }

        SP::observe(SPObserver::class);
    }
}