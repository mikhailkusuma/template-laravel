<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "master_location", 'as' => "master_location."], function () {
    include lokasi_modul("MasterLocation/Provinces/Routes/web.php");
    include lokasi_modul("MasterLocation/Cities/Routes/web.php");
    include lokasi_modul("MasterLocation/Districts/Routes/web.php");
    include lokasi_modul("MasterLocation/Villages/Routes/web.php");
    include lokasi_modul("MasterLocation/SearchPlace/Routes/web.php");
});
