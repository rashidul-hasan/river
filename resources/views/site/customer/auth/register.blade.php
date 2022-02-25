@extends('site.layouts.master')

@section('title', 'Register')

@section('main')
    <div class="site__body">
        <div class="page-header">
            <div class="page-header__container container">
                <div class="page-header__breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Home</a>
                                <svg class="menu__item-arrow" width="6px" height="9px">
                                    <path d="M.4 8.8c-.4-.4-.5-1-.1-1.4l3-2.9-3-2.9C-.1 1.2-.1.5.4.2c.4-.3.9-.3 1.3.1L6 4.5 1.6 8.7c-.3.4-.9.4-1.2.1z" />
                                </svg>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">My Account</a>
                                <svg class="menu__item-arrow" width="6px" height="9px">
                                    <path d="M.4 8.8c-.4-.4-.5-1-.1-1.4l3-2.9-3-2.9C-.1 1.2-.1.5.4.2c.4-.3.9-.3 1.3.1L6 4.5 1.6 8.7c-.3.4-.9.4-1.2.1z" />
                                </svg>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Login</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3 d-flex flex-column mt-4 mt-md-0">
                        <div class="card flex-grow-1 mb-0">
                            <div class="card-body">
                                <h3 class="card-title">Register</h3>
                                @include('site.auth.alert')
                                <form action="{{route('register')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required>
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required/>
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="phone"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required/>
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4">Register</button>
                                </form>
                                <hr>
                                <div class="text-center">
                                   <span>Already have an account?
                                   </span> <a href="">Login Here!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')

@stop
