<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
// use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Comment' => 'App\Policies\CommentPolicy',
        'App\Homework' => 'App\Policies\HomeworkPolicy',
        'App\User' => 'App\Policies\UserPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('create-user', 'App\Policies\UserPolicy@create');
        Gate::define('update-user', 'App\Policies\UserPolicy@update');

        Gate::define('create-homework', 'App\Policies\HomeworkPolicy@create');
        Gate::define('update-homework', 'App\Policies\HomeworkPolicy@update');
        Gate::define('delete-homework', 'App\Policies\HomeworkPolicy@delete');

        Gate::define('create-comment', 'App\Policies\CommentPolicy@create');
        Gate::define('update-comment', 'App\Policies\CommentPolicy@update');
        Gate::define('delete-comment', 'App\Policies\CommentPolicy@delete');
        //
    }
}
