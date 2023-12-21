@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
    <link rel="stylesheet" href="/river/admin/codemirror-5.65.2/lib/codemirror.css" />
    <link rel="stylesheet" href="/river/admin/codemirror-5.65.2/theme/monokai.css" />
    <style>
        .CodeMirror {
            height: 400px;
        }
        .content{
            display: block;
        }
    </style>
@endsection

@section('content')
    <div class="container-xl">

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs" data-bs-toggle="tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="#general" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab" tabindex="-1">General</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <form method="POST" action="{{ route('river.menu-field', $type->id) }}">
                            @csrf
                            <input type="submit"  value="Fields" class="nav-link" />
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row row-cards">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-md-8">
                            <form action="{{route('river.menu.update', $type->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3 ">
                                    <label class="form-label required">name</label>
                                    <div>
                                        <input type="text" class="form-control"  name="name" value="{{$type->name}}">
                                    </div>
                                </div>
                                
                                <div class="form-group mb-3 ">
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" {{$type->is_active == 1 ? 'checked' : ''}}>
                                        <span class="form-check-label">Is Active</span>
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
                $('#' + $(this).val()).show();
            });
        });
    </script>
@endpush

