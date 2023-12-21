<?php

namespace Rashidul\River\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  MenuItem extends Model
{
    use HasFactory;

    public $table = 'river_menu_item';

    // const NAME_RELATED_TYPE = 'related_type';
    // const NAME_RELATED_TYPE_LABEL_COLUMN = 'related_type_label_column';

    protected $guarded = ['id'];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
