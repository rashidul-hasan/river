<?php

namespace Rashidul\River\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Rashidul\River\Models\Banner;
use Rashidul\River\Models\RiverPage;
use Rashidul\River\Models\Slider;

class PageController extends Controller
{
    public function pageShow ()
    {
        $pages = RiverPage::where('is_published', 1)->first();
        $data = [
          'title' => 'Page',
          'pages' => $pages,
        ];

        return view('_cache.page', $data);
    }

}
