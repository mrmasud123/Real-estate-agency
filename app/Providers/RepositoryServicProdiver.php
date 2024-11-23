<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\RepositoryInterfaces\AdminRepoInterface;
use App\Repositories\RepositoryImplementations\AdminRepo;
use App\Services\ServiceInterfaces\AdminInterface;
use App\Services\ServiceImplementations\AdminImplementation;

class RepositoryServicProdiver extends ServiceProvider {
    /**
     * Register services.
     */
    public function register(): void {
        $this->app->bind(AdminInterface::class, AdminImplementation::class);
        $this->app->bind(AdminRepoInterface::class, AdminRepo::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {
        //
    }
}
