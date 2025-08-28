<?php

use App\Modules\MasterLocation\Cities\Controllers\CitiesController;
use App\Modules\MasterLocation\Cities\Middlewares\CitiesMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::group(['prefix' => "cities", 'as' => "cities.", "middleware" => [
    CitiesMiddleware::class
]], function () {
    Route::get(
        '/',
        [CitiesController::class, 'index']
    )->name('index')->middleware('permission:master_location.cities.index')->comment('Cities Index');

    Route::get("/datatable", [CitiesController::class, "datatableAjax"])->name("datatable")->middleware('permission:master_location.cities.datatable')->comment('Cities Datatable');

    Route::get('/{id}', [CitiesController::class, 'show'])->name("show")->middleware('permission:master_location.cities.show')->comment('Cities Show');
});
