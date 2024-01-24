@extends('river::admin.layouts.master')
@section('sliders') active @stop

@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-6">
                            <form action="{{ route('river.banners.update', $banner->id ) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <div class="form-label" for="alt_text">Alt text</div>
                                    <input type="text" class="form-control generate-slug" data-slug-field="slug" id="alt_text" name="alt_text" value="{{ $banner->alt_text }}"/>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-label" for="alt_text">Slug</div>
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $banner->slug }}"/>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-label" for="alt_text">Title</div>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $banner->title }}"/>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-label" for="alt_text">Subtitle</div>
                                    <input type="text" class="form-control" id="Subtitle" name="Subtitle" value="{{ $banner->Subtitle }}"/>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-label" for="alt_text">Button One Text</div>
                                    <input type="text" class="form-control" id="button_one_text" name="button_one_text" value="{{ $banner->button_one_text }}"/>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-label" for="alt_text">Button One Url</div>
                                    <input type="text" class="form-control" id="button_one_url" name="button_one_url" value="{{ $banner->button_one_url }}"/>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-label" for="alt_text">Button Two Text</div>
                                    <input type="text" class="form-control" id="button_two_text" name="button_two_text" value="{{ $banner->button_two_text }}"/>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-label" for="alt_text">Button Two Url</div>
                                    <input type="text" class="form-control" id="button_two_url" name="button_two_url" value="{{ $banner->button_two_url }}"/>
                                </div>
                                <div class="form-group">
                                    <label>Image <small class="text-warning"></small></label>
                                    @include('river::admin.components.image-picker', ['name' => 'image', 'default' => $banner->image])
                                </div>
                                {{-- <div class="form-group mb-3">
                                    <div class="d-flex align-items-center flex-wrap">
                                    <span class="pip">
                                        <img class="imageThumb" id="ImgPreview1" src="{{ asset($banner->image) ?? '' }}" style="height: 200px;">
                                        <span class="remove btn btn-sm btn-danger" id="removeImage1" onclick="removeSingleImage('ImgPreview1','image')">
                                            Remove
                                        </span>
                                    </span>
                                    </div>
                                </div> --}}

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
