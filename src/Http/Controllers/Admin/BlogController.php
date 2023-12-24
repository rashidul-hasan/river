<?php

namespace Rashidul\River\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Rashidul\River\Constants;
use Rashidul\River\Models\Menu;
use Rashidul\River\Models\MenuItem;
use Illuminate\Support\Facades\Auth;


use Rashidul\River\Models\Blog;


class BlogController
{
    public function index()
    {

        $all = Blog::all();

        $buttons = [
            ['Add', route('river.blog.create'), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
            // ['Export', route('river.datatypes.export'), 'btn btn-primary', '' /*label,link,class,id*/],
            // ['Import', route('river.datatypes.import'), 'btn btn-primary', '' /*label,link,class,id*/],
            // ['Download File', route('river.download.page'), 'btn btn-warning', '' /*label,link,class,id*/],
        ];
        $data = [
            'title' => 'Blogs',
            'all' => $all,
            '_top_buttons' => $buttons
        ];

        return view('river::admin.blogs.index', $data);
    }

    public function create()
    {
        $buttons = [
            ['Back', route('river.blog.index'), 'btn btn-info', 'btn-add-new'],
        ];
        $data = [
            'title' => 'Blog Create',
            '_top_buttons' => $buttons,
        ];
        return view('river::admin.blogs.create', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            
        ]);

        $names = $request->get('title');
        $is_published = $request->get('is_published');
        $names = explode(",", $names);
        $file = null;
        foreach ($names as $name) {
            $file = Blog::create([
                'title' => $name,
                'content' => $request->content,
                'category_id' => $request->category_id,

                'author_id' => Auth::guard(Constants::AUTH_GUARD_ADMINS)->user()->id,

                'is_published' =>$is_published
            ]);
        }

        return redirect(route('river.blog.index',[$file->id] ))
            ->with('success', 'Created!');
    }

    public function edit($id)
    {
        
        $file = Blog::find($id); 

        $data = [
            'title' => 'Edit Blog: ' . $file->name,
            'type' => $file,
        ];

        return view('river::admin.blogs.edit', $data);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required',
        ]);

        $file = Blog::find($id);
        $file->title = $request->get('title');
        $file->content = $request->get('content');
        $file->category_id = $request->get('category_id');
        $file->author_id = Auth::guard(Constants::AUTH_GUARD_ADMINS)->user()->id;
        $file->is_published = $request->get('is_published');
        $file->save();

        return redirect()->back()->with('success', 'Updated');
    
    }

    public function destroy($id)
    {
        $file = Blog::find($id);
        $file->delete();

        return redirect(route('river.blog.index'))
            ->with('success', 'Deleted!');
    } 
    
}
