<?php

use App\Modules\MasterLocation\Districts\Controllers\ApiDistrictsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "districts", 'as' => "districts."], function () {
    Route::get('/', [ApiDistrictsController::class, 'get'])->name('get')->comment('Get Districts');
    Route::get('show/{id?}', [ApiDistrictsController::class, 'show'])->name('show')->comment('Get District By ID');
});
