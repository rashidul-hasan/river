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
        $service = Service::where('slug', $slug)->get();
        return view('_cache.single-service', compact('service'));
    }

    // public function single_blog($slug)
    // {
    //     $single_blog = Blog::where('slug', $slug)->get();

    //     return view('_cache.single-blog', compact('single_blog'));
    // }



    // public function pageShow()
    // {
    //     $pages = RiverPage::where('is_published', 1)->first();
    //     $data = [
    //         'title' => 'Page',
    //         'pages' => $pages,
    //     ];

    //     return view('_cache.page', $data);
    // }

    // public function catchAll($any)
    // {

    //     $page = RiverPage::where('slug', trim($any))
    //         ->where('is_published', 1)
    //         ->first();

    //     if ($page) {
    //         if ($page->content_type === RiverPage::CONTENT_TYPE_HTML) {
    //             return view('_cache.page', [
    //                 'content' => $page->content,
    //                 'title' => $page->title
    //             ]);
    //         }
    //     }

    //     abort(404);
    // }




    public function blogs()
    {
        // return view('_cache.all-blogs');
    }
}
