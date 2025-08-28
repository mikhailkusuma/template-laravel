<?php

namespace App\Modules\MasterLocation\Districts\Models;

use App\Base\Traits\Blameable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provinces extends Model
{
    use SoftDeletes, Blameable;

    protected $table = 'provinsi';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'coordinate', 'geojson', 'updated_at'];
    public $timestamps = true;

    protected $hidden = ['created_by', 'updated_by', 'deleted_by', 'deleted_at'];
}
