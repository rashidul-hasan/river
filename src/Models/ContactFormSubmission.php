<?php

namespace BitPixel\SpringCms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactFormSubmission extends Model
{
    use HasFactory;

    public $table = 'river_contactform_submissions';

    // const NAME_RELATED_TYPE = 'related_type';
    // const NAME_RELATED_TYPE_LABEL_COLUMN = 'related_type_label_column';

    protected $guarded = ['id'];

    public function contactform()
    {
        return $this->belongsTo(ContactForm::class, 'contactform_id');
    }
}
