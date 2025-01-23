<?php

namespace App\Providers;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // This defines what 'manage-categories' means
        // When we call $user->cant('manage-categories'), it checks this rule
        Gate::define('manage-categories', function ($user) {
            return $user->role === UserRole::ADMIN_PROJECT;
        });

        // Define permission for managing menus
        Gate::define('manage-menus', function ($user) {
            return $user->role === UserRole::ADMIN_PROJECT;
        });

        // Define super admin permissions
        Gate::define('manage-admin-projects', function ($user) {
            return $user->role === UserRole::SUPER_ADMIN;
        });
    }

}
