@extends('site.layouts.master')

@section('title', 'Login')

@section('css')

@stop

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
                    <div class="col-md-6 offset-md-3 d-flex flex-column">
                        <div class="card flex-grow-1 mb-md-0">
                            <div class="card-body">
                                <h3 class="card-title">Login</h3>
                                @if(Session::has('error'))
                                    <p class="alert alert-danger text-center mt-3" style="width: 100%;color: red;">{{ Session::get('error') }}</p>
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
                                <form action="{{route('login')}}" method="POST">
                                    @csrf
                                    <div class="form-group"><label>Email address</label>
                                        <input type="email" class="form-control" name="email" />
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" />
                                        <small class="form-text text-muted"><a href="#">Forgotten Password</a>
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <span class="form-check-input input-check">
                                                <span class="input-check__body">
                                                    <input class="input-check__input" type="checkbox" id="login-remember" /> <span class="input-check__box"></span>
                                                    <svg class="input-check__icon" width="9px" height="7px">
                                                        <path d="M9.002 1.396L3.461 7.002-.002 3.498l1.385-1.402 2.078 2.103L7.617-.006l1.385 1.402z" />
                                                    </svg>
                                                </span>
                                            </span>
                                            <label class="form-check-label" for="login-remember">Remember Me</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4">Login</button>
                                </form>
                                <hr>
                               <div class="text-center">
                                   <span>Don't have an account?
                                   </span> <a href="{{route('register')}}">Register Here!</a>
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
