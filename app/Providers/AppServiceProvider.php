<?php

namespace App\Providers;

//use App\Http\Middleware\IsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        app('router')->aliasMiddleware('admin', \App\Http\Middleware\IsAdmin::class);
    }
}
