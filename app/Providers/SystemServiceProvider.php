<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;

use App\Services\ServiceImplementations\AdminImplementation;
use app\Services\ServiceInterfaces\AdminInterface;
class SystemServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // $this->app->bind(AdminInterface::class, AdminImplementation::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
