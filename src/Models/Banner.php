<?php

namespace Rashidul\River\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public $table = 'river_banners';

    const BASE_PATH = '/uploads/banners/';
    protected $fillable = ['image','alt_text','slug'];
}
