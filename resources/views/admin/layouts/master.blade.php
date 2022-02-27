<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <title>@if(isset($title)){{ $title }} - @endif {{river_settings('name')}}</title>
    <link rel="icon" type="image/png" href="{{river_settings('favicon')}}" />

    @include('river::admin.layouts.head')

    @routes

    @yield('css')
</head>

<body>
<div class="loader-bg">
    <div class="loader-bar"></div>
</div>
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        @include('river::admin.layouts.navbar')

        @include('river::admin.layouts.sidebar')

        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                @include('river::admin.layouts.sidebar')

                <div class="pcoded-content">
                    <div class="page-header card">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    <div class="d-inline">
                                        <h5>{{ $title ?? '' }}</h5>
                                    </div>
                                    @isset($_top_buttons)
                                        @foreach($_top_buttons as $button)
                                            <a href="{{$button[1]}}"
                                               class="{{$button[2] ?? 'btn btn-primary'}}"
                                               id="{{$button[3] ?? ''}}" id>{{$button[0]}}</a>
                                        @endforeach
                                    @endisset
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class=" breadcrumb breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('river.admin.dashboard')}}"><i class="feather icon-home"></i></a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="{{route('river.admin.dashboard')}}">Dashboard</a>
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
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<input type="hidden" name="current_route_name" value="{{\Request::route()->getName()}}">
@include('river::admin.layouts.bottom')

@stack('scripts')

</body>
</html>
