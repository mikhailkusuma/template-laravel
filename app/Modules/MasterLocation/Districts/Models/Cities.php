<?php

namespace App\Modules\MasterLocation\Districts\Models;

use App\Base\Traits\Blameable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cities extends Model
{
    use SoftDeletes, Blameable;

    protected $table = 'kabupaten';
    protected $primaryKey = 'id';
    protected $fillable = ['provinsi_id', 'nama', 'coordinate', 'geojson', 'updated_at'];
    public $timestamps = true;

    protected $hidden = ['created_by', 'updated_by', 'deleted_by', 'deleted_at'];

    public function provinces(): HasOne
    {
        return $this->hasOne(Provinces::class, 'id', 'provinsi_id');
    }
}
