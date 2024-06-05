<?php

namespace BitPixel\SpringCms\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use BitPixel\SpringCms\Models\Banner;
use BitPixel\SpringCms\Models\RiverPage;
use BitPixel\SpringCms\Models\Slider;
use BitPixel\SpringCms\Models\Service;

class ServiceController extends Controller
{

    public function service($slug)
    {
        $service = Service::where('slug', trim($slug))->first();
        if ($service === null) {
            abort(404);
        }

        return view('_cache.single-service', compact('service'));
    }


}
