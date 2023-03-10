
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

    <link rel="stylesheet" href="{{url('assets/css/custom.css')}}">

    @yield('stylesheet')

    {{-- @vite(['resources/css/app.css']) --}}
</head>

<body>
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

    <!--====== PRELOADER PART ENDS ======-->

    <!--====== HEADER PART START ======-->
    <section class="header_area">
        <div class="navbar-area bg-white">
            <div class="px-3 relative">
                <div class="row items-center">
                    <div class="w-full">
                        <nav class="flex items-center justify-between">
                            <a class="navbar-brand mr-5 flex items-center " href="{{url('/')}}" >
                                <img src="{{url('assets/images/logo.png')}}" style="width: 50px; height: 50px" alt="Logo">
                                <p class="font-black sm:text-mdium md:text-mdium lg:text-2xl text-black">Web顧客情報検索</p>
                            </a>
                            <button class="block md:hidden  navbar-toggler focus:outline-none" type="button"
                                data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example" data-drawer-placement="right" aria-controls="drawer-right-example">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <div class="hidden px-5 py-3 duration-300 bg-white md:block top-full mt-full ">
                                <ul id="nav" class="items-center content-start mr-auto justify-end navbar-nav flex">
                                    @if ($auth['role'] == 'admin')
                                        <li class="nav-item ml-5 lg:ml-11">
                                            <a class="page-scroll {{(Request::is('petcrew/admin') || Request::is('petcrew/admin/users/*')) ? 'active font-black' : ''}}" href="{{url('petcrew/admin')}}">ユーザー管理</a>
                                        </li>
                                        <li class="nav-item ml-5 lg:ml-11">
                                            <a class="page-scroll {{Request::is('petcrew/admin/contact') ? 'active font-black' : ''}}" href="{{url('petcrew/admin/contact')}}">メール連絡</a>
                                        </li>
                                        <li class="nav-item ml-5 lg:ml-11">
                                            <a class="page-scroll {{Request::is('petcrew/admin/maintain') ? 'active font-black' : ''}}" href="{{url('petcrew/admin/maintain')}}">メンテナンス</a>
                                        </li>
                                        <li class="nav-item ml-5 lg:ml-11">
                                            <a class="page-scroll {{Request::is('petcrew/admin/account') ? 'active font-black' : ''}} cursor-pointer"  data-dropdown-toggle="dropdownInformation" >
                                                <span class="material-symbols-outlined">
                                                    account_circle
                                                </span>
                                            </a>
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

    <div id="dropdownInformation" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
            @if ($auth['role'] == 'admin')
                <div>{{$auth['name']}}</div>
                <div class="font-medium truncate">{{$auth['email']}}</div>
            @else

            @endif
        </div>
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownInformationButton">
            @if ($auth['role'] == 'admin')
                <li>
                    <a href="{{url('/petcrew/admin/account')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">アカウント管理</a>
                </li>
            @else
                <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">アカウント管理</a>
                </li>
            @endif
        </ul>
        <div class="py-2">
            <form action="{{url('/logout')}}" method="post">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">ログアウト</button>
            </form>
        </div>
    </div>
    <!--====== HEADER PART ENDS ======-->

    <!--====== ABOUT PART START ======-->

    <section style="min-height: 100vh; padding-top:100px" class="bg-gray-50">
        <div class="my-inner">
            @yield('content')
        </div>
    </section>

    <!--====== ABOUT PART ENDS ======-->


    <!-- drawer component -->
    <div id="drawer-right-example" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-right-label">
        <a class="navbar-brand mr-5 flex items-center "  >
            <img src="{{url('assets/images/logo.png')}}" style="width: 50px; height: 50px" alt="Logo">
            <p class="font-black sm:text-mdium md:text-mdium lg:text-2xl text-black">Web顧客情報検索</p>
        </a>
        <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Close menu</span>
        </button>
        <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">Supercharge your hiring by taking advantage of our <a href="#" class="text-blue-600 underline dark:text-blue-500 hover:no-underline">limited-time sale</a> for Flowbite Docs + Job Board. Unlimited access to over 190K top-ranked candidates and the #1 design job board.</p>
        <div class="grid grid-cols-2 gap-4">
            <a href="#" class="px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Learn more</a>
            <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Get access <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></a>
        </div>
    </div>
    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="scroll-top"><i class="lni lni-chevron-up"></i></a>


    <!--====== PART ENDS ======-->

    <!--====== Wow js ======-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    @yield('javascript')
</body>

</html>

