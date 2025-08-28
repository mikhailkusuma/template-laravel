<?php

namespace App\Modules\MasterLocation\Villages\Models;

use App\Base\Traits\Blameable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Villages extends Model
{
    use SoftDeletes, Blameable;

    protected $table = 'desa';
    protected $primaryKey = 'id';
    protected $fillable = ['kecamatan_id', 'nama', 'coordinate', 'geojson', 'updated_at'];
    public $timestamps = true;

    protected $hidden = ['created_by', 'updated_by', 'deleted_by', 'deleted_at'];

    public function districts(): HasOne
    {
        return $this->hasOne(Districts::class, 'id', 'kecamatan_id');
    }
}
