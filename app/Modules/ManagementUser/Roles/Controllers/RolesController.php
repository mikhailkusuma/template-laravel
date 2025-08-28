<?php

namespace App\Modules\ManagementUser\Roles\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        // return Role::paginate(10);
        return view('ManagementUser.Roles.views.index');
    }

    public function datatableAjax(Request $request)
    {
        $data = Role::select('*');

        return datatables()->of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function show($id)
    {
        try {
            $statuses = Role::find($id);

            if (!$statuses) {
                return response()->json([
                    'success' => false,
                    'message' => 'Roles tidak ditemukan!'
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

            $data = Role::create([
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
            __log("Roles:create", $e, "error");
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

            $data = Role::findOrFail($id);

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
            __log("Roles:update", $e, "error");
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $data = Role::findOrFail($id);

            $data->delete();

            DB::commit();

            // Return success response
            return response()->json([
                'message' => 'Data berhasil dihapus',
                'data'    => $data
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            __log("Roles:delete", $e, "error");
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }
}
