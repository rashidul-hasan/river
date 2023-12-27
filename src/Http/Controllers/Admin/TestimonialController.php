<?php

namespace Rashidul\River\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Rashidul\River\Constants;
use Rashidul\River\Models\Faq;

use Rashidul\River\Models\Testimonial;


class TestimonialController
{
    public function index()
    {

        $all = Testimonial::all();

        $buttons = [
            ['Add Testimonial', route('river.testimonial.create'), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],

        ];
        $data = [
            'title' => 'Testimonial',
            'all' => $all,
            '_top_buttons' => $buttons
        ];

        return view('river::admin.testimonial.index', $data);
    }

    public function create(){
        $buttons = [
            ['Back', route('river.testimonial.index'), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],

        ];
        $data = [
            'title' => 'Testimonial',
            '_top_buttons' => $buttons
        ];

        return view('river::admin.testimonial.create', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required', //TODO no space, valid blade file name
        ]);

        $file = Testimonial::create([
            'name' => $request->name,
            'image' => $request->image,
            'designation' => $request->designation,
            'message' => $request->message,
            'sort_order' => $request->sort_order,
            'is_active' => $request->is_active,
        ]);

        return redirect(route('river.testimonial.index', $file->id))
            ->with('success', 'Created!');
    }

    public function edit($id)
    {
        $file = Testimonial::find($id);


        $data = [
            'title' => 'Edit Testimonial: ' . $file->name,
            'type' => $file
        ];

        return view('river::admin.testimonial.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',

        ]);

        $file = Testimonial::find($id);
        $file->name = $request->get('name');
        $file->image = $request->get('image');
        $file->designation = $request->get('designation');
        $file->message = $request->get('message');
        $file->sort_order = $request->get('sort_order');
        $file->is_active = $request->get('is_active');
        $file->save();

        return redirect()->back()->with('success', 'Updated');
    }


    public function destroy($id)
    {
        $file = Testimonial::find($id);
        $file->delete();


        $publicPath = public_path();
        $directory = 'river/assets';
        $targetDirectory = $publicPath . '/' . $directory . '/'.$file->image ;


        if(File::exists($targetDirectory)) {
            unlink($targetDirectory);
        }

        return redirect(route('river.testimonial.index'))
            ->with('success', 'Deleted!');
    }
}
