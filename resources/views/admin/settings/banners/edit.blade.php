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
                                    <input type="text" class="form-control" id="alt_text" name="alt_text" value="{{ $banner->alt_text }}"/>
                                </div>
                                <div class="mb-3">
                                    <div class="form-label required">Image</div>
                                    <input type="file" class="form-control" name="image" id="image" onchange="singleImagePreview(event,'ImgPreview1')">
                                </div>
                                <div class="form-group mb-3">
                                    <div class="d-flex align-items-center flex-wrap">
                                    <span class="pip">
                                        <img class="imageThumb" id="ImgPreview1" src="{{ asset($banner->image) ?? '' }}" style="height: 200px;">
                                        <span class="remove btn btn-sm btn-danger" id="removeImage1" onclick="removeSingleImage('ImgPreview1','image')">
                                            Remove
                                        </span>
                                    </span>
                                    </div>
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
    </script>

@endpush
