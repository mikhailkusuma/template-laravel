<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDisposition;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // admin
        $roles = [
            'Super Admin' => [],
            // 'Verifikator' => ['dashboard.', 'report.queue_reports', 'report.reports', 'master_location', 'master_data'],
            // 'Data Entry' => ['dashboard.', 'report.queue_reports'],
            // 'Disposition' => ['dispositions.'],
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
            echo "First user ({$firstUser->email}) assigned as Super Admin.\n";
        } else {
            echo "No users found. Super Admin role not assigned.\n";
        }

        $allUserExceptSuperAdmin = User::where('id', '!=', $firstUser->id)->get();
        foreach ($allUserExceptSuperAdmin as $user) {
            $user->assignRole('Verifikator');
            echo "User ({$user->email}) assigned as Verifikator.\n";
        }

        // $dispositionUser = UserDisposition::get();

        // foreach ($dispositionUser as $user) {
        //     $user->assignRole('Disposition');
        //     echo "User ({$user->email}) assigned as Disposition.\n";
        // }
    }
}
