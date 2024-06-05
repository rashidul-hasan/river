<?php

namespace BitPixel\SpringCms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    use HasFactory;

    public $table = 'river_contact_form';

    protected $guarded = ['id',];


    public function scopeSlug($q, $slug)
    {
        return $q->where('slug', $slug);
    }

    public function contactformfield(){
        return $this->HasMany(ContactFormField::class, 'contactform_id');
    }
}
