<?php

namespace App\Modules\ManagementUser\Permissions\Models;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'guard_name', 'updated_at'];
    public $timestamps = true;

    protected $hidden = ['created_by', 'updated_by', 'deleted_by', 'deleted_at'];
}
