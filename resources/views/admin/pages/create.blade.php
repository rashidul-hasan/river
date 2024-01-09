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
            <div class="card">
                <div class="card-body row">
                    <div class="col-md-8">
                        <form action="{{route('river.pages.store')}}" method="POST">
                            @csrf
                            <div class="form-group mb-3 ">
                                <label class="form-label required">Title</label>
                                <div>
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                </div>
                            </div>

                            <div class="form-group mb-3 ">
                                <label class="form-label required">Slug</label>
                                <div>
                                    <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <label class="form-label required">Menu Title</label>
                                <div>
                                    <input type="text" class="form-control" name="menu_title" value="{{ old('menu_title') }}">
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <label class="form-label required">Meta Description</label>
                                <div>
                                    <input type="text" class="form-control" name="meta_description" value="{{ old('meta_description') }}">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label required"> Header Code</label>
                                <div>
                                    <textarea class="form-control" name="header_code" id="floatingTextarea">{{ old('header_code') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label required"> Footer Code</label>
                                <div>
                                    <textarea class="form-control" name="footer_code" id="floatingTextarea">{{ old('footer_code') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group mb-3 ">
                                <label class="form-label">Type</label>
                                <div>
                                    <select class="form-select" name="content_type" id="contentType">
                                        <option value="" selected disabled>Select</option>
                                        <option value="{{\Rashidul\River\Models\RiverPage::CONTENT_TYPE_HTML}}">HTML
                                        </option>
                                        <option value="{{\Rashidul\River\Models\RiverPage::CONTENT_BLADE}}">Blade
                                        </option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group mb-3 ">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_published" value="1">
                                    <span class="form-check-label">Published</span>
                                </label>
                            </div>

                            <div class="type-output">
                                <div class="form-group content"
                                    id="content-{{\Rashidul\River\Models\RiverPage::CONTENT_TYPE_HTML}}">
                                    <textarea name="page_content1" id="content_type"></textarea>
                                </div>
                                <div class="form-group content"
                                    id="content-{{\Rashidul\River\Models\RiverPage::CONTENT_BLADE}}">
                                    <textarea name="page_content2" id="code" cols="30" rows="30"
                                        class="form-control"></textarea>
                                </div>
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
    var code = CodeMirror.fromTextArea(document.getElementById("code"), {
            lineNumbers: true,
            mode: "php",
            theme: 'monokai'
        });
        tinymce.init({
            selector: '#content_type',
        })
        $(function() {
            $('#contentType').change(function(){
                $('.content').hide();
                $('#content-' + $(this).val()).show();
            });
        });
</script>
@endpush
