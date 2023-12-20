<?php

namespace Rashidul\River\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Rashidul\River\Models\TemplatePage;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Rashidul\River\Models\TemplateAssets;
use Illuminate\Support\Facades\File;

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
        $js_file_name = [];
        $css_file_name = [];
        $image_file_name = [];

    $publicPath = public_path();
    $directory = 'river/assets';
    $targetDirectory = $publicPath . '/' . $directory;

    if(File::isDirectory($targetDirectory)) {
        // Get the list of files in the directory
        $files = File::files($targetDirectory); 
        

        foreach ($files as $file) {

            $filename=  $file->getFilename();
            $ex_name = pathinfo($filename, PATHINFO_EXTENSION);

            if($ex_name=='js'){
                $js_file_name[] = $filename ;
            } else if($ex_name=='css'){
                $css_file_name[] = $filename;
            } else if ($ex_name=='jpg'|| $ex_name=='png' ){
                $image_file_name[] = $filename;
            }

            // $ext = pathinfo($filename, PATHINFO_EXTENSION);
            // echo $ext;
        }

    }

        // $files = TemplateAssets::all();
        $buttons = [
            ['Add', route('river.template-assets.create'), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
            ['Cache View',route('river.assets-cache-view'), 'btn btn-info', '' /*label,link,class,id*/],
        ];
        $data = [
            'title' => 'Template Assets pages (location: resources/views/_cache)',
            'js_file_name' => $js_file_name,
            'css_file_name' => $css_file_name,
            'image_file_name' => $image_file_name,
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

    public function create()
    {
    
        $data = [
            'title' => 'Upload Files',
           
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
