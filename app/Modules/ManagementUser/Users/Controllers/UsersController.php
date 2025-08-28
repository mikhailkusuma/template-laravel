<?php

namespace App\Modules\ManagementUser\Users\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\ManagementUser\Users\Models\Users;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index()
    {
        // return Users::paginate(10);
        $roles = Role::get();
        return view('ManagementUser.Users.views.index', compact('roles'));
    }

    public function datatableAjax(Request $request)
    {
        $data = Users::select('*')->orderBy('name', 'asc');

        return datatables()->of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function show($id)
    {
        try {
            $data = User::with('roles:id')->find($id);

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kategori tidak ditemukan!'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $data
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
                'email' => "required|email|string|unique:users,email",
                'password' => "required|string|min:8",
                'role_id' => "required|array",
                'role_id.*' => "integer|exists:roles,id", // Pastikan setiap ID role valid
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'name.max' => 'Nama maksimal 100 karakter.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal 8 karakter.',
                'role_id.required' => 'Role wajib diisi.',
                'role_id.*.integer' => 'Role harus berupa angka.',
                'role_id.*.exists' => 'Role tidak ditemukan di database.',
            ]
        );

        if ($validasiInput->fails()) {
            return response()->json([
                'errors' => $validasiInput->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $data = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            $roleNames = Role::whereIn('id', $request->role_id)->pluck('name')->toArray();
            $data->syncRoles($roleNames);

            DB::commit();

            // Return success response
            return response()->json([
                'message' => 'Data berhasil disimpan',
                'data'    => $data
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            __log("Users:create", $e, "error");
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validasiInput = Validator::make(
            $request->all(),
            [
                'name' => "required|string|min:1|max:100",
                'email' => "required|email|string|unique:users,email," . $id,
                'password' => "nullable|string|min:8",
                'role_id' => "required|array",
                'role_id.*' => "integer|exists:roles,id",
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'name.max' => 'Nama maksimal 100 karakter.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan oleh user lain.',
                'password.min' => 'Password minimal 8 karakter.',
                'role_id.required' => 'Role wajib diisi.',
                'role_id.*.integer' => 'Role ID harus berupa angka.',
                'role_id.*.exists' => 'Role tidak ditemukan di database.',
            ]
        );

        if ($validasiInput->fails()) {
            return response()->json([
                'errors' => $validasiInput->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $data = User::findOrFail($id);

            $data->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->filled('password') ? Hash::make($request->input('password')) : $data->password,
            ]);

            $roleNames = Role::whereIn('id', $request->role_id)->pluck('name')->toArray();
            $data->syncRoles($roleNames);

            DB::commit();

            // Return success response
            return response()->json([
                'message' => 'Data berhasil disimpan',
                'data'    => $data
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            __log("Users:update", $e, "error");
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $data = Users::findOrFail($id);

            $data->delete();

            DB::commit();

            // Return success response
            return response()->json([
                'message' => 'Data berhasil dihapus',
                'data'    => $data
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            __log("Users:delete", $e, "error");
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }
}
