<?php

namespace App\Providers;

use Crm\Locators\CurrentAdminLocator;
use Crm\Locators\CurrentEmployeeLocator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CurrentEmployeeLocator::class);
        $this->app->singleton(CurrentAdminLocator::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
