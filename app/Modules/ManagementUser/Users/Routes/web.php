<?php

use App\Modules\ManagementUser\Users\Controllers\UsersController;
use App\Modules\ManagementUser\Users\Middlewares\UsersMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::group(['prefix' => "users", 'as' => "users.", "middleware" => [
    UsersMiddleware::class
]], function () {
    Route::get(
        '/',
        [UsersController::class, 'index']
    )->name('index'); //->middleware('permission:management_user.users.index')->comment('Users Index');

    Route::get("/datatable", [UsersController::class, "datatableAjax"])->name("datatable"); //->middleware('permission:management_user.users.index')->comment('Users Datatable');

    Route::get('/{id}', [UsersController::class, 'show'])->name('show'); //->middleware('permission:management_user.users.show')->comment('Users Show');
    Route::post('/', [UsersController::class, 'store'])->name('store'); //->middleware('permission:management_user.users.store')->comment('Users Store');
    Route::put('/{id}', [UsersController::class, 'update'])->name('update'); //->middleware('permission:management_user.users.update')->comment('Users Update');
    Route::delete('/{id}', [UsersController::class, 'delete'])->name('delete'); //->middleware('permission:management_user.users.delete')->comment('Users Delete');
});
