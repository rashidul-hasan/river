<?php

namespace Rashidul\River\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Blade;
use Rashidul\River\Models\RiverPage;

class PageController extends Controller
{
    public function pageShow($slug)
    {
        $page = RiverPage::where('slug', trim($slug))
            ->where('is_published', true)
            ->first();

        if ($page) {
            if ($page->content_type === RiverPage::CONTENT_TYPE_HTML) {
                return view('_cache.page', [
                    'content' => $page->content,
                    'title' => $page->title
                ]);
            }

            if ($page->content_type === RiverPage::CONTENT_TYPE_BLADE) {
                $renderedHtml = Blade::compileString($page->content);
                return view('_cache.page', [
                    'content' => $renderedHtml,
                    'title' => $page->title
                ]);
            }
        }

        abort(404);
    }

    public function catchAll($any)
    {

        $page = RiverPage::where('slug', trim($any))
            ->where('is_published', 1)
            ->first();

        if ($page) {
            if ($page->content_type === RiverPage::CONTENT_TYPE_HTML) {
                return view('_cache.page', [
                    'content' => $page->content,
                    'title' => $page->title
                ]);
            }
        }

        abort(404);
    }
}
