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
                    <li><a href="https://web.facebook.com/profile.php?id=100085322764558" class="white"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="https://www.twitter.com/orahairport" class="white"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                    {{-- <li><a href="#" class="white"><i class="fab fa-instagram" aria-hidden="true"></i></a></li> --}}
                    <li><a href="https://www.linkedin.com/in/stephane-awore-b7a67768/?originalSubdomain=ga" class="white"><i class="fab fa-linkedin " aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="header_menu" id="header_menu">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-flex d-flex align-items-center justify-content-between w-100 pb-2 pt-2">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ route('index') }}">
                            <h5>
                                <b>
                                    <span class="text-info">ORAH</span>AIRPORT
                                </b> <br>
                                <small style="color: #fdc703; text-transform: none;">La billeterie autrement</small>
                            </h5>
                        </a>
                    </div>
                    <div class="navbar-collapse1 d-flex align-items-center" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav" id="responsive-menu">
                            <li class="{{ Route::currentRouteName() == 'index' ? 'active' : '' }}"><a href="{{ route('index') }}">Accueil</a></li>
                            <li class="{{ Route::currentRouteName() == 'about' ? 'active' : '' }}"><a href="{{ route('about') }}">A Propos</a></li>
                            <li class="{{ Route::currentRouteName() == 'partners' ? 'active' : '' }}"><a href="{{ route('partners') }}">Partenaires</a></li>
                            <li class="{{ Route::currentRouteName() == 'contact' ? 'active' : '' }}"><a href="{{ route('contact') }}">Nous Contacter</a></li>
                            @if(!Auth::check())
                                <a href="{{ route('loginForm') }}" class="me-3 d-lg-none">
                                    Se Connecter
                                </a>
                            @endif
                            <a href="{{ route('stands.create') }}" class="btn-sm nir-btn text-white d-lg-none" style="margin-left: 15px; margin-right: 15px;">Creer Point De Vente</a>
                        </ul>
                    </div>
                    <div class="register-login d-flex align-items-center">
                        @if(!Auth::check())
                            <a href="{{ route('loginForm') }}" class="me-3">
                                Se Connecter
                            </a>
                        @endif
                        <a href="{{ route('stands.create') }}" class="btn-sm nir-btn text-white">Creer Point Vente</a>
                    </div>
                    <div id="slicknav-mobile">

                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
