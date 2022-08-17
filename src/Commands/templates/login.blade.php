@extends('_cache.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')

@endsection

@section('content')
    <main id="main">
        <section id="contact" class="contact">
            <div class="container">
                <div class="section-title">
                    <h2>Login</h2>
                </div>
                <div class="row">
                    <div class="col-lg-6 offset-lg-3 mt-5 mt-lg-0 d-flex align-items-stretch">
                        <form action="{{route('riversite.login.post')}}" method="post" role="form" class="php-email-form">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible">
                                    {{ $errors->first() }}
                                </div>
                            @endif
                            @if (Session::has('error'))
                                <p class="alert alert-danger text-center" style="width: 100%">{{ Session::get('error') }}</p>
                            @endif
                            <div class="form-group mt-3">
                                <label for="name">Email</label>
                                <input type="text" class="form-control" name="email" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="name">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="mt-3">
                                <button type="submit">Login</button>
                                or <a href="{{route('riversite.register')}}"> New Register </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@stop

@push('scripts')

@endpush
