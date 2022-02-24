<?php

namespace Rashidul\River\Http\Controllers\Admin\Settings;

use App\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();
        $data = [
            'banners' => $banners,
            'title' => 'All Banners'
        ];

        return view('admin.banners.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $data = [
//            'formAction' => route('banners.store'),
//            'title' => 'Add Banner',
//            'banner' => '',
//        ];
//        return view('admin.banners.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'orders' => 'unique:banners',
        ]);

        $slider = new Banner();
        $slider->image_url = $request->image_url;
        $slider->orders = $request->orders;
        $slider->position = $request->position;
        if ($request->file('image')){
            $file = $request->file('image');
            $filename = date('Y-m-d').'-'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/banners/'),$filename);
            $slider->image = 'uploads/banners/'.$filename;
        }
        if (isset($request->status)) {
            $slider->status = true;
        } else {
            $slider->status = false;
        }
        if (isset($request->open_new_tab)) {
            $slider->open_new_tab = '_blank';
        }

        $slider->save();

        return redirect()->route('banners.index')->with('success', 'Successfully Created done!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::findorFail($id);
        $data = [
            'banner' => $banner,
            'title' => 'Edit Banner',
        ];

        return view('admin.banners.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'orders' => 'unique:banners,orders,'.$id,
        ]);

        $banner = Banner::findOrFail($id);

        if ($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path($banner->image));
            $filename = date('Y-m-d').'-'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/banners/'),$filename);
            $banner->image = 'uploads/banners/'.$filename;
        }
        $banner->image_url = $request->image_url;
        $banner->orders = $request->orders;
        $banner->position = $request->position;
        if (isset($request->status)) {
            $banner->status = true;
        } else {
            $banner->status = false;
        }
        if (isset($request->open_new_tab)) {
            $banner->open_new_tab = '_blank';
        }else {
            $banner->open_new_tab = null;
        }

        $banner->save();

        return redirect()->route('banners.index')->with('success', 'Successfully Updated done!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        $image = $banner->image;

        try {
            if (file_exists(public_path($image)) && $image ) {
                unlink(public_path($image));
            }

            $banner->delete();
            return redirect()->back()->with('success', 'Successfully Deleted done!');

        }catch (\Exception $exception){
            return redirect()->back()->with('error', 'Unable to delete this Image!');
        }
    }

    public function bannerStatus($id, $status)
    {
        $data = Banner::findOrfail($id);
        $data->status = $status;
        $data->save();
        return response()->json([
            'success' => true,
            'message' => 'Status Updated successfully!',
        ], 200);
    }
}
