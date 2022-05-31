<?php

namespace Rashidul\River\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataEntry extends Model
{
    use HasFactory;

    public $table = 'river_data_entries';

    protected $guarded = ['id'];

    //scopes
    public function scopeSlug($q, $slug)
    {
        return $q->where('data_type_slug', $slug);
    }

    public function values()
    {
        return $this->hasMany(FieldValue::class, 'data_entry_id');
    }
}
