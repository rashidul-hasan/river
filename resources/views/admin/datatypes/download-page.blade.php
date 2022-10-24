@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
@stop

@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-7">
                <div class="card">
                    <div class="list-group list-group-flush list-group-hoverable">
                        @foreach($all as $a)
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col text-truncate">
                                        <a href="#" class="text-reset d-block mb-1" style="font-size: 15px;font-weight: 500!important;">{{$a->singular}}</a>
                                        <div class="d-block text-muted text-truncate mt-n1">
                                            <a href="{{route('river.download.item',[$a->id,'controller'])}}" class="btn btn-info btn-square btn-sm">Controller</a>
                                            <a href="{{route('river.download.item',[$a->id,'model'])}}" class="btn btn-success btn-square btn-sm">Model</a>
                                            <a href="{{route('river.download.item',[$a->id,'migration'])}}" class="btn btn-primary btn-square btn-sm">Migration</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $('#btn-add-new').click(function (e) {
            e.preventDefault();
            var filename = window.prompt('Enter name');

            if (filename) {
                DynamicForm.create(route('river.datatypes.store'), "POST")
                    .addField("name", filename)
                    .addCsrf()
                    .submit();
            }
        });

        $('.confirm-delete').click(function (e) {
            var $this = $(this);
            e.preventDefault();
            if (confirm('Are you sure you want to delete this item?')) {
                DynamicForm.create($this.attr('href'), "DELETE")
                    .addCsrf()
                    .submit();
            }
        });
    </script>
@endpush
