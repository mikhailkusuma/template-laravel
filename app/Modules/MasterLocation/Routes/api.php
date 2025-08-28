<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "api/master_location", 'as' => "api.master_location."], function () {
    include lokasi_modul("MasterLocation/Provinces/Routes/api.php");
    include lokasi_modul("MasterLocation/Cities/Routes/api.php");
    include lokasi_modul("MasterLocation/Districts/Routes/api.php");
    include lokasi_modul("MasterLocation/Villages/Routes/api.php");
});
