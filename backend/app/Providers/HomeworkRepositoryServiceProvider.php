<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HomeworkRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(  'App\Repositories\HomeworkRepositoryInterface',
            'App\Repositories\HomeworkRepository');
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
