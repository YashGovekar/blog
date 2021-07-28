<?php

namespace App\Providers;

use App\Repositories;
use App\Repositories\Interfaces;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Interfaces\AuthorRepositoryInterface::class, Repositories\AuthorRepository::class);
        $this->app->bind(Interfaces\CategoryRepositoryInterface::class, Repositories\CategoryRepository::class);
        $this->app->bind(Interfaces\PostRepositoryInterface::class, Repositories\PostRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
