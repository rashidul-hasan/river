@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('content')
    <div class="pcoded-content">
        {{--<div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h5>Appearance</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class=" breadcrumb breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="https://demo.dashboardpack.com/admindek-html/index.html"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">Dashboard</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>--}}
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Genarel</h4>
                                        <form class="custom-validation" action="{{route('river.store-settings')}}" method="POST" >
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-md-4">Website Name</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="name" value=" {{ river_settings('name') }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-4">Notice</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="notice" value="{{ river_settings('notice') }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Address</label>
                                                <div class="col-md-8">
                                                    <textarea rows="2" class="form-control" id="example-text-input" name="address" >{{ river_settings('address') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Email</label>
                                                <div class="col-md-8">
                                                    <input type="email" class="form-control" name="email" value="{{ river_settings('email') }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Phone</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="phone" value="{{ river_settings('phone') }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">iMO/Whats'up</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="imo_whatsup" value="{{ river_settings('imo_whatsup') }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Open Hour</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="open_hour" value="{{ river_settings('open_hour') }}">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0 float-right">
                                                <div class="col-md-8">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Global SEO</h4>
                                        <form action="{{route('river.store-settings')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-md-4">Meta Title</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="meta_title" value="{{river_settings('meta_title') ?? ''}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Meta description</label>
                                                <div class="col-md-8">
                                                    <textarea rows="2" class="form-control" id="example-text-input" name="meta_description" >{{river_settings('meta_description') ?? ''}}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Keywords</label>
                                                <div class="col-md-8">
                                                    <textarea rows="2" class="form-control" id="example-text-input" name="meta_keywords" placeholder="keyword,keyword">{{river_settings('meta_keywords') ?? ''}}</textarea>
                                                    <small class="text-muted">Separate with coma</small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-4">Meta Image</label>
                                                <div class="col-md-8">
                                                    <div class="file-input">
                                                        <input type="file" name="meta_img" id="meta_img" class="file-input__input" onchange="singleImagePreview(event,'ImgPreview1')"/>
                                                        <label class="file-input__label" for="meta_img">
                                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" class="svg-inline--fa fa-upload fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                <path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
                                                            </svg>
                                                            <span>Upload file</span>
                                                        </label>
                                                    </div>
                                                    <div class="d-flex align-items-center flex-wrap">
                                                        <span class="pip">
                                                            <img class="imageThumb" id="ImgPreview1" src="{{ asset( river_settings('meta_img')) }}">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0 float-right">
                                                <div class="col-md-8">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{route('river.store-settings')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Site Favicon <small class="text-warning">(size 80 x 80)</small></label>
                                                        <div class="">
                                                            <div class="file-input">
                                                                <input type="file" name="favicon" id="favicon" class="file-input__input" onchange="singleImagePreview(event,'ImgPreview2')"/>
                                                                <label class="file-input__label" for="favicon">
                                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" class="svg-inline--fa fa-upload fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                        <path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
                                                                    </svg>
                                                                    <span>Upload file</span>
                                                                </label>
                                                            </div>
                                                            <div class="d-flex align-items-center flex-wrap">
                                                                <span class="pip">
                                                                    <img class="imageThumb" id="ImgPreview2" src="{{ asset( river_settings('favicon')) }}">
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group ">
                                                        <label>Site Logo <small class="text-warning">( size 200px x 50px )</small></label>
                                                        <div class="">
                                                            <div class="file-input">
                                                                <input type="file" name="header_logo" id="header_logo" class="file-input__input" onchange="singleImagePreview(event,'ImgPreview3')"/>
                                                                <label class="file-input__label" for="header_logo">
                                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" class="svg-inline--fa fa-upload fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                        <path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
                                                                    </svg>
                                                                    <span>Upload file</span>
                                                                </label>
                                                            </div>
                                                            <div class="d-flex align-items-center flex-wrap">
                                                        <span class="pip">
                                                            <img class="imageThumb" id="ImgPreview3" src="{{ asset( river_settings('header_logo')) }}">
                                                        </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Footer Logo <small class="text-warning">( size 170 x 70 )</small></label>
                                                        <div class="">
                                                            <div class="file-input">
                                                                <input type="file" name="footer_logo" id="footer_logo" class="file-input__input" onchange="singleImagePreview(event,'ImgPreview4')"/>
                                                                <label class="file-input__label" for="footer_logo">
                                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" class="svg-inline--fa fa-upload fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                        <path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
                                                                    </svg>
                                                                    <span>Upload file</span>
                                                                </label>
                                                            </div>
                                                            <div class="d-flex align-items-center flex-wrap">
                                                        <span class="pip">
                                                            <img class="imageThumb" id="ImgPreview4" src="{{ asset( river_settings('footer_logo')) }}">
                                                        </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Theme color</label>
                                                        <div class="">
                                                            <div class="file-input">
                                                                <input type="color" class="form-control" name="theme_color" value="{{river_settings('theme_color', '#2233aa')}}"/>
                                                            </div>
                                                            <div class="d-flex align-items-center flex-wrap">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-0 float-right">
                                                <div class="col-md-8">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Social Link</h4>
                                        <form class="custom-validation" action="{{route('river.store-settings')}}" method="POST" >
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-md-4">Youtube</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="youtube" value="{{river_settings('youtube')}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Facebook</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"name="facebook" value="{{river_settings('facebook')}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Twitter</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="twitter" value="{{river_settings('twitter')}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Map</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="map_code" value="{{river_settings('map_code')}}">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0 float-right">
                                                <div class="col-md-8">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.dropify').dropify();
        });
    </script>
@endpush
