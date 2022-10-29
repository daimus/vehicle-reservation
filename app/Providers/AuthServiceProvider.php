<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isSuper', function($user) {
            return $user->role == 'super';
        });
        Gate::define('isOfficer', function($user) {
            return $user->role == 'officer';
        });
        Gate::define('isHead', function($user) {
            return $user->role == 'head';
        });
        Gate::define('isAdmin', function($user) {
            return $user->role == 'admin';
        });
    }
}
