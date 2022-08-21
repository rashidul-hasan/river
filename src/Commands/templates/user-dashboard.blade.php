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
                                        @include('_cache.user-sidebar', ['active' => 'dashboard'])
                                    </div>

                                    <div class="col-12 col-lg-9 mt-4 mt-lg-0">
                                        <section id="team" class="team section-bg">
                                            <div class="member">
                                                <h4>{{Auth::guard('customers')->user()->name}}</h4>
                                                <span>{{Auth::guard('customers')->user()->email}}</span>
                                                <p>
                                                    {{Auth::guard('customers')->user()->phone}}
                                                </p>
                                                <div class="social">
                                                    <a href=""><i class="bi bi-twitter"></i></a>
                                                    <a href=""><i class="bi bi-facebook"></i></a>
                                                    <a href=""><i class="bi bi-instagram"></i></a>
                                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                                </div>
                                            </div>
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
