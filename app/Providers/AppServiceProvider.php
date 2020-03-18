<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Contracts\Support\DeferrableProvider;

class AppServiceProvider extends ServiceProvider 
// implements DeferrableProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->share('var', 'value');//share variable to all view
    }
}
