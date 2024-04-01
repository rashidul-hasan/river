<?php

namespace Rashidul\River\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Rashidul\River\Constants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


use Rashidul\River\Models\Blog;
use Rashidul\River\Models\BlogCategory;
use Rashidul\River\Models\Tag;



class BlogController
{
    public function index()
    {


        $all = Blog::all();

        $alls = Blog::with('tag')->get();


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
        $all_cat = BlogCategory::all();
        $tags = Tag::all();
        $buttons = [
            ['Back', route('river.blog.index'), 'btn btn-info', 'btn-add-new'],
        ];
        $data = [
            'title' => 'Blog Create',
            '_top_buttons' => $buttons,
            'all_cat' => $all_cat,
            'tags' => $tags,
        ];
        return view('river::admin.blogs.create', $data);
    }

    public function store(Request $request)
    {


        // $image = $request->file('image');
        // $image_name = date('Ymdhis.').$image->getClientOriginalExtension();

        // $publicPath = public_path();
        // $directory = 'river/assets';
        // $targetDirectory = $publicPath . '/' . $directory;

        // $image->move($targetDirectory,$image_name);


        $request->validate([
            'title' => 'required',
            'content' => 'required'

        ]);

        if ($request->has('is_published')) {
            $is_published = 1;
        } else {
            $is_published = 0;
        }

        $names = $request->get('title');


        $blog = Blog::create([
            'title' => $names,
            'content' => $request->content,
            'slug' => $request->slug,
            'short_desc' => $request->short_desc,
            'image' => $request->image,
            'category_id' => $request->category_id,
            'author_id' => Auth::guard(Constants::AUTH_GUARD_ADMINS)->user()->id,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'meta_image' => $request->meta_image,
            'is_published' => $is_published
        ]);
        Cache::forget(Constants::CACHE_KEY_BLOG);
        $blog->tag()->sync($request->tags);



        return redirect(route('river.blog.index'))
            ->with('success', 'Created!');
    }

    public function edit($id)
    {

        $file = Blog::find($id);

        $all_cat = BlogCategory::all();


        $data = [
            'title' => 'Edit Blog: ' . $file->name,
            'type' => $file,
            'all_cat' => $all_cat,
        ];

        return view('river::admin.blogs.edit', $data);
    }

    public function update(Request $request, $id)
    {

        // $image = $request->file('image');
        // $image_name = date('Ymdhis.').$image->getClientOriginalExtension();

        // $publicPath = public_path();
        // $directory = 'river/assets';
        // $targetDirectory = $publicPath . '/' . $directory;

        // $image->move($targetDirectory,$image_name);

        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $file = Blog::find($id);
        $file->title = $request->get('title');
        $file->content = $request->get('content');
        $file->short_desc = $request->get('short_desc');
        $file->slug = $request->slug;
        $file->image = $request->image;
        $file->category_id = $request->get('category_id');
        $file->meta_title = $request->get('meta_title');
        $file->meta_keywords = $request->get('meta_keywords');
        $file->meta_description = $request->get('meta_description');
        $file->meta_image = $request->get('meta_image');
        $file->author_id = Auth::guard(Constants::AUTH_GUARD_ADMINS)->user()->id;
        $file->is_published = $request->get('is_published');
        $file->save();

        Cache::forget(Constants::CACHE_KEY_BLOG);
        return redirect()->back()->with('success', 'Updated');
    }

    public function destroy($id)
    {
        $file = Blog::find($id);
        $file->delete();



        $publicPath = public_path();
        $directory = 'river/assets';
        $targetDirectory = $publicPath . '/' . $directory . '/' . $file->image;


        // if(File::exists($targetDirectory)) {
        //     unlink($targetDirectory);
        // }
        Cache::forget(Constants::CACHE_KEY_BLOG);
        return redirect(route('river.blog.index'))
            ->with('success', 'Deleted!');
    }
}
