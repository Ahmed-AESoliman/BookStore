<?php

namespace App\Providers;

use App\Interfaces\BaseAuthRepositoryInterface;

use App\Repositories\BaseAuthRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BaseAuthRepositoryInterface::class, BaseAuthRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}