<?php

namespace BitPixel\SpringCms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFields extends Model
{
    use HasFactory;

    public $table = 'river_data_fields';

    protected $guarded = ['id'];

    public function metas()
    {
        return $this->hasMany(DataFieldMeta::class, 'data_field_id');
    }
}
