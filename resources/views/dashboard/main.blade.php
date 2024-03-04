<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Cash Flow Tracker - @yield('title')</title>
        <meta content="Admin Dashboard - Cash Flow Tracker is a tool to help you stay on top of your finances and achieve your financial goals." name="description" />
        <meta content="Annas Pratama" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

        <!-- Boostrap -->
        {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css"> --}}

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/vanillaCalendar.css') }}"/>
        <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-2.0.2.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/chartist/css/chartist.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/metro/MetroJs.min.css') }}">

        <link rel="stylesheet" href="{{ asset('plugins/carousel/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/carousel/owl.theme.default.min.css') }}">

        <link rel="stylesheet" href="{{ asset('plugins/animate/animate.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-material-design.min.css') }}" type="text/css">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/icons.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">

        <!-- Specific CSS -->
        @section('css')
        @show

    </head>


    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner"></div>
            </div>
        </div>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                    <i class="mdi mdi-close"></i>
                </button>

                <!-- LOGO -->
                @include('dashboard.parts.logo')

                @include('dashboard.parts.sidebar')
                <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                @section('content')
                <h3>Default Content</h3>
                @show
                <!-- content -->

                @include('dashboard.parts.footer')

            </div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->


        <!-- jQuery  -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-material-design.js') }}"></script>
        <script src="{{ asset('js/modernizr.min.js') }}"></script>
        <script src="{{ asset('js/detect.js') }}"></script>
        <script src="{{ asset('js/fastclick.js') }}"></script>
        <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('js/waves.js') }}"></script>
        <script src="{{ asset('js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('js/jquery.scrollTo.min.js') }}"></script>


        <script src="{{ asset('plugins/carousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('plugins/fullcalendar/vanillaCalendar.js') }}"></script>
        <script src="{{ asset('plugins/peity/jquery.peity.min.js') }}"></script>
        <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
        <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <script src="{{ asset('plugins/chartist/js/chartist.min.js') }}"></script>
        <script src="{{ asset('plugins/chartist/js/chartist-plugin-tooltip.min.js') }}"></script>
        <script src="{{ asset('plugins/metro/MetroJs.min.js') }}"></script>
        <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('plugins/morris/morris.min.js') }}"></script>

        <!-- Boostrap JS -->
        {{-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}

        <!-- App js -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Specific JS -->
        @section('js')
        @show
       
    </body>

</html>