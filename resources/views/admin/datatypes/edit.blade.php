@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('page-header')
    <x:river::header>
            <x-slot:title>
            Edit Data Type
            </x-slot>

            <x-slot:breads>
                <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{route('river.datatypes.index')}}">Data Types</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href=""> Edit Data Type</a></li>
            </x-slot:breads>

            <x-slot:buttons>
                <a href="{{route('river.datatypes.index')}}" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0"/><path d="M5 12l6 6"/><path d="M5 12l6 -6"/></svg>
                    Back
                </a>
            </x-slot:buttons>

    </x:river::header>
@stop

@section('css')

@endsection

@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-12">
                <div class="card">
                    <ul class="nav nav-tabs" data-bs-toggle="tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="#general" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab" tabindex="-1">General</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#fields" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab">Fields</a>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active show p-5" id="general" role="tabpanel">
                                <form action="{{route('river.datatypes.update', $type->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Slug</label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="slug" value="{{ $type->slug }}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Singular</label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="singular"
                                                   value="{{ $type->singular }}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Plural</label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="plural"
                                                   value="{{ $type->plural }}">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Show Page</label>
                                        <div class="col">
                                            <select class="form-select" name="show_page" aria-label="Default select example">
                                                <option value="0" selected disabled>--Select--</option>
                                                @foreach($pages as $f)

                                                    <option value="{{$f->filename}}" @if($f->filename ==$type->show_page ) selected @endif>{{$f->filename}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Icon</label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="icon"
                                                   value="{{ $type->icon }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label pt-0"></label>
                                        <div class="col">
                                            <label class="form-check">
                                                <input class="form-check-input" type="checkbox" name="show_on_menu" @if($type->show_on_menu) checked @endif>
                                                <span class="form-check-label">Show on menu</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>


                            </div>
                            <div class="tab-pane" id="fields" role="tabpanel">
                                @include('river::admin.datatypes.fields', ['type' => $type])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')

@endpush
