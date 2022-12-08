<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\FileRepository;
use App\Repositories\FileRepositoryImpl;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FileRepository::class, FileRepositoryImpl::class);
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
