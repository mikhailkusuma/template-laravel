<?php

use Illuminate\Support\Facades\Auth;

if(!function_exists("current_logged_guard_name")){
    function current_logged_guard_name(){
        foreach(array_keys(config("auth.guards")) as $guard) {
            if (Auth::guard($guard)->check()) return $guard;
        }

        return null;
    }
}