@extends('errors::default')

@section('content')
{{-- <section class="error overflow-hidden pb-10">
    <div class="container">
        <div class="error-content text-center">
            <h2 class="mb-2">Oops! Page non trouvée</h2>
            <img src="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/images/404-1.svg') }}" alt="" class="mb-4 w-75 mx-auto">
            <h3 class="m-0">nous sommes désolés, mais la page que vous avez demandée n'a pas été trouvée</h3>
            <div class="error-btn mt-4">
                <a href="{{ route('index') }}" class="nir-btn me-2">ALLER À LA PAGE D'ACCUEIL</a>
                <a href="{{route('contact')}}" class="nir-btn">ALLER À LA PAGE DE CONTACT</a>
            </div>
        </div>
    </div>
</section> --}}

<section class="error overflow-hidden pb-10 pt-20">
    <div class="container">
        <div class="error-main">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-7 mb-4">
                    <div class="error-content w-100 text-lg-start text-center">
                        <h3 class="theme">403 - Interdicton</h3>
                        <h4 class="mb-0 navy">vous n'avez pas la permission d'accéder à ces ressources</h4>
                        <div class="newsletter-form mt-3 w-75 rounded overflow-hidden">
                            <form>
                                <input type="email" placeholder="Enter your email">
                                <input type="submit" class="nir-btn bordernone" value="Subscribe">
                            </form>
                        </div>
                        <div class="error-btn mt-4">
                            <a href="{{ route('index') }}" class="nir-btn me-2">ALLER À LA PAGE D'ACCUEIL</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="error-image">
                        <img src="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/images/404-1.svg') }}" alt="" class="mb-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
