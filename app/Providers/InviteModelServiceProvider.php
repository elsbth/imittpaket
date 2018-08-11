<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class InviteModelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Invite::observe(\App\Observers\InviteObserver::class);
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
