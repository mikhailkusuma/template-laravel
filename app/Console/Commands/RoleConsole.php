<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class RoleConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:role-console';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Role';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::beginTransaction();
            // Define roles
            $roles = [
                'Super Admin' => [],
                // 'Verifikator' => ['dashboard.', 'report.queue_reports', 'report.reports', 'master_location', 'master_data'],
                // 'Data Entry' => ['dashboard.', 'report.queue_reports']
            ];

            foreach ($roles as $roleName => $permissions) {
                $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);

                if ($roleName === 'Super Admin') {
                    // Assign all permissions to Super Admin
                    $role->syncPermissions(Permission::all());
                } else {
                    // Assign only specific permissions
                    $filteredPermissions = Permission::where(function ($query) use ($permissions) {
                        foreach ($permissions as $prefix) {
                            $query->orWhere('name', 'like', "$prefix%");
                        }
                    })->get();

                    $role->syncPermissions($filteredPermissions);
                }
            }

            // Assign first user to Super Admin role
            $firstUser = User::orderBy('id', 'asc')->first();

            if ($firstUser) {
                $firstUser->assignRole('Super Admin');
                $this->info("First user ({$firstUser->email}) assigned as Super Admin.");
            } else {
                $this->warn("No users found. Super Admin role not assigned.");
            }

            DB::commit();
            $this->info("Roles and permissions generated successfully!");
        } catch (\Exception $e) {
            DB::rollBack();
            __log("Console:generate-role", $e, "error");
        }
    }
}
