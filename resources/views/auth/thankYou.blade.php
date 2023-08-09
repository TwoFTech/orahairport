<!DOCTYPE html>
<html lang="fr">

<!-- Mirrored from htmldesigntemplates.com/html/travelin/confirmation.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Jul 2022 14:06:25 GMT -->
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Orahairport &bull; {{ isset($title) ? $title : '' }}</title>

<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

<link href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset((!\App::environment('local') ? 'public/' : '') .'storage/css/style.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset((!\App::environment('local') ? 'public/' : '') .'storage/css/plugin.css') }}" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') .'storage/cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') .'storage/cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') .'storage/fonts/line-icons.css') }}" type="text/css">
</head>

<div id="preloader">
<div id="status"></div>
</div>

<header class="main_header_area">
    <div class="header-content py-1 bg-theme">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="links">
                <ul>
                    <li style="color: white; font-size: 14px;"><i class="icon-calendar white"></i>
                        <span id="date" class="d-inline-flex">
                            <span id="day">00</span>-
                            <span id="month">00</span>-
                            <span id="year">0000</span>
                        </span>
                        <span id="time" class="d-inline-flex">
                            <span id="hour">00</span>:
                            <span id="minute">00</span>:
                            <span id="second">00</span>
                        </span>
                    </li>
                    <li><a href="#" class="white"><i class="icon-location-pin white"></i> Kowegbo, 2ème arrondissement, Cotonou, Bénin</a></li>
                    <li><a href="#" class="white"><i class="icon-clock white"></i> Lun-Ven: 08H – 18H</a></li>
                    <li><a href="#" class="white"><i class="icon-clock white"></i> Sam-Dim: 08H – 13H</a></li>
                </ul>
            </div>
            <div class="links float-right">
                <ul>
                    <li><a href="#" class="white"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="#" class="white"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="#" class="white"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                    <li><a href="#" class="white"><i class="fab fa-linkedin " aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="header_menu" id="header_menu">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-flex d-flex align-items-center justify-content-between w-100 pb-3 pt-3">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ route('index') }}">
                            <b>
                                <h3><span class="text-info">ORAH</span>AIRPORT</h3>
                            </b>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

<section class="trending pt-6 pb-0 bg-lgrey">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xs-12 mb-4">
                <div class="payment-book">
                    <div class="booking-box">
                        <div class="booking-box-title d-md-flex align-items-center bg-title p-4 mb-4 rounded text-md-start text-center">
                            <i class="fa fa-check px-4 py-3 bg-white rounded title fs-5"></i>
                            <div class="title-content ms-md-3">
                                <h3 class="mb-1 white">Vérifiez votre adresse e-mail</h3>
                                <p class="mb-0 white">
                                    @if(session('success'))
                                        {{ session('success') }}
                                    @else
                                        Un e-mail de confirmation a été envoyé à l'adresse e-mail <b>{{ $email }}</b>.
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="booking-border mb-4">
                            <p class="mb-0">
                                <p>Avant de continuer, veuillez vérifier votre adresse email par un lien de vérification transmis par courrier. <br>
                                Si vous n'avez pas reçu d'email, cliquez sur le lien ci-dessous pour renvoyer le lien d'activation ou vérifiez vos spams. <p>
                                <form class="d-inline" method="POST" action="{{ route('resendEmail') }}" style="margin-top: 15px; position: relative;">
                                    @csrf
                                    <input type="hidden" name="email" id="email" value="{{ $email }}">
                                    <button type="submit" class="nir-btn-black">Renvoyer</button>.
                                </form>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 mb-4 ps-4">
                <div class="sidebar-sticky">
                    <div class="list-sidebar">
                        <div class="sidebar-item bordernone bg-white rounded box-shadow overflow-hidden p-3 mb-4">
                            <h5>Etapes de confirmation</h5>
                            <div class="sidebar-module-inner">
                                <ul class="help-list">
                                    <li class="border-b pb-1 mb-1">
                                        <span class="font-weight-bold">Ouvrez votre App Gmail</span>
                                    </li>
                                    <li class="border-b pb-1 mb-1">
                                        <span class="font-weight-bold">Selectionnez votre compte <b>{{ $email }}</b></span> 
                                    </li>
                                    <li class="border-b pb-1 mb-1">
                                        <span class="font-weight-bold">Ouvrez le message orahairport</span>
                                    </li>
                                    <li>
                                        <span class="font-weight-bold">Cliquez sur le bouton de confirmation</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





<div id="back-to-top">
<a href="#"></a>
</div>
<script data-cfasync="false" src="{{ asset((!\App::environment('local') ? 'public/' : '') .'storage//cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}"></script>
<script src="{{ asset((!\App::environment('local') ? 'public/' : '') .'storage/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset((!\App::environment('local') ? 'public/' : '') .'storage/js/bootstrap.min.js') }}"></script>
<script src="{{ asset((!\App::environment('local') ? 'public/' : '') .'storage/js/particles.js') }}"></script>
<script src="{{ asset((!\App::environment('local') ? 'public/' : '') .'storage/js/particlerun.js') }}"></script>
{{-- <script src="{{ asset((!\App::environment('local') ? 'public/' : '') .'storage/js/plugin.js') }}"></script> --}}
<script src="{{ asset((!\App::environment('local') ? 'public/' : '') .'storage/js/main.js') }}"></script>
<script src="{{ asset((!\App::environment('local') ? 'public/' : '') .'storage/js/custom-swiper.js') }}"></script>
<script src="{{ asset((!\App::environment('local') ? 'public/' : '') .'storage/js/custom-nav.js') }}"></script>
<script>(function(){var js = "window['__CF$cv$params']={r:'72bb435cfee106dd',m:'hq6u1ECPJETh5gUhk5dJQROVaMEOS80u4hwYr73K7po-1657980016-0-Ab8YFuB3S/2m6KK+9oh7r4x3AjEKb/Qo0DVnrMFTUVQDK3G5KxwuMDJM58WP9r1eaG9Ms4L5Lkkbyr5sdyvezCbxsoHNRdkdrbRfhJxiDx/eY2m1Nv7vwouUMRVfxd9/Hx3JVlrEr4IM1/Ap7dc6QZjMgsz8P47QkzO314wu64f9',s:[0x7630635b2e,0x959e64c146],u:'/cdn-cgi/challenge-platform/h/g'};var now=Date.now()/1000,offset=14400,ts=''+(Math.floor(now)-Math.floor(now%offset)),_cpo=document.createElement('script');_cpo.nonce='',_cpo.src='../../cdn-cgi/challenge-platform/h/g/scripts/alpha/invisible5615.js?ts='+ts,document.getElementsByTagName('head')[0].appendChild(_cpo);";var _0xh = document.createElement('iframe');_0xh.height = 1;_0xh.width = 1;_0xh.style.border = 'none';_0xh.style.visibility = 'hidden';document.body.appendChild(_0xh);function handler() {var _0xi = _0xh.contentDocument || _0xh.contentWindow.document;if (_0xi) {var _0xj = _0xi.createElement('script');_0xj.innerHTML = js;_0xi.getElementsByTagName('head')[0].appendChild(_0xj);}}if (document.readyState !== 'loading') {handler();} else if (window.addEventListener) {document.addEventListener('DOMContentLoaded', handler);} else {var prev = document.onreadystatechange || function () {};document.onreadystatechange = function (e) {prev(e);if (document.readyState !== 'loading') {document.onreadystatechange = prev;handler();}};}})();</script>
</body>

</html>