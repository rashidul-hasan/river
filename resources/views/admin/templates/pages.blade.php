@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
@stop

@section('content')

    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-5">
                <div class="list-group">
                    @foreach($pages as $file)
                        <a class="list-group-item" href="{{route('river.template-pages.edit', $file->id)}}">{{$file->filename}}</a>
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
