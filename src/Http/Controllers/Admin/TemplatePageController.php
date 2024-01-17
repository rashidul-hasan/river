<?php

namespace Rashidul\River\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Blade;
use Rashidul\River\Models\TemplatePage;
use Rashidul\River\Models\TemplatePageVersion;
use Carbon\Carbon;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class TemplatePageController extends Controller
{
    public function assets()
    {
/*//        $it = new RecursiveDirectoryIterator(public_path());
        $assets_dir = public_path('_site');
        if (!file_exists($assets_dir)) {
            mkdir($assets_dir, 0777, true);
        }
//        $mydir = public_path('_site');

        $myfiles = array_diff(scandir($assets_dir), array('.', '..'));

        dd($myfiles);*/

//        dd();
//        dd($it);
//        foreach(new RecursiveIteratorIterator($it) as $file) {
//            echo $file;

            /*if ($file->getExtension() == 'html') {
                echo $file;
            }*/
//        }
        $files = TemplatePage::all();
        $data = [
            'title' => 'Template pages',
            'pages' => $files
        ];

        return view('river::admin.templates.pages', $data);
    }

    public function index()
    {
        $files = TemplatePage::all();
        $version = TemplatePageVersion::all();

        $buttons = [
            ['Add', '', 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
            ['Cache View',route('river.CacheView'), 'btn btn-info', '' /*label,link,class,id*/],
        ];
        $data = [
            'title' => 'Template pages (location: resources/views/_cache)',
            'pages' => $files,
            '_top_buttons' => $buttons,
            'version' => $version
        ];

        return view('river::admin.templates.pages', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'filename' => 'required', //TODO no space, valid blade file name
        ]);

        $file = TemplatePage::create([
            'filename' => $request->get('filename')
        ]);

        return redirect(route('river.template-pages.edit', $file->id))
            ->with('success', 'Created new file!');
    }

    public function edit($id)
    {
        $pages = TemplatePage::all();
        $file = TemplatePage::find($id);
        $versions = TemplatePageVersion::where('filename',$file->filename)->get();


        $data = [
            'title' => 'Edit template: ' . $file->filename,
            'file' => $file,
            'pages' => $pages,
            'versions'=> $versions,
        ];

        return view('river::admin.templates.pages-edit', $data);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'code' => 'required',
            'filename' => 'required', //TODO no space, valid blade file name
        ]);

        $file = TemplatePage::find($id);


        $data = TemplatePageVersion::create([
            'filename' => $file->filename,
            'code' => $file->code
        ]);


        $file->filename = $request->get('filename');
        $file->code = $request->get('code');
        $file->update();
        $file->touch();

        //reset cache
        Artisan::call('river:cache-views');

        return redirect()->back()->with('success', 'Updated');
    }

    public function destroy($id)
    {
        $file = TemplatePage::find($id);
        $file->delete();

        //reset cache
        Artisan::call('river:cache-views');
        return redirect(route('river.template-pages.index'))
            ->with('success', 'Deleted!');
    }

    public function CacheView()
    {
        Artisan::call('river:cache-views');
        return redirect()->back()->with('success', 'Successfully');
    }

    public function preview(Request $request)
    {
        $content = $request->get('content');
//        $content = '<div class="mt-3 text-center">
//                                <button type="submit">Login</button>
//                                or <a href="{{route(\'riversite.register\')}}"> New Register </a>
//                            </div>';

        // Will write the file when needed and return the view filename
        $filename = $this->generateViewFile($content);

        // Fully render and output the content
        return view('_cache/'.$filename)->render();
    }

    private function generateViewFile($html)
    {
        // Get the Laravel Views path
        $path = config('view.paths.0');

        // Here we use the date for unique filename - This is the filename for the View
        $viewfilename = 'tmp-preview';

        // Full path with filename
        $fullfilename = $path."/_cache/".$viewfilename.".blade.php";
        file_put_contents($fullfilename, $html);

        // Write the string into a file
        /*if (!file_exists($fullfilename))
        {
            file_put_contents($fullfilename, $html);
        }*/

        // Return the view filename - This could be directly used in View::make
        return $viewfilename;
    }
}
