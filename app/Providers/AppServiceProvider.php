<?php

namespace App\Providers;

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
        // Use Bootstrap 5 for pagination by default
        Paginator::useBootstrap();

        // For admin routes, use our custom pagination view
        Paginator::defaultView('vendor.pagination.admin-pagination');
        Paginator::defaultSimpleView('vendor.pagination.simple-bootstrap-5');
    }
}
