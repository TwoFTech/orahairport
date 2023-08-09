<footer class="pt-20 pb-4" style="background-image: url({{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/background_pattern.png') }});">
    <div class="footer-upper pb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4 pe-4">
                    <div class="footer-about">
                        <!-- <img src="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/images/logo-white.png') }}" alt=""> -->
                        <h4 class="text-white"><span class="text-info">ORAH </span> AIRPORT</h4>
                        <p class="mt-3 mb-3 white">
                            Nos informations de contacts pour plus de détails.
                        </p>
                        <ul>
                            <li class="white"><strong>Contacts:</strong> <a href="tel:+229 63854326">(+229) 63854326</a> / <a href="tel:+229 69259425">(+229) 69 259 425</a></li>
                            <li class="white"><strong>Location:</strong> Kowegbo, 2ème arrondissement, Cotonou, Bénin</li>
                            <li class="white"><strong>Email:</strong> <a href="mailto:marketing@travel-orahairport.com">marketing@travel-orahairport.com</a></li>
                            <li class="white"><strong>Site web:</strong> <a href="https://www.travel-orahaiport.com">www.travel-orahairport.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-4">
                    <div class="footer-links">
                        <h3 class="white">Racourcis</h3>
                        <ul>
                            <li><a href="{{ route('about') }}">A propos</a></li>
                            <li><a href="{{ route('network') }}">Notre réseau commercial</a></li>
                            <li><a href="{{ route('contact') }}">Nous contacter</a></li>
                            <li><a href="{{ route('stands.create') }}">Créer un compte marchand</a></li>
                            @if(Auth::check())
                                <li><a href="{{ route('home') }}">Tableau de bord</a></li>
                                <li><a href="{{ route('logout') }}">Déconnexion</a></li>
                            @else
                                <li><a href="{{ route('register') }}">Créer un compte</a></li>
                                <li><a href="{{ route('loginForm') }}">Se connecter</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-4">
                    <div class="footer-links">
                        <h3 class="white">Entreprise</h3>
                        <ul>
                            <li><a href="{{ route('rgpd.policies') }}">Politiques de confidentialités</a></li>
                            <li><a href="#">Mentions légales</a></li>
                            <!-- <li><a href="#">Conditions générales d'utilisation</a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-4">
                    <div class="footer-links">
                        <h3 class="white">Support</h3>
                        <ul>
                            <li><a href="{{ route('guide') }}">Guide d'utilisation</a></li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="footer-links">
                        <h3 class="white">Newsletter</h3>
                        <div class="newsletter-form ">
                        <p class="mb-3">
                            Laissez-nous votre adresse email pour ne pas ratter nos informations
                            des réductions accordez nos clients.
                        </p>
                        <form action="#" method="get" accept-charset="utf-8" class="border-0 d-flex align-items-center">
                            <input type="text" placeholder="Adresses Email">
                            <button class="nir-btn ms-2">Souscrire</button>
                        </form>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- <div class="footer-payment">
        <div class="container">
            <div class="row footer-pay align-items-center justify-content-between text-lg-start text-center">
                <div class="col-lg-8 footer-payment-nav mb-4">
                    <ul class="">
                        <li class="me-2">Choix de langue :</li>
                        <li class="me-2"><i class="fab fa-cc-mastercard fs-4"></i></li>
                        <li class="me-2"><i class="fab fa-cc-paypal fs-4"></i></li>
                        <li class="me-2"><i class="fab fa-cc-stripe fs-4"></i></li>
                        <li class="me-2"><i class="fab fa-cc-visa fs-4"></i></li>
                        <li class="me-2"><i class="fab fa-cc-discover fs-4"></i></li>
                    </ul>
                </div>
                <div class="col-lg-4 footer-payment-nav mb-4">
                    <ul class="d-flex align-items-center">
                        <li class="me-2 w-75">
                            <select class="niceSelect rounded">
                            <option>English</option>
                            <option>Chinese</option>
                            <option>Russian</option>
                            <option>Japanese</option>
                            <option>Korean</option>
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
    <div class="footer-copyright">
        <div class="container">
            <div class="copyright-inner rounded p-3 d-md-flex align-items-center justify-content-between">
                <div class="copyright-text">
                    <p class="m-0 white">&copy<script>document.write(new Date().getFullYear())</script> ORAHAIRPORT Travel. Tous droits réservés.
                    <span class="text-muted"> Développé par</span>  
                    <a target="_blank" href="https://www.facebook.com/twoftechnologies/"> <span class="text-warning"> TwoF </span><span class="text-info">Technologies</span></a>.</p>
                </div>
                <div class="social-links">
                <ul>
                    <li><a target="_blank" href="https://web.facebook.com/profile.php?id=100085322764558"><i class="fab fa-facebook"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="particles-js"></div>
</footer>