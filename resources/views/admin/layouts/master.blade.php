<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>@if(isset($title)){{ $title }} - @endif {{river_settings('name')}}</title>

    <!-- CSS files -->
    <link rel="stylesheet" type="text/css" href="/river/admin/dist/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/iconfont/tabler-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link href="/river/admin/dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="/river/admin/dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="/river/admin/dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="/river/admin/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="/river/admin/dist/css/demo.min.css" rel="stylesheet"/>

    @routes

    @yield('css')

</head>
<body class="layout-fluid">
<div class="page">

    @include('river::admin.layouts.sidebar')

    @include('river::admin.layouts.navbar')

    <div class="page-wrapper">
        <div class="container-xl">
            <div class="page-header d-print-none">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            {{ $title ?? '' }}
                        </h2>
                        @isset($_top_buttons)
                            @foreach($_top_buttons as $button)
                                <a href="{{$button[1]}}"
                                   class="{{$button[2] ?? 'btn btn-primary'}} mt-2"
                                   id="{{$button[3] ?? ''}}" id>{{$button[0]}}</a>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            @yield('content')
        </div>
        @include('river::admin.layouts.footer')
    </div>
    <input type="hidden" name="current_route_name" value="{{\Request::route()->getName()}}">
</div>

<!-- Libs JS -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
<script src="/river/admin/dist/libs/apexcharts/dist/apexcharts.min.js" defer></script>
<script src="/river/admin/dist/libs/jsvectormap/dist/js/jsvectormap.min.js" defer></script>
<script src="/river/admin/dist/libs/jsvectormap/dist/maps/world.js" defer></script>
<script src="/river/admin/dist/libs/jsvectormap/dist/maps/world-merc.js" defer></script>
<script src="/river/admin/dist/js/toastr.min.js"></script>
<!-- Tabler Core -->
<script src="/river/admin/dist/js/tabler.min.js" defer></script>
<script src="/river/admin/dist/js/demo.min.js" defer></script>

@stack('scripts')

<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": 300,
        "hideDuration": 1000,
        "timeOut": 5000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>


@if (Session::has('warning'))
    <script>
        toastr.warning("{{ Session::get('warning') }}", 'Warning');
    </script>
@endif

@if (Session::has('message'))
    <script>
        toastr.info("{{ Session::get('message') }}", 'Info');
    </script>
@endif

@if (Session::has('success'))
    <script>
        toastr.success("{{ Session::get('success') }}", 'Success');
    </script>
@endif

@if (Session::has('error'))
    <script>
        toastr.error("{{ Session::get('error') }}", 'Error');
    </script>
@endif

<script>
    // add csrf token to ajax request
    $.ajaxSetup({
        headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

</script>

<script>
    @if($errors->any())
    @foreach($errors->all() as $error)
    toastr.error('{{$error}}', 'Error', {
        closeButton:true,
        progressBar:true,
    });
    @endforeach
    @endif
</script>

</body>
</html>
