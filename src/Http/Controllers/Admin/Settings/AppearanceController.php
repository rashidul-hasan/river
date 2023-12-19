<?php

namespace Rashidul\River\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rashidul\River\Services\SettingsService;

class AppearanceController extends Controller
{
    public function storeFront()
    {
        $data = [
            'settings' => SettingsService::getSettingsArray(),
        ];
        return view('river::admin.settings.storefront', $data);
    }

    public function storeSocialLinks(){
        $data = [
            'settings' => SettingsService::getSettingsArray(),
        ];
        return view('river::admin.settings.store-social-links', $data);
    }

}
