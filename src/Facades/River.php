<?php

namespace BitPixel\SpringCms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Rashidul\River\River
 */
class River extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'river';
    }
}
