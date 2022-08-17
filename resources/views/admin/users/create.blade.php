@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')

@endsection

@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-6">
                <div class="card">

                    <div class="card-body">
                        <form action="{{route('river.users.store')}}" method="POST">
                            @csrf
                            <div class="form-group mb-3 ">
                                <label class="form-label required">Name</label>
                                <div>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="name">
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <label class="form-label required">Email</label>
                                <div>
                                    <input type="email" class="form-control" placeholder="Enter email" name="email">
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <label class="form-label required">Password</label>
                                <div>
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                    <small class="form-hint">
                                        Your password must be 8-20 characters long, contain letters and numbers, and must not contain
                                        spaces, special characters, or emoji.
                                    </small>
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <label class="form-label">Role</label>
                                <div>
                                    <select class="form-select">
                                        <option>Option 3</option>
                                        <option>Option 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')

@endpush
