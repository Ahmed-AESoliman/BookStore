<?php

namespace App\Providers;

use App\Interfaces\BaseAuthRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Repositories\BaseAuthRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BaseAuthRepositoryInterface::class, BaseAuthRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
