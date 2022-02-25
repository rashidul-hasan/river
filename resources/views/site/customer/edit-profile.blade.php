
@extends('site.layouts.master')

@section('title', 'My Profile')

@section('css')

@stop

@section('main')
   <div class="site__body">
      <div class="page-header">
         <div class="page-header__container container">
            <div class="page-header__title"><h1>Edit Profile</h1></div>
         </div>
      </div>
      <div class="block">
         <div class="container">
            <div class="row">
               <div class="col-12 col-lg-3 d-flex">
                  @include('site.user-dashboard.sidebar', ['active' => 'edit-profile'])
               </div>
               <div class="col-12 col-lg-9 mt-4 mt-lg-0">
                  @if ($errors->any())
                     <div class="alert alert-danger alert-dismissible">
                        {{$errors->first()}}
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
                     <div class="card-header"><h5>Edit Profile</h5></div>
                     <div class="card-divider"></div>
                     <div class="card-body">
                        <div class="row no-gutters">
                           <div class="col-12 col-lg-7 col-xl-6">
                              <form method="POST" action="{{ route('customer.update') }}" class="form-horizontal form-material">
                                 @csrf
                              <div class="form-group"><label for="profile-first-name">Full Name</label>
                                 <input type="text" class="form-control" id="profile-first-name" value="{{ old('name', $user->name) }}" name="name"/></div>
                              <div class="form-group"><label for="profile-email">Email Address</label>
                                 <input type="email" class="form-control" id="profile-email" name="email" value="{{ old('email', $user->email) }}" /></div>
                              <div class="form-group"><label for="profile-phone">Phone Number</label>
                                 <input type="text" class="form-control" id="profile-phone"  name="phone" value="{{ old('name', $user->phone) }}" /></div>
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
