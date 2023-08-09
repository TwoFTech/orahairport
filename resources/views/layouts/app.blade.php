<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="Orahairport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Orahairport &bull; {{ isset($title) ? $title : '' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&amp;display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/assets/vendors/core/core.css') }}">


    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">


    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') .'storage/assets/fonts/feather-font/css/iconfont.css') }}">


    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/assets/css/style.css?v=20') }}">

    <link rel="shortcut icon" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'images/logo.jpg') }}" />

    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/assets/css/custom.css?v=20') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style type="text/css">
        .btn-pay {
            width: 150px;
            float: right;
        }
    </style>

    @yield('customStyles')

    </head>
    <body>

        <div id="overlay">
            <div>Opération en cours</div>
        </div>

        <div class="main-wrapper">

            @include('layouts.partials.sidebarleft')
            <div class="page-wrapper">

                @include('layouts.partials.header')
                <div class="page-content">
                    @include('layouts.partials.includes._nav')
                    @if(session('info') || session('warning') || session('success') || session('danger'))
                        <div class="col-12">
                            <div class="alert alert-{{alertColor()}}">
                                <p>
                                    {{ alertMessage() }}
                                </p>
                            </div>
                        </div>
                    @endif

                    @yield('content')
                </div>
                @include('layouts.partials.footer')

            </div>
        </div>

        <script data-cfasync="false" src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}"></script><script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/assets/vendors/core/core.js') }}"></script>


        <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/assets/vendors/chartjs/Chart.min.js') }}"></script>
        <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/assets/vendors/jquery.flot/jquery.flot.js') }}"></script>
        <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/assets/vendors/jquery.flot/jquery.flot.resize.js') }}"></script>
        <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>


        <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/assets/vendors/feather-icons/feather.min.js') }}"></script>
        <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/assets/js/template.js') }}"></script>


        <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/assets/js/dashboard-light.js') }}"></script>
        <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/assets/js/datepicker.js') }}"></script>

        <script>(function(){var js = "window['__CF$cv$params']={r:'72bb43e7be6e72fc',m:'yFgTUkbFOr3KzgUfEwdLpSIqcQve_hdsOYCZdFdEZ2c-1657980038-0-AU2mo2bIqI/8pav8sdQ4ZJKeftJB395vRiRsdU6ly+Y/B9M/dwu/ZxRyDRanDMMApcbritFl/DSLUndNiGXz6IV2ESDeOlAnNaul9id+AArFV9i4SRZ3S1MzJhTcBsUBwyRJekFMgKcthOD3gA+vq24zSpz1XP3a2jj8ibTpB+A7',s:[0x6cd53f2424,0x906de49fa2],u:'/cdn-cgi/challenge-platform/h/g'};var now=Date.now()/1000,offset=14400,ts=''+(Math.floor(now)-Math.floor(now%offset)),_cpo=document.createElement('script');_cpo.nonce='',_cpo.src='../../../cdn-cgi/challenge-platform/h/g/scripts/alpha/invisible5615.js') }}?ts='+ts,document.getElementsByTagName('head')[0].appendChild(_cpo);";var _0xh = document.createElement('iframe');_0xh.height = 1;_0xh.width = 1;_0xh.style.border = 'none';_0xh.style.visibility = 'hidden';document.body.appendChild(_0xh);function handler() {var _0xi = _0xh.contentDocument || _0xh.contentWindow.document;if (_0xi) {var _0xj = _0xi.createElement('script');_0xj.innerHTML = js;_0xi.getElementsByTagName('head')[0].appendChild(_0xj);}}if (document.readyState !== 'loading') {handler();} else if (window.addEventListener) {document.addEventListener('DOMContentLoaded', handler);} else {var prev = document.onreadystatechange || function () {};document.onreadystatechange = function (e) {prev(e);if (document.readyState !== 'loading') {document.onreadystatechange = prev;handler();}};}})();
        </script>

        <script type="text/javascript">
            Fedapay.init('.pay-btn', { public_key: 'pk_sandbox_vg6uQjwTztFJbaxNW3I_0ksw'})
        </script>

        <!-- <script>
            const phoneInputField = document.querySelector("#phone");
            const countryInputField = document.querySelector("#country");
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let phoneInput = {};
            fetch('/pays/on',
                {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                    },
                    method: 'GET',
                }
            ).then(
                response => response.text()
            ).then((text) => {
                let data = JSON.parse(text);
                phoneInput = window.intlTelInput(phoneInputField, {
                 initialCountry: "bj",
                 onlyCountries: data.countries,
                 localizedCountries: {'bj': 'Bénin', 'cm': 'Cameroun', 'ne': 'Niger', 'sn': 'Sénégal', 'gw': 'Guinée-Bissau'},
                 utilsScript:
                   "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
               });
            }).catch((error) => {
                console.log(error);
            });

           function process(event) {
             event.preventDefault();
             const phoneNumber = phoneInput.getNumber();
             phoneInputField.value = phoneNumber;
             document.form.submit();
           }

           phoneInputField.addEventListener("countrychange", function() {
              country.value = phoneInput.getSelectedCountryData().name;
           });
        </script> -->

        <script>
            let ss = document.querySelectorAll('.ss');
            const overlay = document.querySelector('#overlay');
            Array.from(ss).forEach((element) => {
                element.addEventListener('click', function () {
                    overlay.style.display = 'block';
                });
            });
        </script>

        @yield('customScripts')
    </body>
</html>
