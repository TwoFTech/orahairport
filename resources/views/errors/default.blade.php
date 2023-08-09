<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Orahairport &bull; {{ isset($title) ? $title : '' }}</title>

        <link rel="shortcut icon" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'images/logo.jpg') }}" />

        <link href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

        <link href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/css/style.css') }}" rel="stylesheet" type="text/css">

        <link href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/css/plugin.css') }}" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/fonts/line-icons.css') }}" type="text/css">
    </head>
    <body onload="initClock()">

        <div id="preloader">
            <div id="status"></div>
        </div>


        @include('sites.layouts.partials.header')
        @yield('content')
        @include('sites.layouts.partials.footer')


        <div id="back-to-top">
        <a href="#"></a>
        </div>

        <script data-cfasync="false" src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script><script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/jquery-3.5.1.min.js')}}"></script>
        <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/particles.js')}}"></script>
        <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/particlerun.js')}}"></script>
        <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/plugin.js')}}"></script>
        <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/main.js')}}"></script>
        <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/custom-swiper.js')}}"></script>
        <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/custom-nav.js')}}"></script>
        <script>(function(){var js = "window['__CF$cv$params']={r:'72bb42d9da9906dd',m:'3YJXdtaDfI1I.K8lMOTgv0JYjuVCmbYnYqgLsmouiB8-1657979995-0-AQR9+mAw8vbEdDd+4251KPQz9kifwCO1D1z3Y+TvkCtVEkJ1ChJTXhylUL6+HOQoqz33WoQmZJwRvuGgco1DQ/DHNA0dr1gYK0hS2lfE6MY4ApCQTvHCWwhShoNo16gUmupn8/mqDTli/mLRl6UaiOk=',s:[0x4c066a0c8c,0xfc9d7cc95f],u:'/cdn-cgi/challenge-platform/h/g'};var now=Date.now()/1000,offset=14400,ts=''+(Math.floor(now)-Math.floor(now%offset)),_cpo=document.createElement('script');_cpo.nonce='',_cpo.src='../../cdn-cgi/challenge-platform/h/g/scripts/alpha/invisible5615.js')}}?ts='+ts,document.getElementsByTagName('head')[0].appendChild(_cpo);";var _0xh = document.createElement('iframe');_0xh.height = 1;_0xh.width = 1;_0xh.style.border = 'none';_0xh.style.visibility = 'hidden';document.body.appendChild(_0xh);function handler() {var _0xi = _0xh.contentDocument || _0xh.contentWindow.document;if (_0xi) {var _0xj = _0xi.createElement('script');_0xj.innerHTML = js;_0xi.getElementsByTagName('head')[0].appendChild(_0xj);}}if (document.readyState !== 'loading') {handler();} else if (window.addEventListener) {document.addEventListener('DOMContentLoaded', handler);} else {var prev = document.onreadystatechange || function () {};document.onreadystatechange = function (e) {prev(e);if (document.readyState !== 'loading') {document.onreadystatechange = prev;handler();}};}})();</script>
        <script type="text/javascript">
            function updateClock() {
                Number.prototype.pad = function(digits) {
                    for(var n = this.toString(); n.length < digits; n = 0 + n);
                    return n
                }

                let now = new Date()
                let day = now.getDate(), month = now.getMonth() + 1, year = now.getFullYear(), hour = now.getHours(), minute = now.getMinutes(), sec = now.getSeconds()
                let ids = ["day", "month", "year", "hour", "minute", "second"]
                let values = [day.pad(2), month.pad(2), year, hour.pad(2), minute.pad(2), sec.pad(2)]

                for(i = 0; i < ids.length; i++) {
                    document.getElementById(ids[i]).firstChild.nodeValue = values[i]
                    console.log(values[i])
                }
            }

            function initClock() {
                updateClock()
                window.setInterval("updateClock()", 1)
            }
        </script>
    </body>
</html>