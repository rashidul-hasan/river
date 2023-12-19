<?php

namespace Rashidul\River\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Rashidul\River\Models\TemplatePage;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Rashidul\River\Models\TemplateAssets;

class TemplateAssetsController extends Controller
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
            'title' => 'Template  pages',
            'pages' => $files
        ];

        return view('river::admin.template_assets.pages', $data);
    }

    public function index()
    {
        $files = TemplateAssets::all();
        $buttons = [
            ['Add', '', 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
            ['Cache View',route('river.assets-cache-view'), 'btn btn-info', '' /*label,link,class,id*/],
        ];
        $data = [
            'title' => 'Template Assets pages (location: resources/views/_cache)',
            'pages' => $files,
            '_top_buttons' => $buttons
        ];

        return view('river::admin.template_assets.pages', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'filename' => 'required', //TODO no space, valid blade file name
        ]);

        $file = TemplateAssets::create([
            'filename' => $request->get('filename')
        ]);

        return redirect(route('river.template-assets.edit', $file->id))
            ->with('success', 'Created new file!');
    }

    public function edit($id)
    {
        $file = TemplateAssets::find($id);
        $data = [
            'title' => 'Edit: ' . $file->filename,
            'file' => $file
        ];

        return view('river::admin.template_assets.pages-edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required',
            'filename' => 'required', //TODO no space, valid blade file name
        ]);

        $file = TemplateAssets::find($id);
        $file->filename = $request->get('filename');
        $file->code = $request->get('code');
        $file->type = $request->get('type');
        $file->save();

        //reset cache
        Artisan::call('river:cache-views');

        return redirect()->back()->with('success', 'Updated');
    }

    public function destroy($id)
    {
        $file = TemplateAssets::find($id);
        $file->delete();

        //reset cache
        Artisan::call('river:cache-views');
        return redirect(route('river.template-assets.index'))
            ->with('success', 'Deleted!');
    }

    public function CacheView()
    {
        echo "CacheView function in TemplateAssetsController";
        // Artisan::call('river:cache-views');
        // return redirect()->back()->with('success', 'Successfully');
    }

}
