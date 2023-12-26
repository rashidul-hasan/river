<?php

namespace Rashidul\River\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public $table = 'river_service';

    protected $guarded = ['id',];


    public function scopeSlug($q, $slug)
    {
        return $q->where('slug', $slug);
    }

    // public function menuitem(){
    //     return $this->HasMany(MenuItem::class, 'menu_id');
    // }

    public function tag(){
        return $this->belongsToMany(Tag::class, 'river_blog_tag', 'blog_id', 'tag_id');
    }
}
