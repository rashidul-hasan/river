<?php

namespace Rashidul\River\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiverPage extends Model
{
    use HasFactory;

    public $table = 'river_pages';

    const CONTENT_TYPE_HTML = 1;
    const CONTENT_BLADE = 2;
    const CONTENT_BLADE_FULL = 3;

    protected $guarded = ['id'];
}
