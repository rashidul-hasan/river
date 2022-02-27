<?php

namespace Rashidul\River\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplatePage extends Model
{
    use HasFactory;

    const TYPE_LAYOUT = 1;
    const TYPE_SIMPLE = 2;

    public function scopeType($q, $type)
    {
        return $q->where('type', $type);
    }
}
