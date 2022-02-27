<?php

namespace Rashidul\River\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataEntry extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function values()
    {
        return $this->hasMany(DataFields::class, 'data_type_id');
    }
}
