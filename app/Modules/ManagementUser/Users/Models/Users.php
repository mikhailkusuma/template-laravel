<?php

namespace App\Modules\ManagementUser\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Users extends Model
{
    use SoftDeletes, HasRoles;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'password', 'email_verified_at', 'updated_at'];
    public $timestamps = true;

    protected $hidden = ['password', 'created_by', 'updated_by', 'deleted_by', 'deleted_at'];

    // Pastikan guard_name di-set
    protected $guard_name = 'web';

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id');
    }
}
