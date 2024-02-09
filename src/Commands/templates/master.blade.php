<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@if(isset($title)){{ $title }} - @endif {{river_settings('name')}}</title>
    <meta content="@isset($meta_desc){{ $meta_desc }}@endisset" name="description">
    <meta content="@isset($meta_keywords){{ $meta_keywords }}@endisset" name="keywords">

    <!-- Favicons -->
    <link href="{{river_settings('favicon')}}" rel="icon">
    <link href="{{river_settings('favicon')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/carousel/">

    <!-- Vendor CSS Files -->
    {{-- <link href="/river/site/vendor/animate.css/animate.min.css" rel="stylesheet"> --}}
    <link href="/river/site/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="/river/site/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/river/site/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/river/site/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/river/site/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="/river/site/css/style.css" rel="stylesheet">

</head> --}}
<link href="/river/site/css/carousel.css" rel="stylesheet">
<style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>



<body>

@include('_cache.header')


@yield('content')


@include('_cache.footer')

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="/river/site/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
{{-- <script src="/river/site/vendor/glightbox/js/glightbox.min.js"></script>
<script src="/river/site/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="/river/site/vendor/swiper/swiper-bundle.min.js"></script> --}}
{{--<script src="/river/site/vendor/php-email-form/validate.js"></script>--}}

<!-- Template Main JS File -->
<script src="/river/site/js/main.js"></script>

</body>

</html>
