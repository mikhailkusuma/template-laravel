<?php

namespace App\Modules\MasterLocation\Cities\Controllers;

use App\Base\Classes\JsonResponse;
use App\Http\Controllers\Controller;
use App\Modules\MasterLocation\Cities\Models\Cities;
use App\Modules\MasterLocation\Cities\Requests\GetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ApiCitiesController extends Controller
{
    public function get(GetRequest $request)
    {
        try {
            $safeRequest = $request->safe();
            $conditionalWhere = [];
            if ($safeRequest->q) {
                $conditionalWhere[] = ['nama', 'like', "%$safeRequest->q%"];
            }

            $data = Cities::with('provinces')->where($conditionalWhere);

            if ($request->province) {
                $data = $data->whereHas('provinces', function ($query) use ($request) {
                    $query->where('nama', 'like', "%$request->province%");
                });
            }

            if ($safeRequest->sort) {
                $sort = explode(':', $safeRequest->sort);
                $column = $sort[0];
                $direction = $sort[1];

                if (!Schema::hasColumn('kabupaten', $column)) {
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
            $data = Cities::with('provinces')->find($id);

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
