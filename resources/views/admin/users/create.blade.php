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
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <label class="form-label">Role</label>
                                <div>
                                    <select class="form-select" name="role_id">
                                        <option value="" selected disabled>Select</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_developer">
                                    <span class="form-check-label">Developer</span>
                                </label>
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
