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
    const FIELD_TYPE_SELECT = 'select';
    const FIELD_TYPE_NUMBER = 'number';
    const FIELD_TYPE_DATETIME = 'datetime';
    const FIELD_TYPE_RICHTEXT = 'richtext';
    const FIELD_TYPE_FOREIGNKEY = 'foreign_key';
    const FIELD_TYPE_BELONGSTO = 'belongsto'; //will hold another type's primary key as foreign key
    const FIELD_TYPE_HASMANY = 'hasmany'; // pseudo column, will pull the related types by using belongsto


    //cache key
    const CACHE_KEY_FAQ = 'cache_key_faq';
    const CACHE_KEY_SLIDER = 'cache_key_slider';
    const CACHE_KEY_SERVICE = 'cache_key_service';
    const CACHE_KEY_BLOG = 'cache_key_blog';
    const CACHE_KEY_TESTIMONIAL = 'cache_key_testimonials';
    const CACHE_KEY_BANNER = 'cache_key_banner';
    const CACHE_KEY_MENU = 'cache_key_menu';


}
