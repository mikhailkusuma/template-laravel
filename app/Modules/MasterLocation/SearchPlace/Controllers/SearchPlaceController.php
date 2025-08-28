<?php

namespace App\Modules\MasterLocation\SearchPlace\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\MasterLocation\Cities\Models\Cities;
use App\Modules\MasterLocation\Districts\Models\Districts;
use App\Modules\MasterLocation\Villages\Models\Villages;
use Illuminate\Http\Request;

class SearchPlaceController extends Controller
{
    public function searchPlace(Request $request)
    {
        $query = $request->input('search');
        // 3509 is the ID of jember
        $kecamatan = Districts::where('nama', 'like', '%' . $query . '%')->where('kabupaten_id', 3509)->get();
        $desa = Villages::with('districts')->where('nama', 'like', '%' . $query . '%')->whereHas('districts', function ($query) {
            $query->where('kabupaten_id', 3509);
        })->get();
        // $data = Cities::with([
        //     'districts' => function ($query) use ($request) {
        //         $query->where('kecamatan.nama', 'like', '%' . $request->input('search') . '%')
        //             ->select('kecamatan.id as district_id', 'kecamatan.nama', 'kecamatan.kabupaten_id');
        //     },
        //     'villages' => function ($query) use ($request) {
        //         $query->where('desa.nama', 'like', '%' . $request->input('search') . '%')
        //             ->select('desa.id as village_id', 'desa.nama', 'desa.kecamatan_id');
        //     }
        // ])->find(3509);

        $data = $kecamatan->merge($desa);

        return response()->json($data);
    }
}
