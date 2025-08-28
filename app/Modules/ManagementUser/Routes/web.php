<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "management_user", 'as' => "management_user."], function () {
    include lokasi_modul("ManagementUser/Users/Routes/web.php");
    include lokasi_modul("ManagementUser/Roles/Routes/web.php");
    include lokasi_modul("ManagementUser/Permissions/Routes/web.php");
});
