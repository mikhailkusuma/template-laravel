<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class GeneratePermissionRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:create-permission-routes';

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
        $routes = Route::getRoutes()->getRoutesByName();
        foreach ($routes as $route) {
            try {
                if ($route->getName() != '' && isset($route->getAction()['middleware']) && count($route->getAction()['middleware']) >= 2) {
                    $permission = Permission::where('name', $route->getName())->first();
                    $data = $route->getName();
                    [$first_group] = explode('.', $data);
                    $comment = $route->getComment();
                    if (is_null($comment)) {
                        $comment = Str::title(str_replace('.', ' ', $route->getName()));
                    }
                    if (is_null($permission)) {
                        permission::create(['name' => $data, 'group_name' => $first_group, 'desc' => $comment]);
                        $this->info('Permission routes ' . $route->getName()  . ' added successfully.');
                    }
                } else {
                    $this->info('Permission routes ' . $route->getName()  . ' not added.');
                }
            } catch (\Throwable $th) {
                $this->error('Error: ' . $th->getMessage());
                $this->info('Permission routes ' . $route->getName()  . 'Err not added.');
            }
        }

        $this->info('All Permission routes added successfully.');
    }
}
