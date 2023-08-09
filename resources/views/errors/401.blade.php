@extends('errors::default')

@section('content')
<section class="error overflow-hidden pb-10 pt-20">
    <div class="container">
        <div class="error-main">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-7 mb-4">
                    <div class="error-content w-100 text-lg-start text-center">
                        <h3 class="theme">401 - Non autorisé</h3>
                        <h4 class="mb-0 navy">Votre tentative a échoué, veuillez essayer de rafraîchir la page et de remplir les informations correctes</h4>
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
