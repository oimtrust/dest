<?php

namespace App\Providers;

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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-users', function($user) {
            return count(array_intersect(['ADMIN'], json_decode($user->roles)));
        });

        Gate::define('manage-projects', function($user) {
            return count(array_intersect(['ADMIN', 'PM', 'QA'], json_decode($user->roles)));
        });

        Gate::define('manage-stories', function($user) {
            return count(array_intersect(['QA'], json_decode($user->roles)));
        });

        Gate::define('manage-conditions', function($user) {
            return count(array_intersect(['QA'], json_decode($user->roles)));
        });
    }
}
