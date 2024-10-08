<?php

namespace BitPixel\SpringCms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFieldMeta extends Model
{
    use HasFactory;

    public $table = 'river_data_field_metas';

    const NAME_RELATED_TYPE = 'related_type';
    const NAME_RELATED_TYPE_LABEL_COLUMN = 'related_type_label_column';

    protected $guarded = ['id'];

}
