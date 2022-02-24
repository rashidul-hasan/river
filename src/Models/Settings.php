<?php

namespace Rashidul\River\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'key',
        'value'
    ];
    public $timestamps = false;
}
