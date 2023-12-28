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
            display: block;
        }
    </style>
@endsection



@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-12">
                <div class="card">
                      <ul class="nav nav-tabs" data-bs-toggle="tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="{{ route('river.blog.index') }}" class="btn btn-primary" >back</a>
                        </li>
                       
                    </ul> 
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
                                <form action="{{route('river.service.update', $type->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-3 ">
                                        <label class="form-label required"> Title</label>
                                        <div>
                                            <input type="text" class="form-control"  name="title" value="{{ $type->title }}">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 ">
                                        <label class="form-label required"> Slug</label>
                                        <div>
                                            <input type="text" class="form-control"  name="slug" value="{{ $type->slug }}">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 ">
                                        <label class="form-label required"> Content</label>
                                        <div>
                                            <textarea class="form-control" id="content_type" name="content"  >
                                            {{ $type->content }}
                                            </textarea>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 ">
                                        <label class="form-label "> Meta Description</label>
        
                                        <div>
                                            <input type="text" class="form-control"  name="meta_desc" value="{{ $type->meta_desc }}">
                                        </div>
                                    </div>


                                     <div class="form-group mb-3 ">
                                        <label class="form-label">Service Category Category</label>
                                        <select class="form-select" name="category_id" aria-label="Default select example">
                                            
                                            @foreach($all_cat as $a)
                                            <option value="{{$a->id}}" @if($a->id==$type->category_id) selected  @endif >{{ $a->name }}</option>
                                            @endforeach    
                                        </select>
                                    </div> 

                                    <div class="form-group mb-3 ">
                                        <label class="form-label "> Sort Order</label>
                                        <div>
                                            <input type="text" class="form-control"  name="sort_order" value="{{ $type->sort_order }}">
                                        </div>
                                    </div>


                                    <div class="form-group mb-3 row">
                                        <div class="form-group">
                                            <label>Icon <small class="text-warning">( size 200px x 50px )</small></label>
                                            @include('river::admin.components.image-picker', ['name' => 'icon', 'default' =>$type->icon ])
        
                                        </div>
                                        
                                    </div>
        
        
                                    <div class="form-group mb-3 row">
                                        <div class="form-group">
                                            <label>Image <small class="text-warning"></small></label>
                                            @include('river::admin.components.image-picker', ['name' => 'image', 'default' => $type->image])
                                        </div>
                                    </div>


                                    <div class="form-group mb-3 ">
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" name="is_published" value="1" {{$type->is_published == 1 ? 'checked' : ''}}>
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


