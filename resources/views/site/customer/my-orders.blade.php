
@extends('site.layouts.master')

@section('title', 'My Profile')

@section('css')

@stop

@section('main')
    <div class="site__body">
        <div class="page-header">
            <div class="page-header__container container">
                <div class="page-header__title"><h1>My Orders</h1></div>
            </div>
        </div>
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3 d-flex">
                        @include('site.user-dashboard.sidebar', ['active' => 'my-orders'])
                    </div>
                    <div class="col-12 col-lg-9 mt-4 mt-lg-0">
                        <div class="dashboard">
                            @if($orders->count())
                            @foreach ($orders as $order)
                                <div class="order-container" style="margin-bottom: 30px">
                                    <div class="order-header">
                                        <div class="order-header-items">
                                            <div>
                                                <div class="d-inline-block uppercase font-bold"><b>Order ID:</b></div>
                                                <div class="d-inline-block">{{ $order->order_id }}</div>
                                            </div>
                                            <div>
                                                <div class="d-inline-block uppercase font-bold"><b>Order Placed:</b></div>
                                                <div class="d-inline-block">{{ presentDate($order->created_at) }}</div>
                                            </div>
                                            <div>
                                                <div class="d-inline-block uppercase font-bold"><b>Total:</b></div>
                                                <div class="d-inline-block">{{ presentPrice($order->billing_total) }}</div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="order-header-items">
                                                <div><a href="{{ route('customer.orders.show', $order->id) }}">Views Invoice</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @else
                            <p>No Orders</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')

@stop
