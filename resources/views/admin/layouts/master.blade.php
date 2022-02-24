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

                @yield('content')

            </div>
        </div>

    </div>
</div>
<input type="hidden" name="current_route_name" value="{{\Request::route()->getName()}}">
@include('river::admin.layouts.bottom')

@stack('scripts')

</body>
</html>
