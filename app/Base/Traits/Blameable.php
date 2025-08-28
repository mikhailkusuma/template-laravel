<?php

namespace App\Base\Traits;

use App\Base\Observers\BlameableObserver;

trait Blameable
{
    public static function bootBlameable()
    {
        static::observe(BlameableObserver::class);
    }
}
