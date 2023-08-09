@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                    <h4>Passager {{ CounterInResa($reservation) }}</h4>
                    <a href="{{ route('reservations.show', ['reservation' => $reservation, 'token' => $reservation->token]) }}" class="btn-sm btn btn-info"><i class='link-icon' data-feather='back'></i> Aller à la réservation</a>
                </div>
                <form class="passenger" method="post" action="{{ route('passengers.store', ['reservation' => $reservation, 'token' => $reservation->token]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="formula" class="form-label"><b>Formule</b></label> <br>
                            <span class="form-check form-switch">
                                <input type="radio" name="formula" value="aller_retour" checked class="form-check-input" id="formSwitch1">Aller-retour
                            </span>
                            <span class="form-check form-switch">
                                <input type="radio" name="formula" value="aller_simple" class="form-check-input" id="formSwitch2">Aller simple
                            </span>
                            @error("formula")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="cabin" class="form-label"><b>Classe</b></label> <br>
                            <span class="form-check form-switch">
                                <input type="radio" name="cabin" value="Eco" checked class="form-check-input" id="formSwitch1">Eco
                            </span>
                            <span class="form-check form-switch">
                                <input type="radio" name="cabin" value="Business" class="form-check-input" id="formSwitch2">Business
                            </span>
                            <span class="form-check form-switch">
                                <input type="radio" name="cabin" value="First" class="form-check-input" id="formSwitch2">First
                            </span>
                            <span class="form-check form-switch">
                                <input type="radio" name="cabin" value="Premium" class="form-check-input" id="formSwitch2">Premium
                            </span>
                            @error("cabin")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="category" class="form-label"><b>Catégorie</b></label> <br>
                            <span class="form-check form-switch">
                                <input type="radio" name="category" value="Adulte" checked class="form-check-input" id="formSwitch1">Adulte(12+)
                            </span>
                            <span class="form-check form-switch">
                                <input type="radio" name="category" value="Enfant" class="form-check-input" id="formSwitch2">Enfant(2-12)
                            </span>
                            <span class="form-check form-switch">
                                <input type="radio" name="category" value="Bébé" class="form-check-input" id="formSwitch2">Bébé(0-2)
                            </span>
                            @error("category")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <label for="firstname" class="form-label"><b>Prénom du passager</b></label>
                            <input type="text" class="form-control" id="firstname" autocomplete="off" placeholder="Prénom du passager" name="firstname" value="{{ old('firstname', CopyPassengerInfo($reservation) == true ? $reservation->firstname : '') }}" required @if(CopyPassengerInfo($reservation) == true) readonly @endif>
                            @error("firstname")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="lastname" class="form-label"><b>Nom du passager</b></label>
                            <input type="text" class="form-control" id="lastname" autocomplete="off" placeholder="Nom du passager" name="lastname" value="{{ old('lastname', CopyPassengerInfo($reservation) == true ? $reservation->lastname : '') }}" required @if(CopyPassengerInfo($reservation) == true) readonly @endif>
                            @error("lastname")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="phone" class="form-label"><b>Téléphone du passager</b></label>
                            <input type="text" class="form-control" id="phone" autocomplete="off" placeholder="Téléphone du passager" name="phone" value="{{ old('phone', CopyPassengerInfo($reservation) == true ? $reservation->phone : '') }}" @if(CopyPassengerInfo($reservation) == true) readonly @endif>
                            @error("phone")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="email" class="form-label"><b>Email du passager</b></label>
                            <input type="email" class="form-control" id="email" autocomplete="off" placeholder="Email du passager" name="email" value="{{ old('email', CopyPassengerInfo($reservation) == true ? $reservation->email : '') }}" @if(CopyPassengerInfo($reservation) == true) readonly @endif>
                            @error("email")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="passport_number" class="form-label"><b>Numero d'identité du passager</b></label>
                            <input type="text" class="form-control" id="passport_number" autocomplete="off" placeholder="Numero d'identité du passager" name="passport_number" value="{{ old('passport_number') }}" required>
                            @error("passport_number")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="passport_file" class="form-label"><b>Pièce d'identité du passager</b></label>
                            <input type="file" class="form-control" id="passport_file" autocomplete="off" placeholder="Pièce d'identité du passager" name="passport_file" value="{{ old('passport_file') }}" required>
                            @error("passport_file")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="col-lg-4 mb-3">
                            <label for="departure_date" class="form-label"><b>Date de départ</b></label>
                            <input type="date" class="form-control" id="departure_date" autocomplete="off" placeholder="Date de départ" name="departure_date" value="{{ old('departure_date') }}" required>
                            @error("departure_date")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div> --}}
                        <div class="col-lg-4 mb-3" id="div_return_date">
                            <label for="return_date" class="form-label"><b>Date de retour</b></label>
                            <input type="date" class="form-control" id="return_date" autocomplete="off" placeholder="Date de retour" name="return_date" value="{{ old('return_date') }}">
                            @error("return_date")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9"></div>
                        <div class="col-md-3 mb-3">
                            <div class="text-center">
                                <button type="submit" class="btn-sm text-white btn btn-primary">Ajouter le passager</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customScripts')
    <script type="text/javascript">
        let fors = document.querySelectorAll('input[name="formula"]')

        let div = document.getElementById("div_return_date")
        let prev = null;
        for (let i = 0; i < fors.length; i++) {
            fors[i].addEventListener('change', function() {

                if(this.value == 'aller_simple') {
                    div.style.display = "none";
                } else {
                    div.style.display = "block";
                }
            });
        }
    </script>
@endsection('customScripts')

