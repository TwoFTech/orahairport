@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Réservation</h4>
                <form class="reservation" method="post" action="{{ route('reservations.store', ['stand' => $stand, 'token' => $stand->token]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="for" class="form-label"><b>Pour</b></label><br>
                            <span class="form-check form-switch">
                                <input type="radio" name="for" value="me" checked class="form-check-input">Client(e) seul(e)
                            </span>
                            <span class="form-check form-switch">
                                <input type="radio" name="for" value="meOthers" class="form-check-input">Autre(s) passager(s) et client(e)
                            </span>
                            <span class="form-check form-switch">
                                <input type="radio" name="for" value="others" class="form-check-input">Autre(s) passager(s) uniquement
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <label for="lastname" class="form-label"><b>Nom du client</b></label>
                            <input type="text" class="form-control" id="lastname" autocomplete="off" placeholder="Nom du client" name="lastname" value="{{ old('lastname') }}" required>
                            @error("lastname")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="firstname" class="form-label"><b>Prénom du client</b></label>
                            <input type="text" class="form-control" id="firstname" autocomplete="off" placeholder="Prénom du client" name="firstname" value="{{ old('firstname') }}" required>
                            @error("firstname")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="phone" class="form-label"><b>Téléphone du client</b></label>
                            <input type="text" class="form-control" id="phone" autocomplete="off" placeholder="Téléphone du client" name="phone" value="{{ old('phone') }}" required>
                            @error("phone")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="email" class="form-label"><b>Email du client</b></label>
                            <input type="email" class="form-control" id="email" autocomplete="off" placeholder="Email du client" name="email" value="{{ old('email') }}" required>
                            @error("email")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="company" class="form-label"><b>Choix de compagnie</b></label>
                            <select id="company" class="form-control selectpicker" name="company" required>
                                <option default hidden value>-- Sélectionner la compagnie --</option>
                                @forelse(getCompanies() as $index => $company)
                                    <option value="{{ $company->name }}" {{ old('company') == $company->name ? 'selected' : '' }}>{{ $company->name }}</option>
                                @empty
                                    <option value>Il n'y a pas de compagnie !</option>
                                @endforelse
                            </select>
                            @error("company")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="passenger_number" class="form-label"><b>Nombre de passager</b></label>
                            <input type="number" class="form-control" id="passenger_number" autocomplete="off" placeholder="Nombre de passager" name="passenger_number" value="{{ old('passenger_number', 1) }}" required readonly>
                            @error("passenger_number")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <label for="departure_city" class="form-label"><b>Ville de départ</b></label>
                            <input type="text" class="form-control" id="departure_city" autocomplete="off" placeholder="Ville de départ" name="departure_city" value="{{ old('departure_city') }}" required>
                            @error("departure_city")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="destination_city" class="form-label"><b>Ville de destination</b></label>
                            <input type="text" class="form-control" id="destination_city" autocomplete="off" placeholder="Ville de destination" name="destination_city" value="{{ old('destination_city') }}" required>
                            @error("destination_city")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="departure_date" class="form-label"><b>Date de départ</b></label>
                            <input type="date" class="form-control" id="departure_date" autocomplete="off" placeholder="Date de départ" name="departure_date" value="{{ old('departure_date') }}" required>
                            @error("departure_date")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        {{-- <div class="col-lg-4 mb-3">
                            <label for="return_date" class="form-label"><b>Date de retour</b></label>
                            <input type="date" class="form-control" id="return_date" autocomplete="off" placeholder="Date de retour" name="return_date" value="{{ old('return_date') }}">
                            @error("return_date")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div> --}}

                        <div class="col-lg-4 mb-3">
                            <label for="fidelity_code" class="form-label"><b>Code de fidélité</b></label>
                            <input type="text" class="form-control" id="fidelity_code" autocomplete="off" placeholder="Code de fidélité" name="fidelity_code" value="{{ old('fidelity_code') }}">
                            @error("fidelity_code")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="merchant" class="form-label text-info"><b>Point de vente</b></label>
                            <input type="text" class="form-control" autocomplete="off" value="{{ getStandActive()->name }}" disabled>
                            @error("merchant")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-9"></div>
                        <div class="col-md-3 mb-3">
                            <div class="text-center">
                                <button type="submit" class="btn-sm text-white btn btn-primary">Créer la réservation</button>
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
        let fors = document.querySelectorAll('input[name="for"]')
        let passenger = document.querySelector('input[name="passenger_number"]')
        let prev = null;
        for (let i = 0; i < fors.length; i++) {
            fors[i].addEventListener('change', function() {
                // (prev) ? console.log(prev.value): null;
                // if (this !== prev) {
                //     prev = this;
                // }
                if(this.value == 'me') {
                    passenger.value = 1
                    passenger.setAttribute('readonly', true)
                } else {
                    passenger.value = '2'
                    passenger.removeAttribute('readonly')
                }
            });
        }
    </script>
@endsection('customScripts')
