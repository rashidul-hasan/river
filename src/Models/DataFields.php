<?php

namespace Rashidul\River\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFields extends Model
{
    use HasFactory;

    public $table = 'river_data_fields';


    const TYPE_TEXT = 1;
    const TYPE_EMAIL = 2;
    const TYPE_PASSWORD = 3;
    const TYPE_IMAGE = 4;
    const TYPE_CHECKBOX = 5;

    protected $guarded = ['id'];

}
