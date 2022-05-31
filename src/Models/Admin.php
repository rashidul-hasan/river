<?php

namespace Rashidul\River\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    public $table = 'river_admins';

    protected $fillable = [
        'key',
        'value'
    ];
//    public $timestamps = false;
}
