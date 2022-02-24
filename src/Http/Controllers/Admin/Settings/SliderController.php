<?php

namespace Rashidul\River\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rashidul\River\Models\Slider;
use Rashidul\River\Services\ImageUploadService;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        $data = [
            'sliders' => $sliders,
            'title' => 'Sliders & Banners',
        ];

        return view('river::admin.settings.sliders.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ImageUploadService $imageUploadService)
    {
        $this->validate($request, [
            'image' => 'required',
        ]);

        $slider = new Slider();

        if ($request->hasFile('image')){
            $slider->image = $imageUploadService->upload($request->file('image'),Slider::BASE_PATH);
        }

        $slider->image_url = $request->image_url;
        $slider->orders = $request->orders;
        $slider->status = $request->has('status') ? true : false;
        $slider->open_new_tab = $request->has('open_new_tab') ? '_blank' : '';

        $slider->save();
        return redirect()->route('river.sliders.index')->with('success', 'Successfully Created done!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('river::admin.settings.sliders.edit', compact('slider'));
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
        $slider = Slider::findOrFail($id);

        if ($request->file('image')){
            $slider->image = image_upload($request->file('image'),'/uploads/sliders/', $slider->image);
        }

        $slider->image_url = $request->image_url;
        $slider->orders = $request->orders;
        if (isset($request->status)) {
            $slider->status = true;
        } else {
            $slider->status = false;
        }
        if (isset($request->open_new_tab)) {
            $slider->open_new_tab = '_blank';
        } else {
            $slider->open_new_tab = null;
        }

        $slider->save();

        return redirect()->route('sliders.index')->with('success', 'Successfully Updated done!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        $image = $slider->image;

        try {
            if (file_exists(public_path($image)) && $image) {
                unlink(public_path($image));
            }

            $slider->delete();
            return redirect()->back()->with('success', 'Successfully Deleted done!');

        } catch (\Exception $exception) {

            notify()->error('Unable to delete this Image ');
            return redirect()->back();
        }
    }

    public function sliderStatus($id, $status)
    {
        $data = Slider::findOrfail($id);
        $data->status = $status;
        $data->save();
        return response()->json([
            'success' => true,
            'message' => 'Status Updated successfully!',
        ], 200);
    }
}
