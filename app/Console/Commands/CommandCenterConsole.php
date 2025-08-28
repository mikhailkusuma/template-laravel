<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class CommandCenterConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:command-center {action?} {target?} {arg1?} {arg2?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Center Console';

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
                            File::ensureDirectoryExists(base_path('app/Modules/') . $moduleName . '/Routes');
                            File::ensureDirectoryExists(base_path('app/Modules/') . $moduleName . '/Requests');
                            File::ensureDirectoryExists(base_path('app/Modules/') . $moduleName . '/views');


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
                            File::put(base_path('app/Modules/') . $moduleName . '/Routes/web.php', $routeFile);
                            File::put(base_path('app/Modules/') . $moduleName . '/Routes/api.php', $apiRouteFile);


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
                }
            }
        }
    }
}
