<?php

namespace App\Modules\Authentication\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::middleware("api")
            ->group(__DIR__ . "/../Routes/api.php");
        Route::middleware("web")
            ->group(__DIR__ . "/../Routes/web.php");
    }
} 
