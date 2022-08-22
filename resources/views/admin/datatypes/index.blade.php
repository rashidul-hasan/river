@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
@stop

@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Type</th>
                                <th>Slug</th>
                                <th scope="col" style="width: 5%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($all as $a)
                                <tr>
                                    <td>
                                        {{$a->singular}}
                                    </td>
                                    <td>
                                        {{$a->slug}}
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="{{route('river.datatypes.edit', $a->id)}}" class="btn btn-sm btn-info">
                                                Edit
                                            </a>
                                            <a class="btn btn-sm btn-danger confirm-delete" href="{{ route('river.datatypes.destroy', $a->id) }}"
                                               data-href="{{ route('river.datatypes.destroy', $a->id) }}">
                                                Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
