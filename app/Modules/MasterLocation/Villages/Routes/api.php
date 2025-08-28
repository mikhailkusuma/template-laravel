<?php

use App\Modules\MasterLocation\Villages\Controllers\ApiVillagesController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "villages", 'as' => "villages."], function () {
    Route::get('/', [ApiVillagesController::class, 'get'])->name('get')->comment('Get Villages');
    Route::get('show/{id?}', [ApiVillagesController::class, 'show'])->name('show')->comment('Get Village By ID');
});
