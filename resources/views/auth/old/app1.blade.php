<!DOCTYPE html>
<html lang="fr">
<head>
        <meta charset="utf-8" />
        <title>Orahairport &bull; {{ $title }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/images/favicon.png') }}">
        
		<!-- App css -->
		<link href="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/auth/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/auth/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<link href="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/auth/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
		<link href="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/auth/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

		<!-- icons -->
		<link href="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/auth/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <body class="loading" style="background:#dee2e6;">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    @yield('auth')
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <footer class="footer footer-alt">
            <script>document.write(new Date().getFullYear())</script> &copy Tous droits réservés &bull; Développé par <a href="{{ route('index') }}" class="link-dark text-decoration-underline">TwoF Technologies</a> 
        </footer>

        <!-- Vendor js -->
        <script src="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/auth/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/auth/js/app.min.js') }}"></script>
        
    </body>

</html>