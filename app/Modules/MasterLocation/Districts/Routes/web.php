<?php

use App\Modules\MasterLocation\Districts\Controllers\DistrictsController;
use App\Modules\MasterLocation\Districts\Middlewares\DistrictsMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::group(['prefix' => "districts", 'as' => "districts.", "middleware" => [
    DistrictsMiddleware::class
]], function () {
    Route::get(
        '/',
        [DistrictsController::class, 'index']
    )->name('index')->middleware('permission:master_location.districts.index')->comment('Districts Index');

    Route::get("/datatable", [DistrictsController::class, "datatableAjax"])->name("datatable")->middleware('permission:master_location.districts.datatable')->comment('Districts Datatable');

    Route::get('/{id}', [DistrictsController::class, 'show'])->name("show")->middleware('permission:master_location.districts.show')->comment('Districts Show');
});
