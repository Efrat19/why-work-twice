<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CommentRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(  'App\Repositories\CommentRepositoryInterface',
            'App\Repositories\CommentRepository');
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
