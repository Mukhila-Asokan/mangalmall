<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Policies\UserPolicy;
use App\Models\User;
use App\Models\Subscribers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Auth::routes();

        // Define redirect callback for dynamic redirection
        \Illuminate\Auth\Middleware\Authenticate::redirectUsing(function ($request) {
            return route('login');
        });
    }
}
