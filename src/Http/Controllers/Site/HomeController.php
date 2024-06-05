<?php

namespace BitPixel\SpringCms\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use BitPixel\SpringCms\Constants;
use BitPixel\SpringCms\Models\Banner;
use BitPixel\SpringCms\Models\Slider;
use BitPixel\SpringCms\Models\ContactFormField;
use BitPixel\SpringCms\Models\DataEntry;

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

    public function single_entries_show($slug){


        $data = DataEntry::where('slug', $slug)->first();

        return view('_cache.single-data', compact('data'));
    }

}
