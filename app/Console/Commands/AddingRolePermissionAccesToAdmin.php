<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class AddingRolePermissionAccesToAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:adding-role-permission';

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
        $this->info('Migration started..');

        $migrate = Artisan::call('migrate');

        $this->info('Migrate successfully.');

        $this->info('Truncate started..');
        // Nonaktifkan constraint
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->info('Foreign key check disabled.');

        DB::statement('TRUNCATE table roles');
        $this->info('Truncate roles successfully.');
        DB::statement('TRUNCATE table model_has_roles');
        $this->info('Truncate model_has_roles successfully.');
        DB::statement('TRUNCATE table model_has_permissions');
        $this->info('Truncate model_has_permissions successfully.');
        DB::statement('TRUNCATE table permissions');
        $this->info('Truncate permissions successfully.');
        DB::statement('TRUNCATE table role_has_permissions');
        $this->info('Truncate role_has_permissions successfully.');
        // Aktifkan kembali constraint
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $this->info('Foreign key check enabled.');
        $this->info('Truncate successfully.');

        $this->info('Permission started..');
        Artisan::call('route:clear');
        $this->info('Route cache cleared successfully.');
        Artisan::call('permission:cache-reset');
        $this->info('Permission cache reset successfully.');
        Artisan::call('permission:create-permission-routes');
        $this->info('Permission successfully.');

        $this->info('Seeder started..');
        Artisan::call('db:seed', [
            '--class' => 'GenerateAtasSeeder',
            '--force' => true
        ]);
        $this->info('Seeder successfully.');
    }
}
