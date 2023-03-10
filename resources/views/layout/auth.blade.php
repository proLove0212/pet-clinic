
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">

    <!--====== Title ======-->
    <title>Web顧客情報検索 - ペットクルーカルテ</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{url('assets/images/favicon.png')}}" type="image/png">

    <!--====== Animate CSS ======-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!--====== Slick CSS ======-->
    <link rel="stylesheet" href="{{url('assets/css/tiny-slider.css')}}">

    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="{{url('assets/fonts/lineicons/font-css/LineIcons.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!--====== Tailwind CSS ======-->

    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="{{url('assets/css/tailwindcss.css')}}">
    <!--====== Tailwind CSS ======-->

    @vite(['resources/css/app.css','resources/js/app.js'])

    @yield('stylesheet')

    {{-- @vite(['resources/css/app.css']) --}}
</head>

<body>

    @yield('content')

    <!--====== Wow js ======-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    @yield('javascript')
</body>

</html>

