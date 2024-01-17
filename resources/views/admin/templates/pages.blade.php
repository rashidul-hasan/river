@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

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
