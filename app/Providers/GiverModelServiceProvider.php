<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GiverModelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Giver::observe(\App\Observers\GiverObserver::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
