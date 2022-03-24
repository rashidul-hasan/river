@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
@stop

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="list-group">
                @foreach($all as $a)
                <a class="list-group-item" href="{{route('river.datatypes.edit', $a->id)}}">{{$a->name}}</a>
                @endforeach
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $('#btn-add-new').click(function (e) {
            e.preventDefault();
            var filename = window.prompt('Enter name');

            DynamicForm.create(route('river.datatypes.store'), "POST")
                .addField("name", filename)
                .addCsrf()
                .submit();
        })
    </script>
@endpush
