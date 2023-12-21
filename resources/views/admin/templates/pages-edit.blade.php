@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
    <link rel="stylesheet" href="/river/admin/codemirror-5.65.2/lib/codemirror.css" />
    <link rel="stylesheet" href="/river/admin/codemirror-5.65.2/theme/monokai.css" />
    <style>
        .CodeMirror {
            height: 600px;
        }

        /* Show both horizontal and vertical scrollbars */
        .CodeMirror-scroll {
            overflow: scroll !important;
        }

        /* Alternatively, you can use the following to show only vertical scrollbar */
        .CodeMirror-vscrollbar {
            overflow-y: scroll !important;
        }

        /* Or show only horizontal scrollbar */
        .CodeMirror-hscrollbar {
            overflow-x: scroll !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <form action="{{route('river.template-pages.update', $file->id)}}" method="POST">
                <div class="row">

                        <div class="col-md-3">
                                <div class="input-icon">
                                    <input type="text" class="form-control" name="filename" value="{{$file->filename}}">
                                </div>

                        </div>

                        <div class="col-md-3">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-danger btn-delete">Delete</button>
                                        <a class="btn btn-primary" href="{{ route('river.template-pages.index') }}"> Back</a>
                                    </div>
                                </div>
                        </div>

                        <div class="col-md-6">

                            <div class="dropdown">
                                <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Select page</a>
                                <div class="dropdown-menu">
                                    @foreach($pages as $f)
                                        <a class="dropdown-item @if($file->id == $f->id) active @endif"
                                           href="{{route('river.template-pages.edit', $f->id)}}">{{$f->filename}}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-md-12 my-3">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <textarea name="code" id="code" cols="30" rows="50" class="form-control">{{$file->code}}</textarea>
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
                DynamicForm.create(route('river.template-pages.destroy', "{{$file->id}}"), 'DELETE')
                .addCsrf()
                .submit();
            }
        });
    </script>
@endpush
