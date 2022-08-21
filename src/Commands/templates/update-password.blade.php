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
                <div class="row">
                    <div class="site__body">
                        <div class="block">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-lg-3">
                                        @include('_cache.user-sidebar', ['active' => 'updatePassword'])
                                    </div>

                                    <div class="col-12 col-lg-9 mt-4 mt-lg-0">
                                        <section id="contact" class="contact">
                                            <form action="{{route('riversite.update.passwordPage')}}" method="post" role="form" class="php-email-form">
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
                                                <div class="form-group">
                                                    <label class="col-md-12" for="new_passwd">Current Password</label>
                                                    <div class="col-md-12">
                                                        <input name="old_password" id="new_passwd" type="password" class="form-control form-control-line" required> </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-12" for="new_passwd">New Password</label>
                                                    <div class="col-md-12">
                                                        <input name="new_password" id="new_passwd" type="password" class="form-control form-control-line" required> </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12" for="confirm_passwd">Confirm Password</label>
                                                    <div class="col-md-12">
                                                        <input name="new_password_confirmation" id="confirm_passwd" type="password" class="form-control form-control-line" required>
                                                    </div>
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
