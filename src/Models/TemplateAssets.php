<?php

namespace BitPixel\SpringCms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateAssets extends Model
{
    use HasFactory;

    public $table = 'river_template_assets';

    protected $guarded = ['id'];

    const TYPE_LAYOUT = 1;
    const TYPE_SIMPLE = 2;

    public function scopeType($q, $type)
    {
        return $q->where('type', $type);
    }
}
