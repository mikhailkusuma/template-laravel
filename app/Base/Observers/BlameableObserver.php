<?php

namespace App\Base\Observers;

use Illuminate\Support\Facades\Auth;

class BlameableObserver
{
    private $current_guard;

    public function __construct()
    {
        $this->current_guard = Auth::getDefaultDriver();
    }


    public function creating(\Illuminate\Database\Eloquent\Model $model)
    {
        $model->created_by = Auth::guard($this->current_guard)->user()->id ?? NULL;
        $model->updated_by = Auth::guard($this->current_guard)->user()->id ?? NULL;
    }

    public function updating(\Illuminate\Database\Eloquent\Model $model)
    {
        $model->updated_by =  Auth::guard($this->current_guard)->user()->id ?? NULL;
    }

    public function deleting(\Illuminate\Database\Eloquent\Model $model)
    {
        $model->deleted_by =  Auth::guard($this->current_guard)->user()->id ?? NULL;
    }
}
