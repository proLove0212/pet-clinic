
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

    @vite(['resources/css/app.css','resources/js/app.js'])

    {{-- <link rel="stylesheet" href="{{url('build/assets/app.b8183d17.css')}}"> --}}

    <link rel="stylesheet" href="{{url('assets/css/custom.css')}}">

    @yield('stylesheet')


</head>

<body>

    @yield('content')


    <!-- BUY ME A BEER AND HELP SUPPORT OPEN-SOURCE RESOURCES -->
    <div class="flex items-end justify-end fixed bottom-0 right-0 mb-4 mr-4 z-10">
        <div>
            <a title="PetClinic" href="{{url('/')}}"  class="block w-16 h-16 rounded-full transition-all shadow hover:shadow-lg transform hover:scale-110 hover:rotate-12">
                <img class="object-cover object-center w-full h-full rounded-full" src="https://img.icons8.com/3d-fluency/1x/home.png"/>
            </a>
        </div>
    </div>


   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

   {{-- <script src="{{url('build/assets/app.b0b9c393.js')}}"></script> --}}

    @yield('javascript')
</body>

</html>

