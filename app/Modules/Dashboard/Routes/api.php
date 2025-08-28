<?php

use App\Modules\Dashboard\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
Route::group(['prefix' => "dashboard/api", 'as' => "dashboard.api."], function(){
    Route::get("locations", [DashboardController::class, "getPinpointLocations"])
        ->name("locations");
});