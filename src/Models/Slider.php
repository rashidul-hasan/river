<?php

namespace BitPixel\SpringCms\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    public $table = 'river_sliders';

    const BASE_PATH = '/uploads/sliders/';
    protected $fillable = ['image','status','open_new_tab','orders'];
}
