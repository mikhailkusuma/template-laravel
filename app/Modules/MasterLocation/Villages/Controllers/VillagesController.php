<?php

namespace App\Modules\MasterLocation\Villages\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\MasterLocation\Villages\Models\Villages;
use Illuminate\Http\Request;

class VillagesController extends Controller
{
    public function index()
    {
        // return Villages::with('provinces')->get();
        return view('MasterLocation.Villages.views.index');
    }

    public function datatableAjax(Request $request)
    {
        $data = Villages::with('districts.cities.provinces')->select('*')->orderBy('nama', 'asc');

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('province_name', function ($row) {
                return $row->districts?->cities?->provinces?->nama ?? '-';
            })
            ->addColumn('city_name', function ($row) {
                return $row->districts?->cities?->nama ?? '-';
            })
            ->addColumn('district_name', function ($row) {
                return $row->districts?->nama ?? '-';
            })
            ->filterColumn('district_name', function ($query, $keyword) {
                $query->whereHas('districts', function ($q) use ($keyword) {
                    $q->where('nama', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('province_name', function ($query, $keyword) {
                $query->whereHas('districts.cities.provinces', function ($q) use ($keyword) {
                    $q->where('nama', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('city_name', function ($query, $keyword) {
                $query->whereHas('districts.cities', function ($q) use ($keyword) {
                    $q->where('nama', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('nama', function ($query, $keyword) {
                $query->where('nama', 'like', "%{$keyword}%");
            })
            ->rawColumns(['province_name', 'city_name', 'districts'])
            ->make(true);
    }

    public function show($id)
    {
        try {
            $data = Villages::find($id);

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
