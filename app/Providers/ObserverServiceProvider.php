<?php

namespace App\Providers;

use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use App\Domain\UserManagement\Entities\User;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }
}
