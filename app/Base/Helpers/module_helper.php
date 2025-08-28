<?php

if(!function_exists("lokasi_modul")){
    function lokasi_modul($namaModul){
        return app_path("Modules/" . $namaModul);
    }
}