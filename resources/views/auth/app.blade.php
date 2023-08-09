<!DOCTYPE html>
<html lang="fr">
<head>
    <style>
        label {
            font-size: 12px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Orahairport &bull; {{ isset($title) ? $title : '' }}</title>

    <link rel="shortcut icon" href="{{ (!\App::environment('local') ? 'public/' : '') }} . images/logo.jpg" />

    <link href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/css/style.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/css/plugin.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/css/custom.css') }}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/fonts/line-icons.css') }}" type="text/css">

    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

</head>
<body style="background-color:rgba(2, 158, 158, 0.5);">

    <div id="preloader">
        <div id="status"></div>
    </div>
    <section class="login-register pt-6 pb-6">
        <div class="container">
            <div class="log-main blog-full log-reg w-75 mx-auto">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3 ps-4" style="background-color:#fff; border-radius: 5px;">
                        <a href="{{ route('index') }}">
                            <h4 class="text-center"><span class="text-info">ORAH</span> AIRPORT</h4>
                        </a>
                        <h5 class="text-center border-b pb-2">Formulaire {{ isset($title) ? $title : '' }}</h5>
                        @if(session('success') || session('danger') || session('warning') || session('message'))
                            <div class="text-dark alert {{ session('message') ? 'alert-info' : '' }} {{ session('warning') ? 'alert-warning' : '' }} {{ session('success') ? 'alert-success' : '' }} {{ session('danger') ? 'alert-danger' : '' }}" role="alert">
                                    {{ session('warning') ?? '' }}
                                    {{ session('success') ?? '' }}
                                    {{ session('danger') ?? '' }}
                                    {{ session('message') ?? '' }}
                            </div>
                        @endif
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script data-cfasync="false" src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}">
    </script>
    <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/particles.js') }}"></script>
    <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/particlerun.js') }}"></script>
    {{-- <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/plugin.js') }}"></script> --}}
    <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/main.js') }}"></script>
    <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/custom-nav.js') }}"></script>
    <script>(function(){var js = "window['__CF$cv$params']={r:'72bb43a9afaa7515',m:'ufTlGaD0XbwvTe.aojFmnaEpiBNY1a09_ZWve1iyG84-1657980028-0-AcH4F7nMcYc8ak0evbnXqovdil+CXMf9sjZTdFqDOv3eL/ZU/sbYm4FcRjSn0zpYQ09AZpHStNQUhe8rRQduf/NZYgoJRHQiQ8FvwOqKnUE9Gzq+2dPwai36Oh0h5hp03latDanj5MzMmiDJCxCve6E=',s:[0xf52cf0cf7c,0xe2c0873413],u:'/cdn-cgi/challenge-platform/h/g'};var now=Date.now()/1000,offset=14400,ts=''+(Math.floor(now)-Math.floor(now%offset)),_cpo=document.createElement('script');_cpo.nonce='',_cpo.src='../../cdn-cgi/challenge-platform/h/g/scripts/alpha/invisible5615.js?ts='+ts,document.getElementsByTagName('head')[0].appendChild(_cpo);";var _0xh = document.createElement('iframe');_0xh.height = 1;_0xh.width = 1;_0xh.style.border = 'none';_0xh.style.visibility = 'hidden';document.body.appendChild(_0xh);function handler() {var _0xi = _0xh.contentDocument || _0xh.contentWindow.document;if (_0xi) {var _0xj = _0xi.createElement('script');_0xj.innerHTML = js;_0xi.getElementsByTagName('head')[0].appendChild(_0xj);}}if (document.readyState !== 'loading') {handler();} else if (window.addEventListener) {document.addEventListener('DOMContentLoaded', handler);} else {var prev = document.onreadystatechange || function () {};document.onreadystatechange = function (e) {prev(e);if (document.readyState !== 'loading') {document.onreadystatechange = prev;handler();}};}})();
    </script>

    <script>
        const phoneInputField = document.querySelector("#phone");
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
    </script>
</body>

</html>
