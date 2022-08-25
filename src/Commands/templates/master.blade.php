<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@if(isset($title)){{ $title }} - @endif {{river_settings('name')}}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{river_settings('favicon')}}" rel="icon">
    <link href="{{river_settings('favicon')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/site/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="/site/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/site/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/site/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/site/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/site/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="/site/css/style.css" rel="stylesheet">
</head>

<body>

@include('_cache.header')


@yield('content')


@include('_cache.footer')

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="/site/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/site/vendor/glightbox/js/glightbox.min.js"></script>
<script src="/site/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="/site/vendor/swiper/swiper-bundle.min.js"></script>
{{--<script src="/site/vendor/php-email-form/validate.js"></script>--}}

<!-- Template Main JS File -->
<script src="/site/js/main.js"></script>

</body>

</html>
