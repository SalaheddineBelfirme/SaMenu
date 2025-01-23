<?php

namespace App\Providers;

use App\Repositories\Implementations\CategoryRepository;
use App\Repositories\Implementations\OrganisationRepository;
use App\Repositories\Implementations\UserRepository;

use App\Repositories\Implementations\ContactRepository;
use App\Repositories\Implementations\MenuRepository;
use App\Repositories\Specifications\ICategoryRepository;
use App\Repositories\Specifications\IContactRepository;
use App\Repositories\Specifications\IMenuRepository;
use App\Repositories\Specifications\IUserRepository;
use App\Repositories\Specifications\IOrganisationRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IOrganisationRepository::class, OrganisationRepository::class);
        $this->app->bind(IContactRepository::class, ContactRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IMenuRepository::class,MenuRepository::class);
        $this->app->bind(ICategoryRepository::class,CategoryRepository::class);

        

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
