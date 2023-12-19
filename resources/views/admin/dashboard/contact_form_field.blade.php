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
                            <td>SL</td>
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
                                <td> <input type="text" name="contactform_id" class="form-control" /></td>
                                <td> <input type="text" name="name" class="form-control" /></td>
                                <td> <input type="text" name="slug" class="form-control" /></td>
                                <td> <select class="form-select" name="type" aria-label="Default select example">
                                        <option value="Text" selected >Text</option>
                                        <option value="Textarea">Textarea</option>
                                        <option value="Email">Email</option>
                                        <option value="Phone">Phone</option>
                                        <option value="Password">Password</option>
                                        <option value="Image">Image</option>
                                        <option value="Checkbox">Checkbox</option>
                                        <option value="select">select</option>
                                        <option value="Phone">Phone</option>
                                        <option value="Radio">Radio</option>
                                        <option value="Dropdown">Dropdown</option>
                                        <option value="Number">Number</option>
                                        <option value="Date">Date</option>
                                        <option value="Date time">Date time</option>
                                        <option value="Phone">Phone</option>
                                        <option value="Rich text">Rich text</option>
                                        <option value="Belogs to">Belogs to</option>

                                    </select>
                                </td>
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

                            <form method="POST" action="{{ route('river.Contact-Form-Field.store') }}">
                                @csrf
                                <div>
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" />
                                </div>

                                <div>""
                                    <input type="hidden" name="contactform_id" value="" />
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
