<?php

namespace Rashidul\River\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterSubmissions extends Model
{
    use HasFactory;

    public $table = 'river_newsletter_submissions';

    protected $guarded = ['id',];


}