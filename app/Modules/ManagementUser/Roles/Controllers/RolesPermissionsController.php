<?php

namespace App\Modules\ManagementUser\Roles\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsController extends Controller
{
    public function index(String $id)
    {
        $role = Role::find($id);
        $permissions = Permission::orderBy('name', 'asc')->get();
        $permission_active = $role->permissions->pluck('id');
        return view('ManagementUser.Roles.views.permissions.index', compact('role', 'permissions', 'permission_active'));
    }

    public function setPermission(Request $request, String $id)
    {
        // return [$id, $request->permission_id];

        $role = Role::find($id);

        if (!$role) {
            return back()->with('error', 'Role tidak ditemukan.');
        }

        $permissionIds = $request->permission_id ?? [];

        if (!is_array($permissionIds)) {
            return back()->with('error', 'Permission ID harus berupa array.');
        }

        $permissions = Permission::whereIn('id', $permissionIds)->get();

        $role->syncPermissions($permissions); // Sinkronisasi izin baru

        return back()->with('success', 'Permissions berhasil diperbarui untuk role.');
    }
}
