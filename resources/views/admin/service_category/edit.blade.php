@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('page-header')
    <x:river::header>
            <x-slot:title>
            Edit Category
            </x-slot>

            <x-slot:breads>
                <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{route('river.service-category.index')}}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Edit Category</a></li>
            </x-slot:breads>

            <x-slot:buttons>
                <a href="{{route('river.service-category.index')}}" class="btn">
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
            display: block;
        }
    </style>
@endsection



@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-12">
                <div class="card">
                    {{-- <ul class="nav nav-tabs" data-bs-toggle="tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="{{ route('river.blog-category.index') }}" class="btn btn-primary" >back</a>
                        </li>

                    </ul> --}}
                    {{-- <ul class="nav nav-tabs" data-bs-toggle="tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="#general" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab" tabindex="-1">General</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#fields" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab">Fields</a>
                        </li>
                    </ul> --}}
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active show p-5" id="general" role="tabpanel">
                                <form action="{{route('river.blog-category.update', $type->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-3 ">
                                        <label class="form-label required"> Name</label>
                                        <div>
                                            <input type="text" class="form-control"  name="name" value="{{ $type->name }}">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 ">
                                        <label class="form-label">Parent</label>
                                        <div>
                                            <div>
                                                <select class="form-select" name="parent_id" aria-label="Default select example">
                                                      <option  value="0">select Parent Category</option>
                                                    @foreach($all as $a)
                                                    <option value="{{$a->id}}" @if($type->parent_id == $a->id )selected  @endif > {{ $a->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 ">
                                        <label class="form-label">  Sort Order</label>
                                        <div>
                                            <input type="number" class="form-control"  name=" sort_order" value="{{ $a->sort_order }}">
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


