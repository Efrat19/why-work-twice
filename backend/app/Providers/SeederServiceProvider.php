<?php

namespace App\Providers;

use App\Services\SeederStore;
use Illuminate\Support\ServiceProvider;

class SeederServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\SeederStore',function () {
            return new SeederStore();
        });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
