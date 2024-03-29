@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('page-header')
    <x:river::header>
            <x-slot:title>
               Edit Form
            </x-slot>

            <x-slot:breads>
                <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{route('river.contact-form.index')}}">Contact Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Edit Form</a></li>
            </x-slot:breads>

            <x-slot:buttons>
                <a href="{{route('river.contact-form.index')}}" class="btn">
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
                                <form action="{{ route('river.contact-form.update',$type->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Name</label>
                                        <div class="col">
                                            <input type="text" class="form-control generate-slug" data-slug-field="slug" name="name" value="{{ $type->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Slug</label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="slug"
                                                   value="{{ $type->slug }}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Email</label>
                                        <div class="col">
                                            <input type="email" class="form-control" name="email"
                                                   value="{{ $type->email }}">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Is Ictive</label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="is_active"
                                                   value="{{ $type->is_active }}">
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
                                @include('river::admin.contact_form.fields', ['type' => $type])
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
