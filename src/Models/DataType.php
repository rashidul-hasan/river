<?php

namespace BitPixel\SpringCms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataType extends Model
{
    use HasFactory;

    public $table = 'river_data_types';

    protected $guarded = ['id'];

    public function fields()
    {
        return $this->hasMany(DataFields::class, 'data_type_id');
    }

    public function scopeSlug($q, $slug)
    {
        return $q->where('slug', $slug);
    }
}
