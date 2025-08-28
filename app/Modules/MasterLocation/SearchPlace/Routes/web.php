<?php

use App\Modules\MasterLocation\SearchPlace\Controllers\SearchPlaceController;
use App\Modules\MasterLocation\SearchPlace\Middlewares\SearchPlaceMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "search_place", 'as' => "search_place.", "middleware" => [
    SearchPlaceMiddleware::class
]], function () {
    Route::get(
        '/',
        [SearchPlaceController::class, 'searchPlace']
    )->name('search')->comment('Search Place');
});
