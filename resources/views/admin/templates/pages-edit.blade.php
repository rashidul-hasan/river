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
    <form action="{{route('river.template-pages.update', $file->id)}}" method="POST">

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label>Filename</label>
                <input type="text" class="form-control" name="filename" value="{{$file->filename}}">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger btn-delete">Delete</button>
        </div>
        <div class="col-md-10">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Code</label>
                <textarea name="code" id="code" cols="30" rows="30"
                          class="form-control"
                >{{$file->code}}</textarea>
            </div>
        </div>
    </div>
    </form>
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
                DynamicForm.create(route('river.template-pages.destroy', "{{$file->id}}"), 'DELETE')
                .addCsrf()
                .submit();
            }
        });
    </script>
@endpush
