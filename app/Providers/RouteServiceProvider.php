<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
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
        $this->loadModuleRoutes();
    }

    private function loadModuleRoutes()
    {
        $modulesPath = app_path('Modules');

        if (File::exists($modulesPath)) {
            foreach (glob($modulesPath . '/*/routes/web.php') as $route) {
                Route::middleware('web')->group(function () use ($route) {
                    require $route;
                });
            }
            foreach (glob($modulesPath . '/*/routes/api.php') as $route) {
                Route::middleware('api')->group(function () use ($route) {
                    require $route;
                });
            }
        }
    }
}
