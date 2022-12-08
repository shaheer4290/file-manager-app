<?php

namespace App\Providers;

use App\Services\FileService;
use App\Services\FileServiceImpl;
use Illuminate\Support\ServiceProvider;

class RegistryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FileService::class, FileServiceImpl::class);
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
