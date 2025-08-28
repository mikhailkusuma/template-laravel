<?php

use App\Modules\MasterLocation\Villages\Controllers\VillagesController;
use App\Modules\MasterLocation\Villages\Middlewares\VillagesMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::group(['prefix' => "villages", 'as' => "villages.", "middleware" => [
    VillagesMiddleware::class
]], function () {
    Route::get(
        '/',
        [VillagesController::class, 'index']
    )->name('index')->middleware('permission:master_location.villages.index')->comment('Villages Index');

    Route::get("/datatable", [VillagesController::class, "datatableAjax"])->name("datatable")->middleware('permission:master_location.villages.datatable')->comment('Villages Datatable');

    Route::get('/{id}', [VillagesController::class, 'show'])->name('show')->middleware('permission:master_location.villages.show')->comment('Villages Show');
});
