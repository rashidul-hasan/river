@extends('admin.layouts.master')
@section('setup_configurations') active pcoded-trigger @stop
@section('content')
    <div class="pcoded-content">
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h5>Shipping Method</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class=" breadcrumb breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="https://demo.dashboardpack.com/admindek-html/index.html"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">Dashboard</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Genarel</h4>
                                        <form class="custom-validation" action="{{route('store-settings')}}" method="POST" >
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-md-4">Inside Dhaka Shipping</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="inside_ship_amount" value="{{$settings['inside_ship_amount'] ?? ''}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Outsite Dhaka Shipping</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="outside_ship_amount" value="{{$settings['outside_ship_amount'] ?? ''}}">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0 float-right">
                                                <div class="col-md-8">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>
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

@push('scripts')

@endpush
