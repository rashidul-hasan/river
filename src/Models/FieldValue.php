<?php

namespace BitPixel\SpringCms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldValue extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'river_field_values';

    protected $guarded = ['id'];

    public function scopeId($q, $dataEntryId)
    {
        return $q->where('data_entry_id', $dataEntryId);
    }

}
