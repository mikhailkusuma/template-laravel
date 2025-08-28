<?php

namespace App\Modules\MasterLocation\Cities\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\MasterLocation\Cities\Models\Cities;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function index()
    {
        // return Cities::with('provinces')->get();
        return view('MasterLocation.Cities.views.index');
    }

    public function datatableAjax(Request $request)
    {
        $data = Cities::with('provinces')->select('*')->orderBy('nama', 'asc');

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('province_name', function ($row) {
                return $row->provinces->nama ?? '-';
            })
            ->filterColumn('province_name', function ($query, $keyword) {
                $query->whereHas('provinces', function ($q) use ($keyword) {
                    $q->where('nama', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('nama', function ($query, $keyword) {
                $query->where('nama', 'like', "%{$keyword}%");
            })
            ->rawColumns(['province_name'])
            ->make(true);
    }

    public function show($id)
    {
        try {
            $data = Cities::find($id);

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kota atau kabupaten tidak ditemukan!'
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
}
