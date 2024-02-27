@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('page-header')
    <x:river::header>
            <x-slot:title>
            Add Category
            </x-slot>

            <x-slot:breads>
                <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{route('river.blog-category.index')}}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Add Category</a></li>
            </x-slot:breads>

            <x-slot:buttons>
                <a href="{{route('river.blog-category.index')}}" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0"/><path d="M5 12l6 6"/><path d="M5 12l6 -6"/></svg>
                    Back
                </a>
            </x-slot:buttons>

    </x:river::header>
@stop

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
                           <form action="{{route('river.blog-category.store')}}" method="POST">
                               @csrf
                               <div class="form-group mb-3 ">
                                   <label class="form-label required"> Name</label>
                                   <div>
                                       <input type="text" class="form-control generate-slug"  data-slug-field="slug"  name="name" value="{{ old('name') }}" required>
                                   </div>
                               </div>

                               <div class="form-group mb-3 ">
                                <label class="form-label required"> Slug</label>
                                <div>
                                    <input type="text" class="form-control"  name="slug" value="{{ old('slug') }}" required>
                                </div>
                            </div>


                            <div class="form-group mb-3 ">
                                <label class="form-label required">Parent</label>
                                <div>
                                    <select class="form-select select2" name="parent_id" aria-label="Default select example">
                                        <option selected value="0">select Parent Category</option>
                                        @foreach($all as $a)
                                        <option value="{{$a->id}}">{{ $a->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>


                               <div class="form-group mb-3 ">
                                   <label class="form-check">
                                       <input class="form-check-input" type="checkbox" name="is_active" value="1">
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
        //  $(document).ready(function() {
        //         $('.js-example-basic-single').select2();
        //     });

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
