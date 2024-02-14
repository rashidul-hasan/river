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
            $meta_desc = $page->meta_description;
            $content = $page->content;
            if ($page->content_type === RiverPage::CONTENT_TYPE_BLADE) {
                $renderedHtml = Blade::compileString($page->content);
                // Create a function with the Blade template and data
                $renderTemplate = function ($template, $data) {
                    extract($data);
                    eval(' ?>' . $template . '<?php ');
                };
                ob_start();
                $renderTemplate($renderedHtml, []);
                $content = ob_get_clean();
            }

            return view('_cache.page', [
                'content' => $content,
                'title' => $page->title,
                'meta_desc' => $meta_desc,
                'header_code' => $page->header_code,
                'footer_code' => $page->footer_code,
                'header_image' => $page->header_image
            ]);
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
