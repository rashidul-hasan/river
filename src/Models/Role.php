<?php

namespace BitPixel\SpringCms\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $table = 'river_roles';

    protected $guarded = ['id'];

    public function permissions()
    {
        return $this->hasMany(RolePermission::class, 'role_id');
    }
}
