<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <title>{{ config('app.name', 'ORAHAIPORT') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/images/favicon.png') }}">
        
        <!-- App css -->
        <link href="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
        <link href="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

        <link href="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/assets/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
        <link href="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

        <!-- icons -->
        <link href="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <!-- body start -->
    <body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

        <!-- Begin page -->
        <div id="wrapper">

            @include('layouts\partials/header')
            <!-- end Topbar -->
            <!-- ========== Left Sidebar Start ========== -->
            @include('layouts\partials/sidebarleft')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        @include('layouts\partials/includes\_page_title')     
                        <!-- end page title --> 

                        @yield('content')
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                @include('layouts\partials/footer')
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/assets/js/vendor.min.js') }}"></script>

        <!-- Plugins js-->
        <script src="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- Dashboar 1 init js-->
        <script src="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/assets/js/pages/dashboard-1.init.js') }}"></script>

        <!-- App js-->
        <script src="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/assets/js/app.min.js') }}"></script>
        
    </body>
</html>