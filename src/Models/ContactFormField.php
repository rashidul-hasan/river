<?php

namespace Rashidul\River\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactFormField extends Model
{
    use HasFactory;

    public $table = 'river_contact_form_field';

    // const NAME_RELATED_TYPE = 'related_type';
    // const NAME_RELATED_TYPE_LABEL_COLUMN = 'related_type_label_column';

    protected $guarded = ['id'];

    public function contactform()
    {
        return $this->belongsTo(ContactForm::class, 'contactformfield_id');
    }
}
