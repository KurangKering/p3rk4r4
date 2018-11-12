<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <title>Zircos - Responsive Admin Dashboard Template</title>
    <!-- App css -->
    <link href="{{ asset('templates/horizontal/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/horizontal/assets/css/core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/horizontal/assets/css/components.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/horizontal/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/horizontal/assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/horizontal/assets/css/menu.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/horizontal/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{  asset('templates/horizontal/../plugins/switchery/switchery.min.css') }}">
    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src="{{ asset('templates/horizontal/assets/js/modernizr.min.js') }}"></script>
</head>
<body>
    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main">
            <div class="container">
                <!-- Logo container-->
                <div class="logo">
                    <!-- Text Logo -->
                    <!--<a href="index.html" class="logo">-->
                        <!--Zircos-->
                        <!--</a>-->
                        <!-- Image Logo -->
                        <a href="index.html" class="logo">
                            <img src="{{ asset('templates/horizontal/assets/images/logo.png') }}" alt="" height="30">
                        </a>
                    </div>
                    <!-- End Logo container-->
                    <div class="menu-extras">
                        <ul class="nav navbar-nav navbar-right pull-right">
                            <li class="navbar-c-items">
                                <form role="search" class="navbar-left app-search pull-left hidden-xs">
                                 <input type="text" placeholder="Search..." class="form-control">
                                 <a href=""><i class="fa fa-search"></i></a>
                             </form>
                         </li>


                         <li class="dropdown navbar-c-items">
                            <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><img src="{{ asset('templates/horizontal/assets/images/users/avatar-1.jpg') }}" alt="user-img" class="img-circle"> </a>
                            <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                                <li class="text-center">
                                    <h5>Hi, John</h5>
                                </li>
                                <li><a href="javascript:void(0)"><i class="ti-user m-r-5"></i> Profile</a></li>
                                <li><a href="javascript:void(0)"><i class="ti-settings m-r-5"></i> Settings</a></li>
                                <li><a href="javascript:void(0)"><i class="ti-lock m-r-5"></i> Lock screen</a></li>
                                <li><a href="javascript:void(0)"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="menu-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </div>
                </div>
                <!-- end menu-extras -->
            </div> <!-- end container -->
        </div>
        <!-- end topbar-main -->
        @include('layouts.partials.navbar')
         <!-- end navbar-custom -->
    </header>
    <!-- End Navigation Bar-->
    <div class="wrapper">
        <div class="container">
          {{--   <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">

                        <h4 class="page-title">@yield('title', 'Judul Page')</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb --> --}}
            @yield('content')
         {{--    <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">

                    </div> <!-- end card-box -->
                </div> <!-- end col -->
            </div> --}}
            <!-- Footer -->
            <footer class="footer text-right">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            © 2018. All rights reserved.
                        </div>
                    </div>
                </div>
            </footer>
            <!-- End Footer -->
        </div> <!-- end container -->
    </div>
    <!-- end wrapper -->
    <!-- jQuery  -->
    <script src="{{ asset('templates/horizontal/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('templates/horizontal/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('templates/horizontal/assets/js/detect.js') }}"></script>
    <script src="{{ asset('templates/horizontal/assets/js/fastclick.js') }}"></script>
    <script src="{{ asset('templates/horizontal/assets/js/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('templates/horizontal/assets/js/waves.js') }}"></script>
    <script src="{{ asset('templates/horizontal/assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('templates/horizontal/assets/js/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('templates/horizontal/../plugins/switchery/switchery.min.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('templates/horizontal/assets/js/jquery.core.js') }}"></script>
    <script src="{{ asset('templates/horizontal/assets/js/jquery.app.js') }}"></script>
</body>
</html>