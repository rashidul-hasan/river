<?php

namespace Rashidul\River\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public $table = 'river_blog';

    protected $guarded = ['id',];


    public function scopeSlug($q, $slug)
    {
        return $q->where('slug', $slug);
    }

    // public function menuitem(){
    //     return $this->HasMany(MenuItem::class, 'menu_id');
    // }
}
