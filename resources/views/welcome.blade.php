
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
    <!--====== Tailwind CSS ======-->

    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="{{url('assets/css/tailwindcss.css')}}">
    <!--====== Tailwind CSS ======-->


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
                                <p class="font-black text-2xl text-black">Web顧客情報検索</p>
                            </a>
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- header navbar -->

        <div id="home" class="header_hero bg-gray relative z-10 overflow-hidden lg:flex items-center">
            <div class="hero_shape shape_1">
                <img src="{{url('assets/images/shape/shape-1.svg')}}" alt="shape">
            </div><!-- hero shape -->
            <div class="hero_shape shape_2">
                <img src="{{url('assets/images/shape/shape-2.svg')}}" alt="shape">
            </div><!-- hero shape -->
            <div class="hero_shape shape_3">
                <img src="{{url('assets/images/shape/shape-3.svg')}}" alt="shape">
            </div><!-- hero shape -->
            <div class="hero_shape shape_4">
                <img src="{{url('assets/images/shape/shape-4.svg')}}" alt="shape">
            </div><!-- hero shape -->
            <div class="hero_shape shape_6">
                <img src="{{url('assets/images/shape/shape-1.svg')}}" alt="shape">
            </div><!-- hero shape -->
            <div class="hero_shape shape_7">
                <img src="{{url('assets/images/shape/shape-4.svg')}}" alt="shape">
            </div><!-- hero shape -->
            <div class="hero_shape shape_8">
                <img src="{{url('assets/images/shape/shape-3.svg')}}" alt="shape">
            </div><!-- hero shape -->
            <div class="hero_shape shape_9">
                <img src="{{url('assets/images/shape/shape-2.svg')}}" alt="shape">
            </div><!-- hero shape -->
            <div class="hero_shape shape_10">
                <img src="{{url('assets/images/shape/shape-4.svg')}}" alt="shape">
            </div><!-- hero shape -->
            <div class="hero_shape shape_11">
                <img src="{{url('assets/images/shape/shape-1.svg')}}" alt="shape">
            </div><!-- hero shape -->
            <div class="hero_shape shape_12">
                <img src="{{url('assets/images/shape/shape-2.svg')}}" alt="shape">
            </div><!-- hero shape -->

            <div class="container">
                <div class="row">
                    <div class="w-full lg:w-1/2">
                        <div class="header_hero_content pt-150 lg:pt-0">
                            <h2 class="hero_title text-2xl sm:text-4xl md:text-5xl lg:text-4xl xl:text-5xl font-extrabold">Web顧客情報検索</h2>
                            <p class="mt-8 lg:mr-8">
                                夜間や病院の休診日など、病院への電話を携帯電話に転送して応対している病院様向けに、外出先でも簡単な顧客情報が検索・確認できるWeb顧客情報検索サービスです。

                                これにより、外出先においてもWeb接続が可能な携帯端末(iPhoneやAndroidなどのスマートフォン)やタブレットPC、ノートPCなどがあればどこでもアクセス可能です。

                                利用できる端末：
                                携帯電話（iPhoneやAndroidなどのスマートホン）、タブレット、ノートPCなど、インターネットに接続できる端末から利用可能
                            </p>
                            <div class="hero_btn mt-10">
                                <a class="main-btn" href="{{url('/petcrew/login')}}">	ログイン</a>
                            </div>
                        </div> <!-- header hero content -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
            <div class="header_shape hidden lg:block"></div>

            <div class="header_image flex items-center">
                <div class="image 2xl:pl-25">
                    <img src="{{url('assets/images/header-image.svg')}}" alt="Header Image">
                </div>
            </div> <!-- header image -->
        </div> <!-- header hero -->
    </section>

    <!--====== HEADER PART ENDS ======-->

    <!--====== ABOUT PART START ======-->

    <section id="why" class="about_area pt-120 relative">
        <div class="about_image flex items-end justify-end">
            <div class="image lg:pr-13">
                <img src="{{url('assets/images/about.svg')}}" alt="about">
            </div>
        </div> <!-- about image -->
        <div class="container">
            <div class="row justify-end">
                <div class="w-full lg:w-1/2">
                    <div class="about_content mx-4 pt-11 lg:pt-15 lg:pb-15">
                        <div class="section_title pb-9">
                            <h4 class="main_title">SSLによる通信</h4>
                        </div> <!-- section title -->
                        <ul class="about_list pt-3">
                            <li class="flex mt-5">
                                <div class="about_check">
                                    <i class="lni lni-checkmark-circle"></i>
                                </div>
                                <div class="about_list_content pl-5 pr-2">
                                    <p>このサービス内の通信は全てSSLという通信方式によって行われています。</p>
                                </div>
                            </li>
                            <li class="flex mt-5">
                                <div class="about_check">
                                    <i class="lni lni-checkmark-circle"></i>
                                </div>
                                <div class="about_list_content pl-5 pr-2">
                                    <p>SSLとはインターネット上で情報を暗号化して送受信できる仕組みで、ネットワーク上に流れる通信を暗号化しているため、個人情報などの大切なデータを安全にやりとりできます。</p>
                                </div>
                            </li>
                        </ul>
                    </div> <!-- about content -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
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

    <script src="{{url('assets/js/main.js')}}"></script>
</body>

</html>
