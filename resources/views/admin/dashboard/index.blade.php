@extends('river::admin.layouts.master')
@section('dashboard') active @endsection

@section('content')
<div class="container-xl">
    <div class="row row-deck row-cards">

        <div class="d-flex p-2 ml-2">
            <button type="button" class="btn btn-primary mx-1" data-bs-toggle="modal"
                data-bs-target="#addModal">Add</button>
            <button type="button" class="btn btn-primary mx-1">Export</button>
            <button type="button" class="btn btn-primary mx-1">Import</button>
            <button type="button" class="btn btn-warning mx-1">Download File</button>
        </div>

        <div class="mt-2">

            <table class="table">
                <thead>
                    <tr>
                        <td>SL. </td>
                        <td> Name</td>
                        <td> is Active</td>
                        <td> Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $value as $key=>$a )
                    <tr>
                        <td>{{ ++$key }} </td>
                        <td>{{ $a->name }} </td>
                        <td>{{ ($a->is_active==1)? 'Active':'Inactive' }} </td>
                        <td>
                            <div class="d-flex justify-content-end">
                                <div>
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('river.contact-form.update',$a->id) }}"> Edit</a>
                                </div>
                                <div class="mx-1">
                                    <form method="POST" action={{ route('river.contact-form.destroy', $a->id)}}>
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


        <div class="modal fade " id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">

                        <form method="POST" action={{ route('river.contact-form.store') }}>
                            @csrf
                            <div>
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" />
                            </div>

                            <div>
                                <label class="form-label">Is Active</label>
                                <input type="checkbox" class="form-check-input" name="is_active" value="1">
                            </div>

                            <div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <div>
                                        <input type="submit" value="Save" class="btn btn-primary" />
                                    </div>

                                </div>
                            </div>
                        </form>


                    </div>

                </div>
            </div>
        </div>


    </div>
</div>
@stop

@push('scripts')

@endpush
