@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
    <link rel="stylesheet" href="/river/admin/codemirror-5.65.2/lib/codemirror.css" />
    /*<link rel="stylesheet" href="/river/admin/codemirror-5.65.2/theme/monokai.css" />*/
    <link rel="stylesheet" href="/river/admin/codemirror-5.65.2/addon/scroll/simplescrollbars.css" />
    <link rel="stylesheet" href="/river/admin/codemirror-5.65.2/addon/fold/foldgutter.css" />
    /*<link rel="stylesheet" href="https://unpkg.com/monaco-editor@0.27.0/min/vs/editor/editor.main.css" />*/

    <style>
        .CodeMirror {
            height: 600px;
            overflow-y: scroll;
        }
    </style>
@endsection

@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <form action="{{route('river.template-pages.update', $file->id)}}" method="POST" id="form-code">
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
                                        <button type="button" class="btn btn-secondary btn-preview">Preview</button>
                                        <a class="btn btn-link" href="{{ route('river.template-pages.index') }}"> Cancel</a>
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
{{--                            <div id="editor" style="height: 500px;"></div>--}}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="modal-preview" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preview</h5>
                </div>
                <div class="modal-body">
                    <iframe src="" frameborder="0" id="iframe-preview"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    <script src="/river/admin/codemirror-5.65.2/mode/php/php.js"></script>
    <script src="/river/admin/codemirror-5.65.2/addon/fold/foldcode.js"></script>
    <script src="/river/admin/codemirror-5.65.2/addon/fold/xml-fold.js"></script>
    <script src="/river/admin/codemirror-5.65.2/addon/fold/foldgutter.js"></script>
{{--    <script src="/river/admin/codemirror-5.65.2/addon/fold/brace-fold.js"></script>--}}
    <script src="/river/admin/codemirror-5.65.2/addon/edit/matchbrackets.js"></script>
    <script src="/river/admin/codemirror-5.65.2/addon/edit/matchtags.js"></script>
    <script src="/river/admin/codemirror-5.65.2/addon/scroll/simplescrollbars.js"></script>
    <script>
        var codeMirror = CodeMirror.fromTextArea(document.getElementById("code"), {
            lineNumbers: true,
            mode: "php",
            // theme: 'monokai',
            foldGutter: true,
            matchTags: {bothTags: true},
            gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"],
            extraKeys: {"Ctrl-Q": function(cm){ cm.foldCode(cm.getCursor()); }},
        });

        $('.btn-delete').click(function () {
            if(window.confirm('Delete this file?')) {
                DynamicForm.create(route('river.template-pages.destroy', "{{$file->id}}"), 'DELETE')
                .addCsrf()
                .submit();
            }
        });

        //show preview
        $('.btn-preview').click(function () {
            fetchDataAndDisplayInIframe()
        });
        function fetchDataAndDisplayInIframe() {
            var code = codeMirror.getValue();
            var postData = {
                content: code
            };

            $.ajax({
                url: '/admin/template-pages/preview',
                method: 'POST',
                dataType: 'html',
                data: postData, // Include the data to be sent in the request
                success: function(htmlString) {
                    // Get the iframe element by its ID
                    var iframe = document.getElementById('iframe-preview');

                    // Access the document of the iframe
                    var iframeDocument = iframe.contentDocument || iframe.contentWindow.document;

                    // Write the HTML string into the iframe document
                    iframeDocument.open();
                    iframeDocument.write(htmlString);
                    iframeDocument.close();
                    $("#modal-preview").modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }
    </script>
{{--    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/monaco-editor/min/vs/loader.js"></script>--}}

    <script>

        $(document).ready(function () {
            /*var code = atob("{{ base64_encode($file->code) }}");
            var editor;

            require.config({ paths: { 'vs': 'https://cdn.jsdelivr.net/npm/monaco-editor@0.27.0/min/vs' }});
            window.MonacoEnvironment = {
                getWorkerUrl: function(workerId, label) {
                    return `data:text/javascript;charset=utf-8,${encodeURIComponent(`
        self.MonacoEnvironment = {
          baseUrl: 'https://cdn.jsdelivr.net/npm/monaco-editor/min/'
        };
        importScripts('https://cdn.jsdelivr.net/npm/monaco-editor/min/vs/base/worker/workerMain.js');`)}`;
                }
            };

            require(['vs/editor/editor.main'], function() {
                editor = monaco.editor.create(document.getElementById('editor'), {
                    value: code,
                    language: 'html',
                    theme: 'vs-dark',
                    automaticLayout: true,
                    wordWrap: 'on',
                    minimap: {
                        enabled: true
                    }
                });
            });*/

            /*$('#form-code').submit(function (e) {
                console.log('   jsjjs');
                var c = editor.getValue();
                $("<input />").attr("type", "hidden")
                    .attr("name", "code")
                    .attr("value", c)
                    .appendTo(this);
                return true;
            });*/
        });

    </script>
@endpush
