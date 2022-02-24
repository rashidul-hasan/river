<?php
namespace Rashidul\River\Services;

use Illuminate\Support\Facades\Cache;
use Rashidul\River\Models\Settings;

class SettingsService
{
    const CACHE_KEY_SETTINGS = 'key_settings';

    const SETTINGS_KEY_LOGO = 'header_logo';
    const SETTINGS_KEY_FAVICON = 'favicon';
    const SETTINGS_THEME_COLOR = 'theme_color';
    const SETTINGS_SITE_NAME = 'name';
    const SETTINGS_FAVICON = 'favicon';

    public static function get($key, $default = '') {
        $all = Cache::rememberForever(self::CACHE_KEY_SETTINGS, function () {
            return Settings::all();
        });

        $setting = $all->where('key', $key)->first();
        if ($setting) return $setting->value;

        return $default;
    }

    public static function set($key, $value) {
        if (!$value) return;

        $setting = Settings::where('key', $key)->first();
        if ($setting === null){
            $setting = new Settings();
            $setting->key = $key;
        }
        $setting->value = $value;
        $setting->save();

    }

    // get all settings as [key => value]
    public static function getSettingsArray()
    {
        $data = Settings::all()->pluck('value', 'key');
        return $data->toArray();
    }
}
