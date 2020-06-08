<?php

namespace App\Providers;


use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function($user) {
            if($user->group->is_admin) {
                return true;
            }
        });

        Gate::define('show', function ($user, $model) {
            return $user->hasPermission('show', $model) ? Response::allow() : Response::deny('access denied');
        });

        Gate::define('create', function ($user, $model) {
            return $user->hasPermission('show', $model) ? Response::allow() : Response::deny('access denied');
        });

        Gate::define('update', function ($user, $model) {
            return $user->hasPermission('show', $model) ? Response::allow() : Response::deny('access denied');
        });

        Gate::define('delete', function ($user, $model) {
            return $user->hasPermission('show', $model) ? Response::allow() : Response::deny('access denied');
        });

    }
}
