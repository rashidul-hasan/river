@extends('river::admin.layouts.master')
@section('dashboard') active @endsection

@section('content')
<div class="container-xl">
    <div class="row row-deck row-cards">


        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link " aria-current="page"
                    href=" {{-- route('river.contact-form.update') --}}">General</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('river.Contact-Form-Field') }}">Fields</a>
            </li>
        </ul>

        <div>
            <div>
                <button type="button" class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#addModal">Add
                    Filed</button>
            </div>


            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <td> Contact Form Id</td>
                            <td> Name</td>
                            <td> Slug</td>
                            <td> Type</td>
                            <td> Is Required</td>
                            <td> Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <form>
                            <tr>
                                <td> 1</td>
                                <td> <input type="text" class="form-control" /></td>
                                <td> <input type="text" class="form-control" /></td>
                                <td> <select class="form-select" aria-label="Default select example">
                                        <option selected>Text</option>
                                        <option value="1">Textarea</option>
                                        <option value="2">Email</option>
                                        <option value="3">Phone</option>
                                        <option value="3">Password</option>
                                        <option value="3">Image</option>
                                        <option value="3">Checkbox</option>
                                        <option value="3">select</option>
                                        <option value="3">Phone</option>
                                        <option value="3">Radio</option>
                                        <option value="3">Dropdown</option>
                                        <option value="3">Number</option>
                                        <option value="3">Date</option>
                                        <option value="3">Date time</option>
                                        <option value="3">Phone</option>
                                        <option value="3">Rich text</option>
                                        <option value="3">Belogs to</option>

                                    </select></td>
                                <td> <input class="form-check-input" type="checkbox" name="is_required" value="1"></td>
                                <td>
                                    <form>
                                        <button class="btn btn-sm btn-danger"> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        </form>

                    </tbody>

                </table>

                <button class="btn btn-primary"> Update</button>

            </div>




            <div class="modal fade " id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">

                            <form method="POST" action="">
                                @csrf
                                <div>
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" />
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
</div>
@stop

@push('scripts')

@endpush
