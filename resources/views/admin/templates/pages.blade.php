@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('page-header')
    <x:river::header>
        <x-slot:title>
            pages
        </x-slot>

        <x-slot:breads>
            <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">pages</a></li>
        </x-slot:breads>

        <x-slot:buttons>
            <a  class="btn btn-primary d-none d-sm-inline-block" id="btn-add-new">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Add new
            </a>
        </x-slot:buttons>

    </x:river::header>
@stop

@section('css')
@stop

@section('content')

    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-5">
                <div class="list-group ">
                    @php
                    use Carbon\Carbon;
                    @endphp
                    @foreach($pages as $file)
                    <div class="d-flex  justify-content-between list-group-item" >
                        <a class="" href="{{route('river.template-pages.edit', $file->id)}}">{{$file->filename}}</a>
                        <p class=""> Last Update: {{Carbon::parse($file->updated_at)->format('j M, Y g:ia')}}</p>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $('#btn-add-new').click(function (e) {
            e.preventDefault();
            var filename = window.prompt('Enter file name');

            DynamicForm.create(route('river.template-pages.store'), "POST")
                .addField("filename", filename)
                .addCsrf()
                .submit();
        })
    </script>
@endpush
