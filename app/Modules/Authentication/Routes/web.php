<?php

use App\Modules\Authentication\Controllers\LoginController;
use App\Modules\Authentication\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'authentication', 'as' => 'authentication.'], function () {
    Route::post('do_login', [LoginController::class, 'doLogin'])->name("aksi_login")->comment('Login Aksi');
    Route::get('/login', [LoginController::class, 'index'])->name('login_index')->comment('Login Index');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout')->comment('Logout');
});
