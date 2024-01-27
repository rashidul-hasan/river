<?php

namespace Rashidul\River\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Rashidul\River\Constants;
use Rashidul\River\Models\Banner;
use Rashidul\River\Models\Slider;
use Rashidul\River\Models\ContactFormField;

class HomeController extends Controller
{
    public function index()
    {
      $form_filed = ContactFormField::get();

      $banners = Cache::rememberForever(Constants::CACHE_KEY_BANNER, function () {
        return  Banner::all('slug')->toArray(); 
   });

   $sliders = Cache::rememberForever(Constants::CACHE_KEY_SLIDER, function () {
    return  Slider::where('status', 1)->get();
});
        // $sliders = Slider::where('status', 1)->get();
        // $banners = Banner::all('slug')->toArray();

        $data = [
          'title' => 'Homepage',
          'sliders' => $sliders,
          'banners' => $banners,
          'form_filed' => $form_filed,

        ];

        return view('_cache.home', $data);
    }
}
