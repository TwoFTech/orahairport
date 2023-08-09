@extends('sites/layouts/base')
@section('content')
<section class="about-us pt-6" style="background-image:url({{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/background_pattern.png') }}); background-position:bottom right;">
    <div class="container">
        <div class="about-image-box">
            <div class="row d-flex align-items-center justify-content-between">
                <div class="col-lg-6 ps-4">
                    <div class="about-content text-center text-lg-start">
                        <h3 class="theme d-inline-block mb-0" style="text-transform: none;">En savoir plus sur nous</h3>
                        <h4 class="border-b mb-2 pb-1">Explorez partout avec nous</h4>
                        <p class="border-b mb-2 pb-2" style="text-align: justify;">
                            Avec OrahAirport Travel, pour votre prochain départ, notre proximité vous accompagne à faire
                            vos réservations de vols le plus près de vous. De votre smartphone, vous avez à valider vos émissions de billets.
                            Arriver à l'heure à l'aéroport, faire votre enregistrement et embarquer en toute tranquilité.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 mb-4 pe-4">
                    <div class="about-image" style="animation:none; background:transparent;">
                        <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/flights/flight6.jpg') }}" alt="Image à propos">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="counter-main w-75 float-start z-index3 position-relative">
                        <div class="counter p-4 pb-0 box-shadow bg-white rounded mt-minus">
                            <div class="row">

                                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                    <div class="counter-item border-end pe-4">
                                        <div class="counter-content">
                                            <h2 class="value mb-0 theme">{{ setExp() }}</h2>
                                                <span class="m-0">ans d'expérience</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                    <div class="counter-item border-end pe-4">
                                        <div class="counter-content">
                                            <h2 class="value mb-0 theme">{{ getCounterCountry() }}</h2>
                                            <span class="m-0">Pays actifs</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                    <div class="counter-item">
                                        <div class="counter-content border-end pe-4">
                                            <h2 class="value mb-0 theme">{{ getCounterStand() }}</h2>
                                            <span class="m-0">Points marchants</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                    <div class="counter-item">
                                        <div class="counter-content">
                                            <h2 class="value mb-0 theme">{{ getCounterTicket() }}</h2>
                                            <span class="m-0">Réservations / an</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="white-overlay"></div>
</section>


<!-- <section class="about-us pb-0">
<div class="section-shape section-shape1" style="background-image: url({{ asset('storage/images/shape8.png') }});"></div>
<div class="container">
<div class="section-title mb-6 w-50 mx-auto text-center">
<h4 class="mb-1 theme1">Core Features</h4>
<h2 class="mb-1">Trouvez <span class="theme">Nos Performances</span></h2>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
</div>

<div class="why-us">
<div class="why-us-box">
<div class="row">
<div class="col-lg-3 col-md-6 col-sm-6 mb-4">
<div class="why-us-item p-5 pt-6 pb-6 border rounded bg-white">
<div class="why-us-content">
<div class="why-us-icon mb-1">
<i class="icon-flag theme"></i>
</div>
<h4><a href="about.html">Tell Us What You want To Do</a></h4>
<p class="mb-2">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia.</p>
<p class="mb-0 theme">100+ Reviews</p>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 mb-4">
<div class="why-us-item p-5 pt-6 pb-6 border rounded bg-white">
<div class="why-us-content">
<div class="why-us-icon mb-1">
<i class="icon-location-pin theme"></i>
</div>
<h4><a href="about.html">Share Your Travel Locations</a></h4>
<p class="mb-2">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia.</p>
<p class="mb-0 theme">100+ Reviews</p>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 mb-4">
<div class="why-us-item p-5 pt-6 pb-6 border rounded bg-white">
<div class="why-us-content">
<div class="why-us-icon mb-1">
<i class="icon-directions theme"></i>
</div>
<h4><a href="about.html">Share Your Travel Preference</a></h4>
<p class="mb-2">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia.</p>
<p class="mb-0 theme">100+ Reviews</p>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 mb-4">
<div class="why-us-item p-5 pt-6 pb-6 border rounded bg-white">
<div class="why-us-content">
<div class="why-us-icon mb-1">
<i class="icon-compass theme"></i>
</div>
<h4><a href="about.html">Here 100% Trusted Tour Agency</a></h4>
<p class="mb-2">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia.</p>
<p class="mb-0 theme">100+ Reviews</p>
</div>
</div>
</div>
</div>
</div>
</div>

</div>
</section> -->

@endsection
