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
                           <form action="{{route('river.service-category.store')}}" method="POST">
                               @csrf
                               <div class="form-group mb-3 ">
                                   <label class="form-label required"> Name</label>
                                   <div>
                                       <input type="text" class="form-control"  name="name" value="{{ old('name') }}">
                                   </div>
                               </div>
                               

                            <div class="form-group mb-3 ">
                                <label class="form-label required">Parent</label>
                                <div>
                                    <select class="form-select" name="parent_id" aria-label="Default select example">
                                        <option selected value="0">select Parent Category</option>
                                        @foreach($all as $a)
                                        <option value="{{$a->id}}">{{ $a->name }}</option>
                                        @endforeach    
                                    </select>
                                </div>
                                
                            </div>
                               
                               
                            <div class="form-group mb-3 ">
                                <label class="form-label required">  Sort Order</label>
                                <div>
                                    <input type="text" class="form-control"  name=" sort_order" value="{{ old(' sort_order') }}">
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
                $('#' + $(this).val()).show();
            });
        });
    </script>
@endpush
