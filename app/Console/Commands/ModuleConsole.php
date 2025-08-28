<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ModuleConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:module-console';
    protected $signature = 'app {action?} {target?} {arg1?} {arg2?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');
        $target = $this->argument('target');
        $arg1 = $this->argument('arg1');
        $arg2 = $this->argument('arg2');

        if (strlen($action) > 0) {
            if (strlen($target) > 0) {
                switch ($action) {
                    case 'buat_modul': {
                            if (preg_match("/^[a-z]\w+$/", $target) == 0) {
                                $this->error("Parameter harus berupa naming snake_case dan tidak diawali dengan nomor dan karakter spesial selain underscore(_)");
                                return;
                            }
                            $moduleName = "";

                            foreach (explode("_", strtolower($target)) as $separate) {
                                $moduleName .= ucfirst($separate);
                            }

                            if (File::isDirectory(base_path('app/Modules/') . $moduleName)) {
                                $this->error("Modul ini sudah ada");
                                return;
                            }
                            $this->line("Membuat direktori...");
                            File::ensureDirectoryExists(base_path('app/Modules/') . $moduleName . '/Controllers');
                            File::ensureDirectoryExists(base_path('app/Modules/') . $moduleName . '/Middlewares');
                            File::ensureDirectoryExists(base_path('app/Modules/') . $moduleName . '/Models');
                            File::ensureDirectoryExists(base_path('app/Modules/') . $moduleName . '/Providers');
                            File::ensureDirectoryExists(base_path('app/Modules/') . $moduleName . '/Routes');
                            File::ensureDirectoryExists(base_path('app/Modules/') . $moduleName . '/Requests');
                            File::ensureDirectoryExists(base_path('app/Modules/') . $moduleName . '/views');
                            File::ensureDirectoryExists(base_path('app/Modules/') . $moduleName . '/migrations');


                            $this->line("Bootstraping file...");
                            $routeFile = <<<EOF
                        <?php
                        use Illuminate\Support\Facades\Route;
                        Route::group(['prefix' => "$target", 'as' => "$target."], function(){

                        });
                        EOF;
                            $apiRouteFile = <<<EOF
                        <?php
                        use Illuminate\Support\Facades\Route;
                        Route::group(['prefix' => "$target/api", 'as' => "$target.api."], function(){

                        });
                        EOF;

                            $metadataFile = <<<EOF
                        <?php

                        //You can put configuration in form of <key, value> type inside array below.

                        \$metadata = [
                            //'foo' => 'bar',
                            //'foo' => []
                            //etc
                        ];

                        EOF;

                            $routeProviderFile = <<<EOF
                        <?php

                        namespace App\Modules\\$moduleName\Providers;
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

                        EOF;

                            File::put(base_path('app/Modules/') . $moduleName . '/Routes/web.php', $routeFile);
                            File::put(base_path('app/Modules/') . $moduleName . '/Routes/api.php', $apiRouteFile);
                            File::put(base_path('app/Modules/') . $moduleName . '/metadata.php', $metadataFile);
                            File::put(base_path('app/Modules/') . $moduleName . '/Providers/RouteServiceProvider.php', $routeProviderFile);

                            // setelah File::put RouteServiceProvider.php
                            $this->line("Mendaftarkan provider...");

                            $providerPath = base_path('bootstrap/providers.php');
                            $providerClass = "App\\Modules\\{$moduleName}\\Providers\\RouteServiceProvider::class";

                            if (File::exists($providerPath)) {
                                $content = File::get($providerPath);
                                if (strpos($content, $providerClass) === false) {
                                    $newContent = preg_replace(
                                        '/(return\s*\[\s*)(.*)(\];)/s',
                                        "$1$2    {$providerClass},\n$3",
                                        $content
                                    );
                                    File::put($providerPath, $newContent);
                                    $this->info("Provider {$providerClass} berhasil diregister");
                                }
                            }

                            $this->info("Berhasil membuat modul");
                            break;
                        }

                    case "buat_controller":
                        if (strlen($target) == 0 || strlen($arg1) == 0) {
                            $this->error("Parameter kurang, [nama modul] [nama controller]");
                            return;
                        }

                        $checkModuleValidity = File::isDirectory(base_path('app/Modules/' . $target));
                        if (!$checkModuleValidity) {
                            $this->error("Modul dengan nama \"" . $target . "\" tidak dapat ditemukan");
                            return;
                        }

                        $result = Artisan::call("make:controller " . "\\\App\\\Modules\\\\" . $target . "\\\Controllers\\\\" . $arg1);
                        if ($result == 0) {
                            $this->info("Berhasil membuat controller");
                        }

                        break;

                    case "buat_model":
                        if (strlen($target) == 0 || strlen($arg1) == 0) {
                            $this->error("Parameter kurang, [nama modul] [nama model]");
                            return;
                        }

                        $checkModuleValidity = File::isDirectory(base_path('app/Modules/' . $target));
                        if (!$checkModuleValidity) {
                            $this->error("Modul dengan nama \"" . $target . "\" tidak dapat ditemukan");
                            return;
                        }

                        $result = Artisan::call("make:model " . "\\\App\\\Modules\\\\" . $target . "\\\Models\\\\" . $arg1);
                        if ($result == 0) {
                            $this->info("Berhasil membuat model");
                        }

                        break;

                    case "buat_request":
                        if (strlen($target) == 0 || strlen($arg1) == 0) {
                            $this->error("Parameter kurang, [nama modul] [nama request]");
                            return;
                        }

                        $checkModuleValidity = File::isDirectory(base_path('app/Modules/' . $target));
                        if (!$checkModuleValidity) {
                            $this->error("Modul dengan nama \"" . $target . "\" tidak dapat ditemukan");
                            return;
                        }

                        $result = Artisan::call("make:request " . "\\\App\\\Modules\\\\" . $target . "\\\Requests\\\\" . $arg1);
                        if ($result == 0) {
                            $this->info("Berhasil membuat request");
                        }

                        break;

                    case "buat_middleware":
                        if (strlen($target) == 0 || strlen($arg1) == 0) {
                            $this->error("Parameter kurang, [nama modul] [nama middleware]");
                            return;
                        }

                        $checkModuleValidity = File::isDirectory(base_path('app/Modules/' . $target));
                        if (!$checkModuleValidity) {
                            $this->error("Modul dengan nama \"" . $target . "\" tidak dapat ditemukan");
                            return;
                        }

                        $result = Artisan::call("make:middleware " . "\\\App\\\Modules\\\\" . $target . "\\\Middlewares\\\\" . $arg1);
                        if ($result == 0) {
                            $this->info("Berhasil membuat middleware");
                        }

                        break;

                    case "buat_provider":
                        if (strlen($target) == 0 || strlen($arg1) == 0) {
                            $this->error("Parameter kurang, [nama modul] [nama provider]");
                            return;
                        }

                        $checkModuleValidity = File::isDirectory(base_path('app/Modules/' . $target));
                        if (!$checkModuleValidity) {
                            $this->error("Modul dengan nama \"" . $target . "\" tidak dapat ditemukan");
                            return;
                        }

                        $result = Artisan::call("make:provider " . "\\\App\\\Modules\\\\" . $target . "\\\Providers\\\\" . $arg1);
                        if ($result == 0) {
                            $this->info("Berhasil membuat provider");
                        }

                        break;
                }
            }
        }
    }
}
