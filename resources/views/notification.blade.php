<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Maintenance Page | Skote - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="{{url('assets/css/bootstrap-dark.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{url('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{url('assets/css/app-dark.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <link href="{{url('assets/css/custom.css')}}" id="custom-style" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <div class="home-btn d-none d-sm-block">
            <a href="{{url('/')}}" class="text-dark"><i class="fas fa-home h2"></i></a>
        </div>

        <section class="my-5 pt-sm-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="home-wrapper">
                            <div class="mb-5">
                                <a href="{{url('/')}}" class="d-block auth-logo">
                                    <img src="{{url('assets/images/logo-dark.png')}}" alt="" height="20" class="auth-logo-dark mx-auto">
                                    <img src="{{url('assets/images/logo-light.png')}}" alt="" height="20" class="auth-logo-light mx-auto">
                                </a>
                            </div>


                            <div class="row justify-content-center">
                                <div class="col-sm-8 col-md-6">
                                    <div class="maintenance-img" style="max-width:500px">
                                        <img src="{{url('assets/images/maintenance.svg')}}" alt="" class="img-fluid mx-auto d-block">
                                    </div>

                                    <h2 class="mt-5 mb-3 card-title text-center" style="font-size:20px">サーバーメンテナンスのお知らせ </h2>

                                    <p class="mb-3" >WEB情報検索サービスは  {{date('Y年 m月 d日', strtotime($from))}} にサーバーのメンテナンスを実施します。</p>
                                    <p class="mb-3" style="max-width:500px">停止に伴い、下記の通り情報検索サービスを一時休止しいたします。お客様にはご不便をおかけいたしまして、誠に申し訳ございませんが、ご了承くださいますようお願い申し上げます。</p>
                                    <p class="mb-3">
                                        ■サービスの休止日時
                                    </p>
                                    <ul>
                                        <li>開始： {{date('Y年 m月 d日 h時 i分', strtotime($from))}}</li>
                                        <li>終了： {{date('Y年 m月 d日 h時 i分', strtotime($to))}}</li>
                                    </ul>

                                    <p class="mb-3">※作業の状況により終了時間が前後することがございますのでご了承下さい</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- JAVASCRIPT -->
        <script src="{{url('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{url('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{url('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{url('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{url('assets/libs/node-waves/waves.min.js')}}"></script>

        <script src="{{url('assets/js/app.js')}}"></script>

    </body>
</html>
