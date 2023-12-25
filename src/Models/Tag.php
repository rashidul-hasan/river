<?php

namespace Rashidul\River\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $table = 'river_tag';

    protected $guarded = ['id',];


    public function blog(){
        return $this->belongsToMany(blog::class, 'river_blog_tag', 'blog_id', 'tag_id');
    }
}
