<?php

namespace Rashidul\River\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Rashidul\River\Services\SettingsService;

class SettingsController extends Controller
{

    protected $settings = [
        'name', 'phone', 'email', 'address', 'header_text', 'facebook', 'twitter', 'youtube', 'about',
        'footertext', 'feature_title_1', 'feature_subt_1', 'feature_title_2', 'feature_subt_2',
        'feature_title_3', 'feature_subt_3', 'feature_title_4', 'feature_subt_4',
        'free_ship_min_amount','inside_ship_amount','outside_ship_amount','map_code','cod_title','cod_desc',
        'bkash_title','bkash_desc','rocket_title','rocket_desc','nagad_title','nagad_desc','imo_whatsup','meta_title',
        'meta_description','meta_keywords','site_moto', 'theme_color', 'open_hour','notice'
    ];

    protected $settingsImages = [
        'header_logo',
        'footer_logo',
        'favicon',
        'pay_method_img',
        'meta_img',
        'feature_icon_1',
        'feature_icon_2',
        'feature_icon_3',
        'feature_icon_4',


    ];

    protected $settingsCheck = [
        'social_login',
    ];

    public function showSettings()
    {
        $data = [
            'settings' => SettingsService::getSettingsArray(),
        ];
        return view('admin.settings.settings',$data);
    }

    public function shippingMethod()
    {
        $data = [
            'settings' => SettingsService::getSettingsArray(),
        ];
        return view('admin.settings.shipping-method',$data);
    }


    public function updateSettings(Request $request)
    {
        foreach ($this->settings as $setting) {
            if ($request->has($setting)) {
                SettingsService::set($setting, $request->get($setting));
            }
        }

        foreach ($this->settingsCheck as $item) {
            if ($request->has($item)) {
                SettingsService::set($item, '1');
            } else {
                SettingsService::set($item, '0');
            }
        }

        foreach ($this->settingsImages as $settingsImage) {

            if ($request->hasFile($settingsImage)) {
                $image =  $request->file($settingsImage);
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $directory = public_path('uploads/settings/');
                $image->move($directory, $imageName);
                $imageUrl = '/uploads/settings/'.$imageName;

                SettingsService::set($settingsImage, $imageUrl);
            }
        }
        //reset cache
        Cache::forget(SettingsService::CACHE_KEY_SETTINGS);
//        Artisan::call('cms:cache-nav');

        return redirect()->back()->with('success', 'Settings Updated Successfully!');
    }
}
