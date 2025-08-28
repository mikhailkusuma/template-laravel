<?php

use App\Modules\MasterLocation\Provinces\Controllers\ProvincesController;
use App\Modules\MasterLocation\Provinces\Middlewares\ProvincesMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::group(['prefix' => "provinces", 'as' => "provinces.", "middleware" => [
    ProvincesMiddleware::class
]], function () {
    Route::get(
        '/',
        [ProvincesController::class, 'index']
    )->name('index')->middleware('permission:master_location.provinces.index')->comment('Provinces Index');

    Route::get("/datatable", [ProvincesController::class, "datatableAjax"])->name("datatable")->middleware('permission:master_location.provinces.datatable')->comment('Provinces Datatable');

    Route::get('/{id}', [ProvincesController::class, 'show'])->name("show")->middleware('permission:master_location.provinces.show')->comment('Provinces Show');
});
