@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
<link rel="stylesheet" href="/river/admin/codemirror-5.65.2/lib/codemirror.css" />
<link rel="stylesheet" href="/river/admin/codemirror-5.65.2/theme/monokai.css" />
<style>
    .CodeMirror {
        height: 400px;
    }

    .content {
        display: none;
    }
</style>
@endsection

@section('content')

<div class="container-xl">
    <div class="row row-cards">
        <div class="col-md-12">
            <div class="">
                <div class="card-body row">
                    <div class="col-md-8 card">
                        <div class="card-body">
                            <form action="{{route('river.blog.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3 ">
                                    <label class="form-label required"> Title</label>
                                    <div>
                                        <input type="text" class="form-control generate-slug" name="title" data-slug-field="slug" value="{{ old('title') }}">
                                    </div>
                                </div>

                                <div class="form-group mb-3 ">
                                    <label class="form-label required"> Slug</label>
                                    <div>
                                        <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                                    </div>
                                </div>

                                <div class="form-group mb-3 ">
                                    <label class="form-label required"> Content</label>
                                    <div>
                                        <textarea class="form-control article-editor" id="content_type" name="content">

                                            </textarea>
                                    </div>
                                </div>

                                <div class="form-group mb-3 ">
                                    <label class="form-label "> Sort Description</label>

                                    <div>
                                        <input type="text" class="form-control"  name="short_desc" value="{{ old('short_desc') }}">
                                    </div>
                                </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3 card ">
                            <div class="card-header">
                                <label class="form-label">Category</label>
                            </div>
                            <div class="card-body">
                                <select class="form-select" name="category_id" aria-label="Default select example">
                                <option selected value="0">Select Category</option>
                                @foreach($all_cat as $a)
                                <option value="{{$a->id}}">{{ $a->name }}</option>
                                @endforeach
                            </select>

                            </div>

                        </div>

                        <div class="form-group mb-3 ">
                            <div class="card">
                                <div class="card-header">
                                    <label class="form-label">Tags</label>

                                </div>
                                <div class="card-body">
                                    <select class="form-select" name="tags[]" multiple>
                                        @foreach($tags as $a)
                                        <option value="{{$a->id}}">{{ $a->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>


                        </div>

                        <div class="form-group mb-3 row">
                            <div class="card m-2">
                                <div class="card-header">
                                    <label>Image <small class="text-warning"></small></label>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">

                                        @include('river::admin.components.image-picker', ['name' => 'image', 'default' =>
                                        river_settings('image')])
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="form-group mb-3 ">
                            <label class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_published" value="1">
                                <span class="form-check-label">Is Published</span>
                            </label>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>

                </form>

                </div>

        </div>
    </div>
</div>


{{-- <div class="container-xl">
    <div class="row row-cards">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body row">
                    <div class="col-md-8">
                        <form action="{{route('river.blog.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3 ">
                                <label class="form-label required"> Title</label>
                                <div>
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                </div>
                            </div>

                            <div class="form-group mb-3 ">
                                <label class="form-label required"> Slug</label>
                                <div>
                                    <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                                </div>
                            </div>

                            <div class="form-group mb-3 ">
                                <label class="form-label required"> Content</label>
                                <div>
                                    <textarea class="form-control" id="content_type" name="content">

                                        </textarea>
                                </div>
                            </div>




                            <div class="form-group mb-3 row">
                                <div class="form-group">
                                    <label>Image <small class="text-warning"></small></label>
                                    @include('river::admin.components.image-picker', ['name' => 'image', 'default' =>
                                    river_settings('image')])
                                </div>
                            </div>


                            <div class="form-group mb-3 ">
                                <label class="form-label">Category</label>
                                <select class="form-select" name="category_id" aria-label="Default select example">
                                    <option selected value="0">select Category</option>
                                    @foreach($all_cat as $a)
                                    <option value="{{$a->id}}">{{ $a->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3 ">
                                <label class="form-label">tags</label>

                                <select class="form-select" name="tags[]" multiple>
                                    @foreach($tags as $a)
                                    <option value="{{$a->id}}">{{ $a->name }}</option>
                                    @endforeach
                                </select>

                            </div>


                            <div class="form-group mb-3 ">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_published" value="1">
                                    <span class="form-check-label">Is Published</span>
                                </label>
                            </div>

                            <div class="form-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@stop

@push('scripts')
<script src="/river/admin/codemirror-5.65.2/lib/codemirror.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/htmlmixed/htmlmixed.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/xml/xml.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/javascript/javascript.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/css/css.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/clike/clike.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/php/php.js"></script>
<script>

    $('.article-editor').ckeditor({
        height: 400,
        filebrowserImageBrowseUrl: window.hp_route_prefix + '?type=Images',
        filebrowserImageUploadUrl: window.hp_route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
        filebrowserBrowseUrl: window.hp_route_prefix + '?type=Files',
        filebrowserUploadUrl: window.hp_route_prefix + '/upload?type=Files&_token={{csrf_token()}}',
    });

    // tinymce.init({
    //         selector: '#content_type',
    //     })
    //     $(function() {
    //         $('#contentType').change(function(){
    //             $('.content').hide();
    //             $('#' + $(this).val()).show();
    //         });
    //     });

        $('.lfm-picker').filemanager('image', {prefix: window.hp_route_prefix});
</script>
@endpush
