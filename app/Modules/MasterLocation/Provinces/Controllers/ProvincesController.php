<?php

namespace App\Modules\MasterLocation\Provinces\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\MasterLocation\Provinces\Models\Provinces;
use Illuminate\Http\Request;

class ProvincesController extends Controller
{
    public function index()
    {
        // return Provinces::paginate(10);
        return view('MasterLocation.Provinces.views.index');
    }

    public function datatableAjax(Request $request)
    {
        $data = Provinces::select('*')->orderBy('nama', 'asc');

        return datatables()->of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function show($id)
    {
        try {
            $provinces = Provinces::find($id);

            if (!$provinces) {
                return response()->json([
                    'success' => false,
                    'message' => 'Provinsi tidak ditemukan!'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $provinces
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data!'
            ], 500);
        }
    }
}
