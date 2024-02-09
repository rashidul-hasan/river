<?php

namespace Rashidul\River\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Rashidul\River\Models\Banner;
use Rashidul\River\Models\RiverPage;
use Rashidul\River\Models\Slider;
use Rashidul\River\Models\Blog;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::all();
        return view('_cache.all-blogs', compact('blogs'));
    }

    public function single_blog($slug)
    {
        $single_blog = Blog::where('slug', $slug)->first();

        $meta_keywords = $single_blog->meta_keywords;
        $meta_desc = $single_blog->meta_desc;

        return view('_cache.single-blog', compact('single_blog', 'meta_desc', 'meta_keywords'));
    }




    public function blogs()
    {
        // return view('_cache.all-blogs');
    }
}
