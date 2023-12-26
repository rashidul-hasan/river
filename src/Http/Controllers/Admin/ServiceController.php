<?php

namespace Rashidul\River\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Rashidul\River\Constants;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;


use Rashidul\River\Models\Blog;
use Rashidul\River\Models\BlogCategory;
use Rashidul\River\Models\Tag;

use Rashidul\River\Models\Service;
use Rashidul\River\Models\ServiceCategory;



class ServiceController
{
    public function index()
    {
       
        $all = Service::all();



        $buttons = [
            ['Add', route('river.service.create'), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
            // ['Export', route('river.datatypes.export'), 'btn btn-primary', '' /*label,link,class,id*/],
            // ['Import', route('river.datatypes.import'), 'btn btn-primary', '' /*label,link,class,id*/],
            // ['Download File', route('river.download.page'), 'btn btn-warning', '' /*label,link,class,id*/],
        ];
        $data = [
            'title' => 'Services',
            'all' => $all,
            '_top_buttons' => $buttons
        ];

        return view('river::admin.service.index', $data);
    }

    public function create()
    {
        $all_cat = ServiceCategory::all();
       // $tags = Tag::all();
        $buttons = [
            ['Back', route('river.service.index'), 'btn btn-info', 'btn-add-new'],
        ];
        $data = [
            'title' => 'Service Create',
            '_top_buttons' => $buttons,
            'all_cat' => $all_cat,
           // 'tags' => $tags,
        ];
        return view('river::admin.service.create', $data);
    }

    public function store(Request $request)
    {
     
        // $icon = $request->file('icon');
        // $icon_name = date('Ymdhis.').$icon->getClientOriginalExtension();

        // $image = $request->file('image');
        // $image_name = date('Ymdhis.').$image->getClientOriginalExtension();

        // $publicPath = public_path();
        // $directory = 'river/assets';
        // $targetDirectory = $publicPath . '/' . $directory;

        // $image->move($targetDirectory,$image_name);
        // $icon->move($targetDirectory,$icon_name);

        
        $request->validate([
            'title' => 'required',
            
        ]);

        $names = $request->get('title');
        $is_published = $request->get('is_published');
       
        $blog = Service::create([
            'title' => $names,
            'slug' => $request->slug,
            'meta_desc' => $request->meta_desc,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'sort_order' => $request->sort_order,
            'author_id' => Auth::guard(Constants::AUTH_GUARD_ADMINS)->user()->id,
            'icon' => '$icon_name',
            'image' => '$image_name',
            'is_published' =>$is_published
        ]);

       // $blog->tag()->sync($request->tags);
        
        

        return redirect(route('river.service.index',[$blog->id] ))
            ->with('success', 'Created!');
    }

    public function edit($id)
    {
        
        $file = Service::find($id); 

        $all_cat = ServiceCategory::all();

        $data = [
            'title' => 'Edit Service: ' . $file->name,
            'type' => $file,
            'all_cat' => $all_cat
        ];

        return view('river::admin.service.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // $icon = $request->file('icon');
        // $icon_name = date('Ymdhis.').$icon->getClientOriginalExtension();

        // $image = $request->file('image');
        // $image_name = date('Ymdhis.').$image->getClientOriginalExtension();

        // $publicPath = public_path();
        // $directory = 'river/assets';
        // $targetDirectory = $publicPath . '/' . $directory;

        // $image->move($targetDirectory,$image_name);
        // $icon->move($targetDirectory,$icon_name);

        $request->validate([
            'title' => 'required',
        ]);

        $file = Service::find($id);
        $file->title = $request->get('title');
        $file->slug = $request->slug;
        $file->content = $request->get('content');
        $file->meta_desc = $request->meta_desc;
        $file->category_id = $request->get('category_id');
        $file->sort_order = $request->sort_order;
        $file->author_id = Auth::guard(Constants::AUTH_GUARD_ADMINS)->user()->id;
        $file->icon = '$icon_name';
        $file->image = '$image_name';
        $file->is_published = $request->get('is_published');
        $file->save();

        return redirect()->back()->with('success', 'Updated');
    
    }

    public function destroy($id)
    {
        $file = Service::find($id);
        $file->delete();

        $publicPath = public_path();
        $directory = 'river/assets';
        $targetDirectory_image = $publicPath . '/' . $directory . '/'.$file->image ;
        $targetDirectory_icon = $publicPath . '/' . $directory . '/'.$file->icon;

        if(File::exists( $targetDirectory_image)) {
            unlink( $targetDirectory_image);
        }

        if(File::exists( $targetDirectory_icon)) {
            unlink( $targetDirectory_icon);
        }

        return redirect(route('river.service.index'))
            ->with('success', 'Deleted!');
    } 
    
}
