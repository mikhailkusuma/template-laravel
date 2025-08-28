<?php

use App\Modules\ManagementUser\Roles\Controllers\RolesController;
use App\Modules\ManagementUser\Roles\Controllers\RolesPermissionsController;
use App\Modules\ManagementUser\Roles\Middlewares\RolesMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::group(['prefix' => "roles", 'as' => "roles.", "middleware" => [
    RolesMiddleware::class
]], function () {
    Route::get(
        '/',
        [RolesController::class, 'index']
    )->name('index')->middleware('permission:management_user.roles.index')->comment('Roles Index');

    Route::get("/datatable", [RolesController::class, "datatableAjax"])->name("datatable")->middleware('permission:management_user.roles.index')->comment('Roles Datatable');

    Route::get('/{id}', [RolesController::class, 'show'])->name("show")->middleware('permission:management_user.roles.show')->comment('Roles Show');
    Route::post('/', [RolesController::class, 'store'])->name("store")->middleware('permission:management_user.roles.store')->comment('Roles Store');
    Route::put('/{id}', [RolesController::class, 'update'])->name("update")->middleware('permission:management_user.roles.update')->comment('Roles Update');
    Route::delete('/{id}', [RolesController::class, 'delete'])->name("delete")->middleware('permission:management_user.roles.delete')->comment('Roles Delete');

    Route::get('/set_permissions/{id}', [RolesPermissionsController::class, 'index'])->name('set_permissions')->middleware('permission:management_user.roles.set_permissions')->comment('Roles Set Permissions');
    Route::post('/set_permissions/{id}', [RolesPermissionsController::class, 'setPermission'])->name('set_permissions.store')->middleware('permission:management_user.roles.set_permissions.store')->comment('Roles Set Permissions Store');
});
