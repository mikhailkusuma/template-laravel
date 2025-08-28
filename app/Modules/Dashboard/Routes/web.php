<?php

use App\Modules\Dashboard\Controllers\DashboardController;
use App\Modules\Dashboard\Middlewares\DashboardMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "dashboard", 'as' => "dashboard.", "middleware" => [DashboardMiddleware::class]], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index')->middleware('permission:dashboard.index')->comment('Dashboard Index');
});
