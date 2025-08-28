<?php

namespace App\Modules\MasterLocation\Districts\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\MasterLocation\Districts\Models\Districts;
use Illuminate\Http\Request;

class DistrictsController extends Controller
{
    public function index()
    {
        // return Districts::with('provinces')->get();
        return view('MasterLocation.Districts.views.index');
    }

    public function datatableAjax(Request $request)
    {
        $data = Districts::with('cities.provinces')->select('*')->orderBy('nama', 'asc');

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('province_name', function ($row) {
                return $row->cities?->provinces?->nama ?? '-';
            })
            ->addColumn('city_name', function ($row) {
                return $row->cities?->nama ?? '-';
            })
            ->filterColumn('province_name', function ($query, $keyword) {
                $query->whereHas('cities.provinces', function ($q) use ($keyword) {
                    $q->where('nama', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('city_name', function ($query, $keyword) {
                $query->whereHas('cities', function ($q) use ($keyword) {
                    $q->where('nama', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('nama', function ($query, $keyword) {
                $query->where('nama', 'like', "%{$keyword}%");
            })
            ->rawColumns(['province_name', 'city_name'])
            ->make(true);
    }

    public function show($id)
    {
        try {
            $data = Districts::find($id);

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
