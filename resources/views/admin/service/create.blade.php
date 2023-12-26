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
                           <form action="{{route('river.service.store')}}" method="POST">
                               @csrf
                               <div class="form-group mb-3 ">
                                   <label class="form-label required"> Title</label>
                                   <div>
                                       <input type="text" class="form-control"  name="title" value="{{ old('title') }}">
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
                                    <textarea class="form-control" id="content_type" name="content"  >

                                    </textarea>
                                    
                                </div>
                            </div>

                            <div class="form-group mb-3 ">
                                <label class="form-label required"> Meta Description</label>

                                <div>
                                    <input type="text" class="form-control"  name="meta_desc" value="{{ old('meta_desc') }}">
                                </div>
                            </div>

                            <div class="form-group mb-3 ">
                                <label class="form-label required"> Category Id</label>
                                <div>
                                    <input type="text" class="form-control"  name="category_id" value="{{ old('category_id') }}">
                                </div>
                            </div>


                             <div class="form-group mb-3 ">
                                        <label class="form-label required">Category</label>
                                        <select class="form-select" name="category_id" aria-label="Default select example">
                                            <option  value="" selected disabled > Add service Category</option>
                                            @foreach($all_cat as $a)
                                            <option value="{{$a->id}}" >{{ $a->name }}</option>
                                            @endforeach    
                                        </select>
                            </div> 

                            

                            <div class="form-group mb-3 ">
                                <label class="form-label required"> Sort Order</label>
                                <div>
                                    <input type="text" class="form-control"  name="sort_order" value="{{ old('sort_order') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label>Icon <small class="text-warning">( size 200px x 50px )</small></label>
                                    <div class="">
                                        <div class="mb-3">
                                            <input type="file" class="form-control" name="icon" id="header_logo">
                                        </div>
                                        <div class="d-flex align-items-center flex-wrap">
                                            <span class="pip">
                                                <img class="imageThumb" id="ImgPreview3"
                                                     src="{{ asset( river_settings('header_logo')) }}" style="width: 80px; height: 80px">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-2 my-2">
                                        <button data-url="@{{river_settings('header_logo')}}" class="btn btn-icon btn-copy">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" /><path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" /></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label>Image <small class="text-warning"></small></label>
                                    <div class="">
                                        <div class="mb-3">
                                            <input type="file" class="form-control" name="image" id="header_logo">
                                        </div>
                                        <div class="d-flex align-items-center flex-wrap">
                                            <span class="pip">
                                                <img class="imageThumb" id="ImgPreview3"
                                                     src="{{ asset( river_settings('header_logo')) }}" style="width: 80px; height: 80px">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-2 my-2">
                                        <button data-url="@{{river_settings('header_logo')}}" class="btn btn-icon btn-copy">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" /><path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" /></svg>
                                        </button>
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
