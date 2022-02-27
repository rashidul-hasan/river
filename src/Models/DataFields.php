<?php

namespace Rashidul\River\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFields extends Model
{
    use HasFactory;

    const TYPE_TEXT = 1;
    protected $guarded = ['id'];

}
