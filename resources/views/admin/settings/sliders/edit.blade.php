@extends('river::admin.layouts.master')
@section('sliders') active @stop

@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-6">
                            <form action="{{ route('river.sliders.update', $slider) }}" method="POST"  enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="form-label" for="title">Url</div>
                                    <input type="text" class="form-control" id="image_url" name="image_url" value="{{ $slider->image_url ?? '' }}"/>

                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-label" for="alt_text">Title</div>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $slider->title }}"/>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-label" for="alt_text">Subtitle</div>
                                    <input type="text" class="form-control" id="Subtitle" name="Subtitle" value="{{ $slider->Subtitle }}"/>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-label" for="alt_text">Button One Text</div>
                                    <input type="text" class="form-control" id="button_one_text" name="button_one_text" value="{{ $slider->button_one_text }}"/>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-label" for="alt_text">Button One Url</div>
                                    <input type="text" class="form-control" id="button_one_url" name="button_one_url" value="{{ $slider->button_one_url }}"/>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-label" for="alt_text">Button Two Text</div>
                                    <input type="text" class="form-control" id="button_two_text" name="button_two_text" value="{{ $slider->button_two_text }}"/>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-label" for="alt_text">Button Two Url</div>
                                    <input type="text" class="form-control" id="button_two_url" name="button_two_url" value="{{ $slider->button_two_url }}"/>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-label" for="orders">Sort order</div>
                                    <input type="number" class="form-control "
                                           id="orders" name="orders" value="{{ $slider->orders ?? '' }}"/>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-label" for="group">Group</div>
                                    <input type="text" class="form-control" id="group" name="group" value="{{ $slider->group ?? '' }}"/>
                                </div>
                                <div class="form-group">
                                    <label>Image <small class="text-warning"></small></label>
                                    @include('river::admin.components.image-picker', ['name' => 'image', 'default' => $slider->image])
                                </div>
                                {{-- <div class="form-group mb-3">
                                    <div class="d-flex align-items-center flex-wrap">
                                    <span class="pip">
                                        <img class="imageThumb" id="ImgPreview1" src="{{ asset($slider->image) ?? '' }}" style="height: 200px;">
                                        <span class="remove btn btn-sm btn-danger" id="removeImage1" onclick="removeSingleImage('ImgPreview1','image')">
                                            Remove
                                        </span>
                                    </span>
                                    </div>
                                </div> --}}
                                <div class="form-group mb-3">
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" name="status" {{isset($slider->status) && $slider->status === 1 ? 'checked' : '' }}>
                                        <span class="form-check-label">Active</span>
                                    </label>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" name="open_new_tab" {{isset($slider->open_new_tab) && $slider->open_new_tab === 1 ? 'checked' : '' }}>
                                        <span class="form-check-label">Open New Tab</span>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-success">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')

    <script>
        $(document).ready(function(){
            $('.dropify').dropify();
        });
        $('.lfm-picker').filemanager('image', {prefix: window.hp_route_prefix});
    </script>

@endpush
