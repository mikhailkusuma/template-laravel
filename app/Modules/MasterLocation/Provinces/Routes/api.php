<?php

use App\Modules\MasterLocation\Provinces\Controllers\ApiProvincesController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "provinces", 'as' => "provinces."], function () {
    Route::get('/', [ApiProvincesController::class, 'get'])->name('get')->comment('Get Provinces');
    Route::get('show/{id?}', [ApiProvincesController::class, 'show'])->name('show')->comment('Get Province By ID');
});
