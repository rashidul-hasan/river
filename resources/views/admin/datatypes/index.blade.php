@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
@stop

@section('content')
    <div class="row">
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
                                    <a href="{{route('river.datatypes.edit', $a->id)}}">
                                        <i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                    </a>
                                    <a href="{{ route('river.datatypes.destroy', $a->id) }}" class="confirm-delete" data-href="{{ route('river.datatypes.destroy', $a->id) }}">
                                        <i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
