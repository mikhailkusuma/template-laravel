<?php

namespace App\Modules\ManagementUser\Permissions\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class PermissionsController extends Controller
{
    public function index()
    {
        $total_permissions = Permission::count();
        return view('ManagementUser.Permissions.views.index', compact('total_permissions'));
    }

    public function datatableAjax(Request $request)
    {
        $data = Permission::select('*');

        return datatables()->of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function show($id)
    {
        try {
            $statuses = Permission::find($id);

            if (!$statuses) {
                return response()->json([
                    'success' => false,
                    'message' => 'Permissions tidak ditemukan!'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $statuses
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data!'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validasiInput = Validator::make(
            $request->all(),
            [
                'name' => "required|string|min:1|max:100",
                'guard_name' => "required|string",
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'name.max' => 'Nama maksimal 100 karakter.',
                'guard_name.required' => 'Guard wajib diisi.',
            ]
        );

        if ($validasiInput->fails()) {
            return response()->json([
                'errors' => $validasiInput->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $data = Permission::create([
                'name' => $request->input('name'),
                'guard_name' => $request->input('guard_name'),
            ]);

            DB::commit();

            // Return success response
            return response()->json([
                'message' => 'Data berhasil disimpan',
                'data'    => $data
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            __log("Permissions:create", $e, "error");
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validasiInput = Validator::make(
            $request->all(),
            [
                'name' => "required|string|min:1|max:100",
                'guard_name' => "required|string",
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'name.max' => 'Nama maksimal 100 karakter.',
                'guard_name.required' => 'Guard wajib diisi.',
            ]
        );

        if ($validasiInput->fails()) {
            return response()->json([
                'errors' => $validasiInput->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $data = Permission::findOrFail($id);

            $data->update([
                'name' => $request->input('name'),
                'guard_name' => $request->input('guard_name'),
            ]);

            DB::commit();

            // Return success response
            return response()->json([
                'message' => 'Data berhasil disimpan',
                'data'    => $data
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            __log("Permissions:update", $e, "error");
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $data = Permission::findOrFail($id);

            $data->delete();

            DB::commit();

            // Return success response
            return response()->json([
                'message' => 'Data berhasil dihapus',
                'data'    => $data
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            __log("Permissions:delete", $e, "error");
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }

    public function generatePermissions()
    {
        try {
            DB::beginTransaction();
            $routes = collect(Route::getRoutes())->filter(function ($route) {
                return in_array('web', $route->gatherMiddleware());
            });

            foreach ($routes as $route) {
                $permissionName = $route->getName(); // Use route name as permission
                [$first_group] = explode('.', $permissionName);
                $comment = $route->getComment();
                if (is_null($comment)) {
                    $comment = Str::title(str_replace('.', ' ', $route->getName()));
                }
                // use this Skip if permission starts with "dispositions." : !str_starts_with($permissionName, 'dispositions.')
                if ($permissionName && !str_starts_with($permissionName, 'dispositions.') && !Permission::where('name', $permissionName)->where('guard_name', 'web')->exists()) {
                    Permission::create(['name' => $permissionName, 'guard_name' => 'web', 'group_name' => $first_group, 'desc' => $comment]);
                }
            }

            DB::commit();

            return redirect()->route("management_user.permissions.index")->with("success", "Permissions berhasil disimpan");

            $routes = $routes->map(function ($route) {
                return [
                    'uri' => $route->uri(),
                    'name' => $route->getName(),
                    'methods' => $route->methods(),
                    'middleware' => $route->gatherMiddleware(),
                ];
            });

            return response()->json([
                'message' => 'Permissions generated successfully!',
                'routes' => $routes
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            __log("GeneratePermissions:generate", $e, "error");
            return redirect()->back()->with("error", "Terjadi Kesalahan, Data gagal disimpan")->withInput();
        }
    }
}
