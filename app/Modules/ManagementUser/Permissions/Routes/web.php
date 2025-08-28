<?php

use App\Modules\ManagementUser\Permissions\Controllers\PermissionsController;
use App\Modules\ManagementUser\Permissions\Middlewares\PermissionsMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::group(['prefix' => "permissions", 'as' => "permissions.", "middleware" => [
    PermissionsMiddleware::class
]], function () {
    Route::get(
        '/',
        [PermissionsController::class, 'index']
    )->name('index')->middleware('permission:management_user.permissions.index')->comment('Permissions Index');

    Route::get("/datatable", [PermissionsController::class, "datatableAjax"])->name("datatable")->middleware('permission:management_user.permissions.datatable')->comment('Permissions Datatable');

    Route::get('/{id}', [PermissionsController::class, 'show'])->name("show")->middleware('permission:management_user.permissions.show')->comment('Permissions Show');
    Route::post('/', [PermissionsController::class, 'store'])->name("store")->middleware('permission:management_user.permissions.store')->comment('Permissions Store');
    Route::put('/{id}', [PermissionsController::class, 'update'])->name("update")->middleware('permission:management_user.permissions.update')->comment('Permissions Update');
    Route::delete('/{id}', [PermissionsController::class, 'delete'])->name("delete")->middleware('permission:management_user.permissions.delete')->comment('Permissions Delete');

    Route::post('/generate-permissions', [PermissionsController::class, 'generatePermissions'])->name('generate-permissions')->middleware('permission:management_user.permissions.generate-permissions')->comment('Generate Permissions');
});
