<?php

namespace Rashidul\River\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiverPage extends Model
{
    use HasFactory;

    public $table = 'river_pages';

    protected $guarded = ['id'];
}
