<?php

namespace App\Modules\MasterLocation\Cities\Models;

use App\Base\Traits\Blameable;
use App\Modules\MasterLocation\Districts\Models\Districts;
use App\Modules\MasterLocation\Villages\Models\Villages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
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

    public function districts(): HasMany
    {
        return $this->hasMany(Districts::class, 'kabupaten_id', 'id');
    }

    public function villages(): HasManyThrough
    {
        return $this->hasManyThrough(Villages::class, Districts::class, 'kabupaten_id', 'kecamatan_id', 'id', 'id');
    }
}
