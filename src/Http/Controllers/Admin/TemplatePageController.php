<?php

namespace Rashidul\River\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $data = [
            'title' => 'Template pages (location: resources/views/_cache)',
            'pages' => $files
        ];

        return view('river::admin.templates.pages', $data);
    }

    public function edit($id)
    {
        $file = TemplatePage::find($id);
        $data = [
            'title' => 'Edit: ' . $file->filename,
            'file' => $file
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

        return redirect()->back()->with('success', 'Updated');
    }

}
