<?php

namespace App\Providers;

use Auth;
use View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        \Blade::if('superAdmin', function(){
            return auth()->user()->isSuperAdmin();
        });

        // View::share('teamId', Auth::user()->team()->teamId);
    }
}
