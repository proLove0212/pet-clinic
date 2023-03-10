
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
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->


    <!--====== PRELOADER PART START ======-->

    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== PRELOADER PART ENDS ======-->

    <!--====== HEADER PART START ======-->
    <section class="header_area">
        <div class="navbar-area bg-white">
            <div class="container relative">
                <div class="row items-center">
                    <div class="w-full">
                        <nav class="flex items-center justify-between py-4 navbar navbar-expand-lg">
                            <a class="navbar-brand mr-5 flex items-center " href="{{url('/')}}" >
                                <img src="{{url('assets/images/logo.png')}}" style="width: 50px; height: 50px" alt="Logo">
                                <p class="font-black sm:text-mdium md:text-mdium lg:text-2xl text-black">Web顧客情報検索</p>
                            </a>
                            <button class="block navbar-toggler focus:outline-none lg:hidden" type="button" data-toggle="collapse" data-target="#navbarOne" aria-controls="navbarOne" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <div class="absolute left-0 z-20 w-full px-5 py-3 duration-300 bg-white lg:w-auto  navbar-collapse lg:block top-full mt-full lg:static lg:bg-transparent " id="navbarOne">
                                <ul id="nav" class="items-center content-start mr-auto lg:justify-end navbar-nav lg:flex">
                                    @if ($auth['role'] == 'admin')
                                        <li class="nav-item ml-5 lg:ml-11">
                                            <a class="page-scroll active" href="{{url('petcrew/admin')}}">ユーザー管理</a>
                                        </li>
                                        <li class="nav-item ml-5 lg:ml-11">
                                            <a class="page-scroll" href="#about">メール連絡</a>
                                        </li>
                                        <li class="nav-item ml-5 lg:ml-11">
                                            <a class="page-scroll" href="#services">メンテナンス</a>
                                        </li>
                                    @else
                                        <li class="nav-item ml-5 lg:ml-11">
                                            <a class="page-scroll" href="#work">Projects</a>
                                        </li>
                                        <li class="nav-item ml-5 lg:ml-11">
                                            <a class="page-scroll" href="#pricing">Pricing</a>
                                        </li>
                                        <li class="nav-item ml-5 lg:ml-11">
                                            <a class="page-scroll" href="#blog">Blog</a>
                                        </li>
                                        <li class="nav-item ml-5 lg:ml-11">
                                            <a class="page-scroll" href="#contact">Contact</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- header navbar -->

    </section>

    <!--====== HEADER PART ENDS ======-->

    <!--====== ABOUT PART START ======-->

    <section style="min-height: calc(100vh - 82px); padding-top:100px" class="bg-gray-100">
        <div class="container">
            @yield('content')
        </div>
    </section>

    <!--====== ABOUT PART ENDS ======-->

    <!--====== FOOTER PART START ======-->

    <footer id="footer" class="footer_area bg-black relative z-10">
        <div class="shape absolute left-0 top-0 opacity-5 h-full overflow-hidden w-1/3">
            <img src="{{url('assets/images/footer-shape-left.png')}}" alt="">
        </div>
        <div class="shape absolute right-0 top-0 opacity-5 h-full overflow-hidden w-1/3">
            <img src="{{url('assets/images/footer-shape-right.png')}}" alt="">
        </div>
        <div class="container">
            <div class="footer_copyright pt-3 pb-6 border-t-2 border-solid border-white border-opacity-10 sm:flex justify-between">
                <div class="footer_social pt-4 mx-3 text-center">
                    <ul class="social flex justify-center sm:justify-start">
                        <li class="mr-3"><a href="https://facebook.com/uideckHQ"><i class="lni lni-facebook-filled"></i></a></li>
                        <li class="mr-3"><a href="https://twitter.com/uideckHQ"><i class="lni lni-twitter-filled"></i></a></li>
                        <li class="mr-3"><a href="https://instagram.com/uideckHQ"><i class="lni lni-instagram-original"></i></a></li>
                        <li class="mr-3"><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
                    </ul>
                </div> <!-- footer social -->
            </div> <!-- footer copyright -->
        </div> <!-- container -->
    </footer>

    <!--====== FOOTER PART ENDS ======-->

    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="scroll-top"><i class="lni lni-chevron-up"></i></a>


    <!--====== PART ENDS ======-->

    <!--====== Wow js ======-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    @yield('javascript')
</body>

</html>

