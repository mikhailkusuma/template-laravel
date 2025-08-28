<?php

namespace App\Modules\MasterLocation\Districts\Models;

use App\Base\Traits\Blameable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Districts extends Model
{
    use SoftDeletes, Blameable;

    protected $table = 'kecamatan';
    protected $primaryKey = 'id';
    protected $fillable = ['kabupaten_id', 'nama', 'coordinate', 'geojson', 'updated_at'];
    public $timestamps = true;

    protected $hidden = ['created_by', 'updated_by', 'deleted_by', 'deleted_at'];

    public function cities(): HasOne
    {
        return $this->hasOne(Cities::class, 'id', 'kabupaten_id');
    }
}
