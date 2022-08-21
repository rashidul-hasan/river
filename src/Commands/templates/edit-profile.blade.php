@extends('_cache.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')

@endsection

@section('content')
    <main id="main">
        <section id="contact" class="contact">
            <div class="container">
                <div class="section-title">
                    <h2>Dashboard</h2>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        {{ $errors->first() }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <p class="alert alert-danger text-center" style="width: 100%">{{ Session::get('error') }}</p>
                @endif
                <div class="row">
                    <div class="site__body">
                        <div class="block">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-lg-3">
                                        @include('_cache.user-sidebar', ['active' => 'editProfile'])
                                    </div>

                                    <div class="col-12 col-lg-9 mt-4 mt-lg-0">
                                        <section id="contact" class="contact">
                                            <form action="{{route('riversite.update.profile')}}" method="post" role="form" class="php-email-form">
                                                @csrf
                                                @if ($errors->any())
                                                    <div class="alert alert-danger alert-dismissible">
                                                        {{ $errors->first() }}
                                                    </div>
                                                @endif
                                                @if (Session::has('error'))
                                                    <p class="alert alert-danger text-center" style="width: 100%">{{ Session::get('error') }}</p>
                                                @endif
                                                @if (session('success'))
                                                    <div class="alert alert-success">
                                                        {{ session('success') }}
                                                    </div>
                                                @endif
                                                <div class="form-group mt-3">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" name="name" value="{{$user->name}}">
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="name">Email</label>
                                                    <input type="email" class="form-control" name="email" value="{{$user->email}}">
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="name">Phone</label>
                                                    <input type="text" class="form-control" name="phone"  value="{{$user->phone}}">
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="name">Address</label>
                                                    <textarea name="address" class="form-control" cols="30" rows="4">{{$user->address}}</textarea>
                                                </div>
                                                <div class="mt-3">
                                                    <button type="submit" >Update</button>
                                                </div>
                                            </form>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@stop

@push('scripts')

@endpush
