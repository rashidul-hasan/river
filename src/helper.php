<?php

use Rashidul\River\Services\SettingsService;

if (! function_exists('river_settings')) {
    function river_settings($key, $default = '')
    {
        //TODO use cache
        return SettingsService::get($key, $default);
    }
}
