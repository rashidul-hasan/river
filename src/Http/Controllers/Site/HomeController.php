<?php

namespace Rashidul\River\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Rashidul\River\Models\Banner;
use Rashidul\River\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 1)->get();
        $banners = Banner::all('slug')->toArray();
        $data = [
          'title' => 'Homepage',
          'sliders' => $sliders,
          'banners' => $banners,
        ];

        return view('_cache.home', $data);
    }
}
