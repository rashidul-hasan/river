
@extends('site.layouts.master')

@section('title', 'Update Password')

@section('css')

@stop

@section('main')
   <div class="site__body">
      <div class="page-header">
         <div class="page-header__container container">
            <div class="page-header__title"><h1>Password</h1></div>
         </div>
      </div>
      <div class="block">
         <div class="container">
            <div class="row">
               <div class="col-12 col-lg-3 d-flex">
                  @include('site.user-dashboard.sidebar', ['active' => 'change-password'])
               </div>
               <div class="col-12 col-lg-9 mt-4 mt-lg-0">
                  @if ($errors->any())
                     <div class="alert alert-danger" role="alert">
                        <ul class="list-unstyled">
                           @foreach($errors->all() as $error)
                              <li>{{ $error }}</li>
                           @endforeach
                        </ul>
                     </div>
                  @endif
                  @if (session('success'))
                     <div class="alert alert-success">
                        {{ session('success') }}
                     </div>
                  @endif
                  @if (session('error'))
                     <div class="alert alert-danger">
                        {{ session('error') }}
                     </div>
                  @endif
                  <div class="card">
                     <div class="card-header"><h5>Edit Password</h5></div>
                     <div class="card-divider"></div>
                     <div class="card-body">
                        <div class="row no-gutters">
                           <div class="col-12 col-lg-7 col-xl-6">
                              <form method="POST" action="{{ route('customer.changepass.post') }}" class="form-horizontal form-material">
                                 @csrf
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
                                    <label class="col-md-12" for="confirm_passwd">Confirm New Password</label>
                                    <div class="col-md-12">
                                       <input name="new_password_confirmation" id="confirm_passwd" type="password" class="form-control form-control-line" required>
                                    </div>
                                 </div>
                                 <div class="form-group mt-5 mb-0"><button class="btn btn-primary" type="submit">Save</button></div>
                              </form>
                           </div>
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
