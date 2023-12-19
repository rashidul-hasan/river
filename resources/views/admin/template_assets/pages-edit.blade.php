@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
    <link rel="stylesheet" href="/river/admin/codemirror-5.65.2/lib/codemirror.css" />
    <link rel="stylesheet" href="/river/admin/codemirror-5.65.2/theme/monokai.css" />
    <style>
        .CodeMirror {
            height: 400px;
        }
    </style>
@endsection

@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <form action="{{route('river.template-assets.update', $file->id)}}" method="POST">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Filename</h3>
                                <div class="input-icon">
                                    <input type="text" class="form-control" name="filename" value="{{$file->filename}}">
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">Type</h3>
                                <div class="input-icon">
                                    <select class="form-control" name="type">
                                        <option value="1" @if($file->type==1) selected @endif>CSS</option>
                                        <option value="2" @if($file->type==2) selected @endif>Js</option>
                                    </select>
                                   
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title">Content</h3>
                                <div class="input-icon">
                                    <input type="text" class="form-control" name="content" value="{{$file->content}}">
                                </div>
                            </div>
                            
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-danger btn-delete">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Code</label>
                            <textarea name="code" id="code" cols="30" rows="30" class="form-control">{{$file->code}}</textarea>
                        </div>
                    </div>
                </div>
            </form>
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

        $('.btn-delete').click(function () {
            if(window.confirm('Delete this file?')) {
                DynamicForm.create(route('river.template-assets.destroy', "{{$file->id}}"), 'DELETE')
                .addCsrf()
                .submit();
            }
        });
    </script>
@endpush
