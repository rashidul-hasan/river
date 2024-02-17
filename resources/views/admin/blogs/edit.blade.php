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
        display: block;
    }
</style>
@endsection



@section('content')
<div class="container-xl">
    <div class="row row-cards">
        <div class="col-md-12">
            <div class="">
                <ul class="nav nav-tabs" data-bs-toggle="tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('river.blog.index') }}" class="btn btn-primary">back</a>
                    </li>

                </ul>

            </div>
        </div>
    </div>
</div>


<div class="container-xl pt-3">
    <div class="row row-cards">
        <div class="col-md-12">
            <div class="">
                <div class="card-body row">
                    <div class=" card col-md-8">
                        <div class="card-body">
                            <form action="{{route('river.blog.update', $type->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3 ">
                                    <label class="form-label required"> Title</label>
                                    <div>
                                        <input type="text" class="form-control generate-slug" data-slug-field="slug" name="title" value="{{ $type->title }}">
                                    </div>
                                </div>

                                <div class="form-group mb-3 ">
                                    <label class="form-label required"> Slug</label>
                                    <div>
                                        <input type="text" class="form-control" name="slug" value="{{ $type->slug }}">
                                    </div>
                                </div>

                                <div class="form-group mb-3 ">
                                    <label class="form-label required"> Content</label>
                                    <div>
                                        <textarea class="form-control" id="content_type" name="content">
                                                {{ $type->content }}
                                            </textarea>

                                    </div>
                                </div>

                                <div class="form-group mb-3 ">
                                    <label class="form-label "> Sort Description</label>

                                    <div>
                                        <input type="text" class="form-control"  name="short_desc" value="{{ $type->short_desc }}">
                                    </div>
                                </div>

                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="form-group mb-3 ">
                            <div class="card">
                                <div class="card-header">
                                    <label class="form-label">Category</label>
                                </div>
                                <div class="card-body">
                                    <select class="form-select js-example-basic-single" name="category_id" aria-label="Default select example">
                                    <option value="0" disabled>Select Category</option>
                                    @foreach($all_cat as $a)
                                    <option value="{{$a->id}}" @if($a->id==$type->category_id) selected @endif >{{
                                        $a->name }}</option>
                                    @endforeach
                                    </select>
                                </div>

                            </div>

                        </div>

                        <div class="form-group mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        @include('river::admin.components.image-picker', ['name' => 'image', 'default'
                                        => $type->image ])
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="form-group mb-3 ">
                            <label class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_published" value="1"
                                    {{$type->is_published == 1 ? 'checked' : ''}}>
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
</div>
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

    // select2
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });

            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
            });

    tinymce.init({
            selector: '#content_type',
        })
        $(function() {
            $('#contentType').change(function(){
                $('.content').hide();
                $('#' + $(this).val()).show();
            });
        });

        $('.lfm-picker').filemanager('image', {prefix: window.hp_route_prefix});
</script>
@endpush
