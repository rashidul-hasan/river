<?php

namespace Rashidul\River\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Rashidul\River\Models\Banner;
use Rashidul\River\Models\RiverPage;
use Rashidul\River\Models\Slider;
use Rashidul\River\Models\Service;

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
