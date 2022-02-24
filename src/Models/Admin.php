<?php

namespace Rashidul\River\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = [
        'key',
        'value'
    ];
//    public $timestamps = false;
}
