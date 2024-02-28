@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('page-header')
    <x:river::header>
            <x-slot:title>
            Edit User
            </x-slot>

            <x-slot:breads>
                <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{route('river.users.index')}}">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Edit User</a></li>
            </x-slot:breads>

            <x-slot:buttons>
                <a href="{{route('river.users.index')}}" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0"/><path d="M5 12l6 6"/><path d="M5 12l6 -6"/></svg>
                    Back
                </a>
            </x-slot:buttons>

    </x:river::header>
@stop

@section('css')

@endsection

@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="col-md-6">
                <div class="card">

                    <div class="card-body">
                        <form action="{{route('river.users.update', $user->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3 ">
                                <label class="form-label required">Name</label>
                                <div>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{$user->name}}">
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <label class="form-label required">Email</label>
                                <div>
                                    <input type="email" class="form-control" placeholder="Enter email" name="email" value="{{$user->email}}">
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
                                        {{-- <option value="" selected disabled>Select</option> --}}

                                            <option value="" selected disabled>Select</option>
                                            <option value="1" @if($user->role_id==1) selected @endif>Developer</option>
                                            <option value="2" @if($user->role_id==2) selected @endif >Site Admin</option>
                                            <option value="3" @if($user->role_id==3) selected @endif >Writer</option>


                                        {{-- @foreach($roles as $role)
                                            <option value="{{$role->id}}" {{$user->role_id == $role->id ? 'selected' : ''}}>{{$role->name}}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="form-group mb-3 ">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_developer" {{$user->is_developer == 1 ? 'checked' : ''}}>
                                    <span class="form-check-label">Developer</span>
                                </label>
                            </div> --}}
                            <div class="form-footer">
                                <button type="submit" class="btn btn-success">Update</button>
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
