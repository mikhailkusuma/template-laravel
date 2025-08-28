<?php

namespace App\Modules\MasterLocation\Districts\Controllers;

use App\Base\Classes\JsonResponse;
use App\Http\Controllers\Controller;
use App\Modules\MasterLocation\Districts\Models\Districts;
use App\Modules\MasterLocation\Districts\Requests\GetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ApiDistrictsController extends Controller
{
    public function get(GetRequest $request)
    {
        try {
            $safeRequest = $request->safe();
            $conditionalWhere = [];
            if ($safeRequest->q) {
                $conditionalWhere[] = ['nama', 'like', "%$safeRequest->q%"];
            }

            $data = Districts::with('cities.provinces')->where($conditionalWhere);

            if ($request->province) {
                $data = $data->whereHas('cities.provinces', function ($query) use ($request) {
                    $query->where('nama', 'like', "%$request->province%");
                });
            }

            if ($request->city) {
                $data = $data->whereHas('cities', function ($query) use ($request) {
                    $query->where('nama', 'like', "%$request->city%");
                });
            }

            if ($safeRequest->sort) {
                $sort = explode(':', $safeRequest->sort);
                $column = $sort[0];
                $direction = $sort[1];

                if (!Schema::hasColumn('kecamatan', $column)) {
                    return JsonResponse::create()
                        ->setCode(-1, 400)
                        ->setMeta("Sort column `{$column}` does not exist", true)
                        ->send();
                }

                $data = $data->orderBy($column, $direction);
            }

            if ($request->has('get')) {
                $data = $data->get();
            } else {
                $data = $data->paginate($safeRequest->paginate ?? 10);
            }
            return JsonResponse::create($data)->setMeta('Success')->send();
        } catch (\Throwable $th) {
            return reportAndSendJSONError($th, "Error while fetching data");
        }
    }

    public function show($id)
    {
        try {
            $data = Districts::with('cities.provinces')->find($id);

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
