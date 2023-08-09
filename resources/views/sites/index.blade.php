@extends('sites/layouts/base')
@section('content')
    <section class="banner overflow-hidden">
        <div class="slider top50">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="slide-inner">
                            <div class="slide-image" style="background-image:url({{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/slider/flight2.jpg') }})"></div>
                            <div class="swiper-content">
                                <div class="entry-meta mb-2">
                                    <h5 class="entry-category mb-0 white">{{ config('app.name ', 'ORAHAIRPORT') }} TRAVEL</h5>
                                </div>
                                <h2 class="mb-2"><a href="#" class="white">Une agence de voyage </a></h2>
                                <p class="white mb-4">
                                    Nous sommes spécialisés dans les domaines du tourisme et du transport aérien.
                                </p>
                                <a href="{{ route('about') }}" class="nir-btn">En savoir plus</a>
                            </div>
                            <div class="dot-overlay"></div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slide-inner">
                            <div class="slide-image" style="background-image:url({{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/slider/flight6.jpg') }})"></div>
                            <div class="swiper-content">
                                <div class="entry-meta mb-2">
                                    <h5 class="entry-category mb-0 white">{{ config('app.name ', 'ORAHAIRPORT') }} EXPRESS</h5>
                                </div>
                                <h2 class="mb-2"><a href="#" class="white">Point de vente</a></h1>
                                <p class="white mb-4">
                                    Rendez-vous dans nos points de ventes pour réserver vos billets d'avion.
                                </p>
                                <div class="slider-button d-flex justify-content-center">
                                    @if (Auth::check())
                                        <a href="{{ route('stands.create') }}" class="nir-btn me-4">Créer un compte marchand</a>
                                    @else
                                        <a href="{{ route('register') }}" class="nir-btn me-4">Je veux m'inscrire maintenant</a>
                                    @endif
                                </div>
                            </div>
                            <div class="dot-overlay"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </section>
    <section class="about-us p-0">
        <div class="container">
            <div class="about-image-box">
                <div class="row d-flex align-items-center justify-content-between">
                    <div class="col-lg-5 mb-4 pe-lg-4">
                        <div class="form-main mt-minus">
                            <div class="form-content rounded overflow-hidden">
                                <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/slider/orahairport.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 mb-4 ps-lg-4">
                        <div class="about-content text-center text-lg-start mb-4 mt-10">
                            <h3 class="theme d-inline-block mb-0" style="text-transform: none;">A propos de nous</h3>
                            <h4>Nous sommes plus près de vous. <br> Réservez votre prochain départ le plus près de chez vous.</h4>
                            <p class="border-b mb-2 pb-2">
                                OrahAirport est une solution qui vous aide à faire vos réservations de ticket d'avion depuis
                                votre domicile. Nous sommes situés dans les pays de l'Afrique de l'Ouest et Centrale.
                                Rendez-vous dans nos points de vente, faites vos réservations en un clic depuis votre smartphone.
                            </p>
                            <div class="about-listing">
                                <ul class="d-flex justify-content-between">
                                    <li><i class="icon-plane theme"></i> Guide de voyage</li>
                                    <li><i class="icon-briefcase theme"></i> Orah Express </li>
                                    <li><i class="icon-folder theme"></i> Etude de dossier</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="white-overlay"></div>
    </section>
@stop

