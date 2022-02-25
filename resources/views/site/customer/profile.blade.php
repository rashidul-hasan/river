
@extends('site.layouts.master')

@section('title', 'My Profile')

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
                        <a href="/">Home</a> <svg class="breadcrumb-arrow" width="6px" height="9px"><use xlink:href="images/sprite.svg#arrow-rounded-right-6x9"></use></svg>
                     </li>
<!--                     <li class="breadcrumb-item">
                        <a href="#">Breadcrumb</a> <svg class="breadcrumb-arrow" width="6px" height="9px"><use xlink:href="images/sprite.svg#arrow-rounded-right-6x9"></use></svg>
                     </li>-->
                     <li class="breadcrumb-item active" aria-current="page">My Account</li>
                  </ol>
               </nav>
            </div>
            <div class="page-header__title"><h1>My Account</h1></div>
         </div>
      </div>
      <div class="block">
         <div class="container">
            <div class="row">
               <div class="col-12 col-lg-3 d-flex">
                  @include('site.user-dashboard.sidebar', ['active' => 'profile'])
               </div>
               <div class="col-12 col-lg-9 mt-4 mt-lg-0">
                  <div class="dashboard">
                     <div class="dashboard__profile card profile-card">
                        <div class="card-body profile-card__body">
                           <ul class="">
                              <li class="list-group-item"><strong>Full Name:</strong> <span>{{ Auth::user()->name}}</span></li>
                              <li class="list-group-item"><strong>Email:</strong> <span>{{ Auth::user()->email}}</span></li>
                              <li class="list-group-item"><strong>Phone:</strong> <span>{{ Auth::user()->phone ?? ''}}</span></li>
                           </ul>
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
