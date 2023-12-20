<?php

namespace Rashidul\River\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    public $table = 'river_faq';

    protected $guarded = ['id',];


   

}
