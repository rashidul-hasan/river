@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('page-header')
    <x:river::header>
            <x-slot:title>
            Add Service
            </x-slot>

            <x-slot:breads>
                <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{route('river.service.index')}}">Services</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Add Service</a></li>
            </x-slot:breads>

            <x-slot:buttons>
                <a href="{{route('river.service.index')}}" class="btn">
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
                <div class="">
                    <div class="card-body row">
                       <div class="card col-md-8">
                            <div class="card-body">
                                <form action="{{route('river.service.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3 ">
                                        <label class="form-label required"> Title</label>
                                        <div>
                                            <input type="text" class="form-control generate-slug" data-slug-field="slug"  name="title" value="{{ old('title') }}">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 ">
                                        <label class="form-label required"> Slug</label>
                                        <div>
                                            <input type="text" class="form-control"  name="slug" value="{{ old('slug') }}">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 ">
                                        <label class="form-label required"> Content</label>
                                        <div>
                                            <textarea class="form-control ckeditor" id="" name="content"  >

                                            </textarea>

                                        </div>
                                    </div>

                                 <div class="form-group mb-3 ">
                                     <label class="form-label"> Sort Description</label>

                                     <div>
                                         <input type="text" class="form-control"  name="short_desc" value="{{ old('short_desc') }}">
                                     </div>
                                 </div>

                                 <div class="form-group mb-3 ">
                                     <label class="form-label"> Meta Description</label>

                                     <div>
                                         <input type="text" class="form-control"  name="meta_desc" value="{{ old('meta_desc') }}">
                                     </div>
                                 </div>

                            </div>


                       </div>

                       <div class="col-md-4">

                        <div class="form-group mb-3 ">
                            <div class="card">
                                <div class="card-header">
                                    <label class="form-label"> Service Category</label>
                                </div>
                                <div class="card-body">
                                    <select class="form-select select2" name="category_id" aria-label="Default select example">
                                   <option  value="" selected disabled > Add service Category</option>
                                   @foreach($all_cat as $a)
                                   <option value="{{$a->id}}" >{{ $a->name }}</option>
                                   @endforeach
                                    </select>
                                </div>
                            </div>

                       </div>



                       <div class="form-group mb-3 ">
                            <div class="card">
                                <div class="card-header">
                                    <label class="form-label"> Sort Order</label>
                                </div>
                                <div class="card-body">

                                    <div>
                                        <input type="number" class="form-control"  name="sort_order" value="{{ old('sort_order') }}">
                                    </div>
                                </div>
                            </div>

                       </div>

                       <div class="form-group mb-3 row">
                        <div class="card m-2">
                            <div class="card-header">
                                <label>Icon <small class="text-warning">( size 200px x 50px )</small></label>
                            </div>
                            <div class="card-body ">
                                <div class="form-group">

                                    @include('river::admin.components.image-picker', ['name' => 'icon', 'default' => river_settings('icon')])
                                </div>

                            </div>
                        </div>


                       </div>

                       <div class="form-group mb-3 row">
                        <div class="card m-2">
                            <div class="card-header">
                                <label>Image <small class="text-warning"></small></label>
                            </div>
                            <div class="card-body">
                                <div class="form-group">

                                    @include('river::admin.components.image-picker', ['name' => 'image', 'default' => river_settings('image')])
                                </div>

                            </div>
                        </div>


                       </div>

                          <div class="form-group mb-3 ">
                              <label class="form-check">
                                  <input class="form-check-input" type="checkbox" name="is_published" value="1">
                                  <span class="form-check-label">Is Published</span>
                              </label>
                          </div>

                          <div class="form-footer">
                              <button type="submit" class="btn btn-success">Save</button>
                          </div>

                       </div>

                        </form>
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

            // $(document).ready(function() {
            //     $('.js-example-basic-single').select2();
            // });

        tinymce.init({
            selector: '#content_type',
        })
        $(function() {
            $('#contentType').change(function(){
                $('.content').hide();
                $('#' + $(this).val()).show();
            });
        });

        $('.lfm-picker').filemanager('image', {prefix: window.hp_route_prefix});
    </script>
@endpush
