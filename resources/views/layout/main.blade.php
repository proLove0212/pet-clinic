<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>PetClinic | @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{url('assets/images/favicon.ico')}}">

        <!-- Bootstrap Css -->
        <link href="{{url('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{url('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{url('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <link href="{{url('assets/css/custom.css')}}" id="custom-style" rel="stylesheet" type="text/css" />

        @yield('stylesheet')
    </head>

    <body>

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">


            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{url('assets/images/logo.png')}}" alt="" height="40">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{url('assets/images/logo-dark.png')}}" alt="" height="40">
                                </span>
                            </a>

                            <a href="" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{url('assets/images/logo-light.svg')}}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{url('assets/images/logo-light.png')}}" alt="" height="19">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                    </div>

                    <div class="d-flex">
                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                                <i class="bx bx-fullscreen"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{url('assets/images/avatar_m.png')}}"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{$auth['name']}}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                @if ($auth['role'] == "admin")
                                    <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile"> 管理者</span></a>
                                @elseif($auth['role'] == "user")
                                    <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile"> 病院ID {{$auth['ClinicID']}}</span></a>
                                @else
                                    <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile"> 顧客ID {{$auth['CustNo']}}</span></a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <form action="{{url('logout')}}" method="post">
                                    @csrf
                                    <button id="logout" class="d-none"></button>
                                </form>
                                <a class="dropdown-item text-danger" onclick="document.getElementById('logout').click()"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">ログアウト</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            {{-- <li class="menu-title" key="t-menu">Menu</li> --}}

                            @if ($auth['role'] == "admin")
                                <li>
                                    <a href="{{url('/admin/users')}}" class="waves-effect {{ Request::is('admin/users') ? 'active' : '' }}">
                                        <i class="bx bx-group"></i>
                                        <span key="t-users">全ユーザー</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('/admin/users/add')}}" class="waves-effect {{ Request::is('admin/users/add') ? 'active' : '' }}">
                                        <i class="bx bx-user-plus"></i>
                                        <span key="t-add">ユーザー新規追加</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('/admin/mail')}}" class="waves-effect {{ Request::is('admin/mail') ? 'active' : '' }}">
                                        <i class="bx bx-mail-send"></i>
                                        <span key="t-mail">メール連絡</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('/admin/maintain')}}" class="waves-effect {{ Request::is('admin/maintain') ? 'active' : '' }}">
                                        <i class="bx bx-wrench"></i>
                                        <span key="t-maintain_server">メンテナンス</span>
                                    </a>
                                </li>
                            @endif

                            @if ($auth['role'] == "user")
                                <li>
                                    <a href="{{url('/dashboard')}}" class="waves-effect {{ Request::is('customers') ? 'active' : '' }}">
                                        <i class="bx bx-home"></i>
                                        <span key="t-users">管理画面</span>
                                    </a>
                                </li>
                                <li>
                                    <a  class="waves-effect {{ Request::is('search/*') ? 'active' : '' }}">
                                        <i class="bx bx-search-alt"></i>
                                        <span key="t-tables">高度な検索</span>
                                    </a>
                                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                                        <li><a href="{{url('/search/no')}}" key="t-basic-tables" class="{{ Request::is('search/phone') ? 'active' : '' }}" >番号検索</a></li>
                                        <li><a href="{{url('/search/name')}}" key="t-data-tables" class="{{ Request::is('search/name') ? 'active' : '' }}">名前検索</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{url('/upload')}}" class="waves-effect {{ Request::is('upload') ? 'active' : '' }}">
                                        <i class="bx bx-upload"></i>
                                        <span key="t-mail">一括アップロード</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('/reception/settings')}}" class="waves-effect {{ Request::is('reception/settings') ? 'active' : '' }}">
                                        <i class="bx bx-time"></i>
                                        <span key="t-mail">時間帯の設定</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('/reception/reason')}}" class="waves-effect {{ Request::is('reception/reason') ? 'active' : '' }}">
                                        <i class="bx bx-list-check"></i>
                                        <span key="t-mail">来院理由の設定</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">@yield('title')</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">トップページ</a></li>
                                            <li class="breadcrumb-item active">@yield('title')</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


                        @yield('content')
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © PetClinic.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">

                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- JAVASCRIPT -->
        <script src="{{url('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{url('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{url('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{url('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{url('assets/libs/node-waves/waves.min.js')}}"></script>

        <!-- App js -->
        <script src="{{url('assets/js/app.js')}}"></script>

        @yield('javascript')

    </body>
</html>
