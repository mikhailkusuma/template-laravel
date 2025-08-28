<?php

namespace App\Base\Helpers;

use Closure;
use Illuminate\Routing\Route;

class RouteCommandDescriptor
{
    public static function register()
    {
        if (!Route::hasMacro('comment')) {
            Route::macro('comment', function ($params = null) {
                $this->_comment = $params;
            });
        }
        if (!Route::hasMacro('getComment')) {
            Route::macro('getComment', function () {
                if (!property_exists($this, '_comment'))
                    return null;
                return $this->_comment;
            });
        }
    }
}
