<?php

namespace App\Providers;

use App\Interfaces\BaseAuthRepositoryInterface;
use App\Interfaces\BookRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ChatRepositoryInterface;
use App\Repositories\BaseAuthRepository;
use App\Repositories\BookRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ChatRepository;
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
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(ChatRepositoryInterface::class, ChatRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
