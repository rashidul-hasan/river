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
                                    <td>SL. </td>
                                    <td> Question</td>
                                    <td> Answer</td>
                                    <td> sort_order</td>
                                    <td> Type</td>
                                    <td> is Active</td>
                                    <td> Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($all as $key=>$a)
                            <tr>
                                <td>{{ ++$key }} </td>
                                <td>{{ $a->question }} </td>
                                <td> {{$a->answer  }}</td>
                                <td> {{$a->sort_order  }}</td>
                                <td> {{$a->type  }}</td>
                                <td>{{ ($a->is_active==1)? 'Active':'Inactive' }} </td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                        <div>
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('river.faq.edit',$a->id) }}"> Edit</a>
                                        </div>
                                        <div class="mx-1">
                                            <form method="POST" action={{ route('river.faq.destroy',$a->id)}}>
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-sm btn-danger"> Delete </button>
                                            </form>
                                        </div>
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
            var filename = window.prompt('Enter Question');

            if (filename) {
                DynamicForm.create(route('river.faq.store'), "POST")
                    .addField("question", filename)
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
