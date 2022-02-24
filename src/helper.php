<?php

use Rashidul\River\Services\SettingsService;

if (! function_exists('river_settings')) {
    function river_settings($key, $default = '')
    {
        return SettingsService::get($key, $default);
    }
}
