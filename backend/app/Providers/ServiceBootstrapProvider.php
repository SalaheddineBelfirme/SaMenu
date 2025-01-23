<?php

namespace App\Providers;

use App\Services\Implementations\ContactService;
use App\Services\Implementations\AuthService;
use App\Services\Implementations\CategoryService;
use App\Services\Implementations\MenuService as ImplementationsMenuService;
use App\Services\Implementations\OrganisationService;
use App\Services\Specifications\IContactService;
use App\Services\Specifications\IAuthService;
use App\Services\Specifications\ImenuService;
use App\Services\Implementations\MenuService;
use App\Services\Specifications\ICategoryService;
use App\Services\Specifications\IOrganisationService;
use Illuminate\Support\ServiceProvider;


class ServiceBootstrapProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IOrganisationService::class, OrganisationService::class);
        $this->app->bind(IContactService::class, ContactService::class);
        $this->app->bind(IAuthService::class, AuthService::class);
        $this->app->bind(ImenuService::class ,MenuService::class);
        $this->app->bind(ICategoryService::class ,CategoryService::class);


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
