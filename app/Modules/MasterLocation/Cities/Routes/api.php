<?php

use App\Modules\MasterLocation\Cities\Controllers\ApiCitiesController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "cities", 'as' => "cities."], function () {
    Route::get('/', [ApiCitiesController::class, 'get'])->name('get')->comment('Get Cities');
    Route::get('show/{id?}', [ApiCitiesController::class, 'show'])->name('show')->comment('Get City By ID');
});
