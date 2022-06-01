<?php

namespace Rashidul\River;

class Constants
{

    const AUTH_GUARD_ADMINS = 'admins';
    const AUTH_GUARD_CUSTOMERS = 'customers';


    const CACHE_KEY_DATATYPES = '_river_datatypes';


    //field types
    const FIELD_TYPE_TEXT = 'text';
    const FIELD_TYPE_TEXTAREA = 'textarea';
    const FIELD_TYPE_EMAIL = 'email';
    const FIELD_TYPE_PHONE = 'phone';
    const FIELD_TYPE_PASSWORD = 'password';
    const FIELD_TYPE_IMAGE = 'image';
    const FIELD_TYPE_CHECKBOX = 'checkbox';
    const FIELD_TYPE_RADIO = 'radio';
    const FIELD_TYPE_DROPDOWN = 'dropdown';
    const FIELD_TYPE_DATE = 'date';
    const FIELD_TYPE_DATETIME = 'datetime';
    const FIELD_TYPE_RICHTEXT = 'richtext';
    const FIELD_TYPE_FOREIGNKEY = 'foreign_key';
}
