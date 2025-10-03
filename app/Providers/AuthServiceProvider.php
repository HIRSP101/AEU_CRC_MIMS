<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('3', function ($user) {
            return $user->hasPermissionTo('read data')
                && $user->hasPermissionTo('edit data')
                && $user->hasPermissionTo('access data');
        });

        Gate::define('1', function ($user) {
            return $user->hasPermissionTo('read data');
        });

        Gate::define('2', function ($user) {
            return $user->hasPermissionTo('read data')
                && $user->hasPermissionTo('edit data');
        });

    }
}

