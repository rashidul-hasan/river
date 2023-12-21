<?php

namespace Rashidul\River\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Rashidul\River\Models\TemplatePage;
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
        $buttons = [
            ['Add', '', 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
            ['Cache View',route('river.CacheView'), 'btn btn-info', '' /*label,link,class,id*/],
        ];
        $data = [
            'title' => 'Template pages (location: resources/views/_cache)',
            'pages' => $files,
            '_top_buttons' => $buttons
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
        $data = [
            'title' => 'Edit template: ' . $file->filename,
            'file' => $file,
            'pages' => $pages
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
        $file->filename = $request->get('filename');
        $file->code = $request->get('code');
        $file->save();

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

}
