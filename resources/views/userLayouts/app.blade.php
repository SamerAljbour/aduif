<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Aduif</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('user/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/main.css') }}">
    @if(app()->getLocale() === 'ar')
        <link rel="stylesheet" href="{{ asset('user/css/rtl.css') }}">
    @endif
    <!-- script
    ================================================== -->
    <script src="{{ asset('user/js/modernizr.js') }}"></script>
    <script src="{{ asset('user/js/pace.min.js') }}"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="{{ asset('user/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('user/favicon.ico') }}" type="image/x-icon">

</head>

<body id="top">

    <div id="preloader">
        <div id="loader"></div>
    </div>


   @include('layouts.header')

   <main>
        @yield('content')
   </main>

    @include('layouts.footer')

    <!-- Java Script
    ================================================== -->
    <script src="{{ asset('user/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('user/js/plugins.js') }}"></script>
    <script src="{{ asset('user/js/main.js') }}"></script>


</body>

