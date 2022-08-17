@extends('_cache.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')

@endsection

@section('content')
    <main id="main">
        <section id="contact" class="contact">
            <div class="container">
                <div class="section-title">
                    <h2>Register</h2>
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
                        <div class="page-header">
                            <div class="page-header__container container">
                                <div class="page-header__title"><h1>Dashboard</h1></div>
                            </div>
                        </div>
                        <div class="block">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-lg-3 d-flex">
                                        @include('_cache.user-sidebar', ['active' => 'dashboard'])
                                    </div>
                                    <div class="col-12 col-lg-9 mt-4 mt-lg-0">
                                        <div class="dashboard">
                                            <div class="dashboard__profile card profile-card">
                                                <div class="card-body profile-card__body">
                                                    <div class="profile-card__avatar"><img src="{{ Auth::guard('customers')->user()->image ? asset( Auth::user()->name) : '/demo/avatar-male.png'}}" alt="" /></div>
                                                    <div class="profile-card__name">{{Auth::guard('customers')->user()->name}}</div>
                                                    <div class="profile-card__email">{{Auth::guard('customers')->user()->email}}</div>
                                                    <div class="profile-card__edit">
                                                        <a href="account-profile.html" class="btn btn-secondary btn-sm">Edit Profile</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dashboard__address card address-card address-card--featured">
                                                <div class="address-card__body">
                                                    <div class="address-card__name">{{Auth::guard('customers')->user()->name}}</div>
                                                    <div class="address-card__row">
                                                        {{Auth::guard('customers')->user()->address}}
                                                    </div>
                                                    <div class="address-card__row">
                                                        <div class="address-card__row-title">Phone Number</div>
                                                        <div class="address-card__row-content">{{Auth::guard('customers')->user()->phone}}</div>
                                                    </div>
                                                    <div class="address-card__row">
                                                        <div class="address-card__row-title">Email Address</div>
                                                        <div class="address-card__row-content">{{Auth::guard('customers')->user()->email}}</div>
                                                    </div>
                                                    <div class="address-card__footer"><a href="account-edit-address.html">Edit Address</a></div>
                                                </div>
                                            </div>
                                        </div>
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
