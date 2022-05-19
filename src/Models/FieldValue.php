<?php

namespace Rashidul\River\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldValue extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeId($q, $dataEntryId)
    {
        return $q->where('data_entry_id', $dataEntryId);
    }

}
