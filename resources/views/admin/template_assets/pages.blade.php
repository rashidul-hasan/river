@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
@stop

@section('content')

    <div class="container-xl">
        <div class="row row-cards">

            <div class="col-md-5 justify-content-between">
                

                <div class="list-group">
                    <h3> css Files</h3>
                    @foreach($css_file_name as $key=>$file)
                    <div class="d-flex list-group-item">
                        <p class="mx-2">{{ ++$key .'.' }}</p> <p class="" > {{$file}}</p>
                    </div>
                    @endforeach
                </div>


                <div class="list-group mt-3">
                    <h3> Js Files</h3>
                    @foreach($js_file_name as $key=>$file)
                    <div class="d-flex list-group-item">
                        <p class="mx-2">{{ ++$key .'.' }}</p> <p class="" > {{$file}}</p>
                    </div>
                    @endforeach
                </div>

                <div class="list-group mt-3">
                    <h3> Image Files</h3>
                    @foreach($image_file_name as $key=>$file)
                    <div class="d-flex list-group-item">
                        <p class="mx-2">{{ ++$key .'.' }}</p> <p class="" > {{$file}}</p>
                    </div>
                    @endforeach
                </div>

            </div>
            
        </div>
    </div>
@stop

@push('scripts')
    {{-- <script>
        $('#btn-add-new').click(function (e) {
            e.preventDefault();
            var filename = window.prompt('Enter file name');

            DynamicForm.create(route('river.template-assets.store'), "POST")
                .addField("filename", filename)
                .addCsrf()
                .submit();
        })
    </script> --}}
@endpush
