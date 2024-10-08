<?php

namespace BitPixel\SpringCms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ServiceCategory extends Model
{
    use HasFactory;

    public $table = 'river_service_category';

    protected $guarded = ['id',];



    public function service(){
        return $this->hasMany(Service::class, 'category_id');
    }
    // public function scopeSlug($q, $slug)
    // {
    //     return $q->where('slug', $slug);
    // }

    // public function menuitem(){
    //     return $this->HasMany(MenuItem::class, 'menu_id');
    // }


}
