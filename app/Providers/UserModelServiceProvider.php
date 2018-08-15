<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UserModelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \App\User::observe(\App\Observers\UserObserver::class);
    }
}
