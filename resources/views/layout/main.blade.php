
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

    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="{{url('assets/fonts/lineicons/font-css/LineIcons.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!--====== Tailwind CSS ======-->


    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="{{url('assets/css/tailwindcss.css')}}">
    <!--====== Tailwind CSS ======-->


    {{-- <link rel="stylesheet" href="{{url('build/assets/app.b8183d17.css')}}"> --}}

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link rel="stylesheet" href="{{url('assets/css/custom.css')}}">

    @yield('stylesheet')

</head>

<body class="relative">
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->


    <!--====== PRELOADER PART START ======-->


    <!--====== PRELOADER PART ENDS ======-->

    <!--====== HEADER PART START ======-->
    <section class="header_area">
        <div class="navbar-area bg-white">
            <div class="relative">
                <div class="row items-center">
                    <div class="w-full">
                       <nav class="flex items-center justify-between  shadow px-3">
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

                            <div class="z-20 hidden md:block flex-grow px-5 py-3 duration-300 bg-none" id="navbarOne">
                                <ul id="nav" class="font-black items-center content-start mr-auto justify-end navbar-nav flex">
                                    @if (Auth::user()&&Auth::user()->ClinicName)
                                        <li class="nav-item ml-5 lg:ml-11">
                                            <a class="page-scroll {{ (Request::is('petcrew/search') || Request::is('petcrew/customer/info/*') )? 'active font-black' : ''}}" href="{{route('user.search')}}">顧客検索</a>
                                        </li>
                                        <li class="nav-item ml-5 lg:ml-11">
                                            <a class="page-scroll {{Request::is('petcrew/upload') ? 'active font-black' : ''}}" href="{{url('petcrew/upload')}}">アップロード</a>
                                        </li>
                                        <li class="nav-item ml-5 lg:ml-11">
                                            <a class="page-scroll {{Request::is('petcrew/account') ? 'active font-black' : ''}} cursor-pointer"  data-dropdown-toggle="dropdownInformation" >
                                                <span class="material-symbols-outlined">
                                                    account_circle
                                                </span>
                                            </a>
                                        </li>

                                    @else
                                        <li class="nav-item ml-5 lg:ml-11">
                                            <a class="page-scroll {{(Request::is('petcrew/admin_page') || Request::is('petcrew/admin_page/users/*')) ? 'active font-black' : ''}}" href="{{route('admin.users')}}">ユーザー管理</a>
                                        </li>
                                        <li class="nav-item ml-5 lg:ml-11">
                                            <a class="page-scroll {{Request::is('petcrew/admin_page/contact') ? 'active font-black' : ''}}" href="{{url('petcrew/admin_page/contact')}}">メール連絡</a>
                                        </li>
                                        <li class="nav-item ml-5 lg:ml-11">
                                            <a class="page-scroll {{Request::is('petcrew/admin_page/maintain') ? 'active font-black' : ''}}" href="{{url('petcrew/admin_page/maintain')}}">メンテナンス</a>
                                        </li>
                                        <li class="nav-item ml-5 lg:ml-11">
                                            <a class="page-scroll {{Request::is('petcrew/admin_page/account') ? 'active font-black' : ''}} cursor-pointer"  data-dropdown-toggle="dropdownInformation" >
                                                <span class="material-symbols-outlined">
                                                    account_circle
                                                </span>
                                            </a>
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
            @if (Auth::user()&&Auth::user()->ClinicName)
                <div class="font-black text-sm mb-2">{{Auth::user()->ClinicName}}</div>
                <div class="font-medium text-sm truncate">{{Auth::user()->email}}</div>
            @else
                <div>{{Auth::user()->name}}</div>
                <div class="font-medium truncate">{{Auth::user()->email}}</div>

            @endif
        </div>
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownInformationButton">
            @if (Auth::user()&&Auth::user()->ClinicName)
                <li>
                    <a href="{{route('user.account')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">アカウント管理</a>
                </li>
            @else
                <li>
                    <a href="{{route('admin.account')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">アカウント管理</a>
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
    <div id="drawer-right-example" class="fixed top-0 right-0 z-50 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-right-label">
        <a class="navbar-brand mr-5 flex items-center mb-10"  >
            <img src="{{url('assets/images/logo.png')}}" style="width: 50px; height: 50px" alt="Logo">
            <p class="font-black text-xl text-black">Web顧客情報検索</p>
        </a>
        <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Close menu</span>
        </button>

        <p class="mb-3 px-3 font-black text-xl">
            @if (Auth::user()&&Auth::user()->ClinicName)
                <div>{{Auth::user()->ClinicName}}</div>
            @else
                <div>{{Auth::user()->name}}</div>
            @endif
        </p>

        <p class="mb-3 px-3 font-black text-xl">
            {{Auth::user()->email}}
        </p>

        <hr class="my-6 h-0.5 border-t-0 bg-neutral-200 opacity-100 dark:opacity-30" />

        @if (Auth::user()&&Auth::user()->ClinicName)
            <p class="mb-3 px-3 font-black text-xl">
                <a class="page-scroll {{(Request::is('petcrew/search') || Request::is('petcrew/customer/info/*') ) ? 'active font-black' : ''}}" href="{{route('user.search')}}">顧客検索</a>
            </p>

            <p class="mb-3 px-3 font-black text-xl">
                <a class="page-scroll {{Request::is('petcrew/upload') ? 'active font-black' : ''}}" href="{{url('petcrew/upload')}}">アップロード</a>
            </p>
        @else
            <p class="mb-3 px-3 font-black text-xl">
                <a class="page-scroll {{(Request::is('petcrew/admin_page') || Request::is('petcrew/admin_page/users/*')) ? 'active font-black' : ''}}" href="{{route('admin.users')}}">ユーザー管理</a>
            </p>

            <p class="mb-3 px-3 font-black text-xl">
                <a class="page-scroll {{Request::is('petcrew/admin_page/contact') ? 'active font-black' : ''}}" href="{{url('petcrew/admin_page/contact')}}">メール連絡</a>
            </p>

            <p class="mb-3 px-3 font-black text-xl">
                <a class="page-scroll {{Request::is('petcrew/admin_page/maintain') ? 'active font-black' : ''}}" href="{{url('petcrew/admin_page/maintain')}}">メンテナンス</a>
            </p>
        @endif


        <p class="mb-3 px-3 font-black text-xl">
            @if (Auth::user()&&Auth::user()->ClinicName)
                <a class="page-scroll {{Request::is('petcrew/account') ? 'active font-black' : ''}}" href="{{route('user.account')}}">アカウント管理</a>
            @else
                <a class="page-scroll {{Request::is('petcrew/admin_page/account') ? 'active font-black' : ''}}" href="{{route('admin.account')}}">アカウント管理</a>
            @endif
        </p>

        <hr class="my-6 h-0.5 border-t-0 bg-neutral-200 opacity-100 dark:opacity-30" />

        <form action="{{url('/logout')}}" method="post" class="mb-3 px-3 font-black text-xl">
            @csrf
            <button type="submit" class="font-black  text-xl">ログアウト</button>
        </form>

    </div>
    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="scroll-top">
        <img class="object-cover object-center w-full h-full rounded-full" src="https://img.icons8.com/3d-fluency/1x/up.png"/>

    </a>


    <div class="preloader">
       <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            width="24px" height="30px" viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;" xml:space="preserve">
            <rect x="0" y="13" width="4" height="5" fill="#333">
            <animate attributeName="height" attributeType="XML"
                values="5;21;5"
                begin="0s" dur="0.6s" repeatCount="indefinite" />
            <animate attributeName="y" attributeType="XML"
                values="13; 5; 13"
                begin="0s" dur="0.6s" repeatCount="indefinite" />
            </rect>
            <rect x="10" y="13" width="4" height="5" fill="#333">
            <animate attributeName="height" attributeType="XML"
                values="5;21;5"
                begin="0.15s" dur="0.6s" repeatCount="indefinite" />
            <animate attributeName="y" attributeType="XML"
                values="13; 5; 13"
                begin="0.15s" dur="0.6s" repeatCount="indefinite" />
            </rect>
            <rect x="20" y="13" width="4" height="5" fill="#333">
            <animate attributeName="height" attributeType="XML"
                values="5;21;5"
                begin="0.3s" dur="0.6s" repeatCount="indefinite" />
            <animate attributeName="y" attributeType="XML"
                values="13; 5; 13"
                begin="0.3s" dur="0.6s" repeatCount="indefinite" />
            </rect>
        </svg>
    </div>

    <!--====== PART ENDS ======-->
    <script src="{{url('assets/js/main.js')}}"></script>
    <!--====== Wow js ======-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


    {{-- <script src="{{url('build/assets/app.b0b9c393.js')}}"></script> --}}

    @yield('javascript')
</body>

</html>

