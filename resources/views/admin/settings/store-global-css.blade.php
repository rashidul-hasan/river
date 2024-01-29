@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop



@section('css')
    <link rel="stylesheet" href="/river/admin/codemirror-5.65.2/lib/codemirror.css" />
    <link rel="stylesheet" href="/river/admin/codemirror-5.65.2/addon/scroll/simplescrollbars.css" />
    <link rel="stylesheet" href="/river/admin/codemirror-5.65.2/addon/fold/foldgutter.css" />

    <style>
        .CodeMirror {
            height: 600px;
            overflow-y: scroll;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Global CSS </h4>
                    <form class="custom-validation" action="{{route('river.store-settings')}}" method="POST">
                        @csrf

                        {{-- <div class="form-group content"  id="content-{{\Rashidul\River\Models\RiverPage::CONTENT_TYPE_HTML}}">
                                    <textarea name="global_css" id="content_type" >{{ river_settings('global_css') }}</textarea>
                        </div>   --}}

                        <div class="form-group">
                            <textarea name="global_css" id="code" cols="30" rows="50" class="form-control">{{ river_settings('global_css') }}</textarea>
{{--                            <div id="editor" style="height: 500px;"></div>--}}
                        </div>



                    <div class="form-group row mb-0 float-right">
                        <div class="col-md-8 mt-4">
                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>





    </div>
@stop

@push('scripts')



{{-- <script src="/river/admin/codemirror-5.65.2/lib/codemirror.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/htmlmixed/htmlmixed.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/xml/xml.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/javascript/javascript.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/css/css.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/clike/clike.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/php/php.js"></script> --}}

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
            mode: "css",
            // theme: 'monokai',
            foldGutter: true,
            matchTags: {bothTags: true},
            gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"],
            extraKeys: {"Ctrl-Q": function(cm){ cm.foldCode(cm.getCursor()); }},
        });

    </script>


<script>
    // var code = CodeMirror.fromTextArea(document.getElementById("content_type"), {
    //         lineNumbers: true,
    //         mode: "php",
    //         theme: 'monokai'
    //     });
    //     $(document).ready(function() {
    //         $('#content_type').summernote();
    //     });
        // $(function() {
        //     $('#contentType').change(function(){
        //         $('.content').hide();
        //         $('#content-' + $(this).val()).show();
        //     });
        // });
</script>

<script>
    function generateSlug() {
        // Get the value from the title input
        const title = document.getElementById('title').value.trim().toLowerCase();

        // Replace spaces with dashes and remove special characters
        const slug = title.replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');

        // Update the slug input field
        document.getElementById('slug').value = slug;
    }
</script>







    <script>
        $(document).ready(function () {
            $('.dropify').dropify();
        });

        $('.btn-copy').on('click', function (e) {
            e.preventDefault();
            var $this = $(this);
            var url = $this.data('url');
            navigator.clipboard.writeText(url);
        });
    </script>
@endpush
