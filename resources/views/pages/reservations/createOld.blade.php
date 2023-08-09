@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Réservation</h4>
                @role('merchant|manager')
                    <form class="reservation" method="post" action="{{ route('reservations.store', ['stand' => $stand, 'token' => $stand->token]) }}" enctype="multipart/form-data">
                @endrole
                @role('dev|admin|super-admin')
                    <form class="reservation" method="post" action="{{ route('reservations.store') }}" enctype="multipart/form-data">
                @endrole
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <label for="firstname" class="form-label"><b>Prénom du passager</b></label>
                            <input type="text" class="form-control" id="firstname" autocomplete="off" placeholder="Prénom du passager" name="firstname" value="{{ $reservation ? old('firstname', $reservation['firstname']) : old('firstname') }}" required>
                            @error("firstname")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="lastname" class="form-label"><b>Nom du passager</b></label>
                            <input type="text" class="form-control" id="lastname" autocomplete="off" placeholder="Nom du passager" name="lastname" value="{{ $reservation ? old('lastname', $reservation['lastname']) : old('lastname') }}" required>
                            @error("lastname")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="phone" class="form-label"><b>Téléphone du passager</b></label>
                            <input type="text" class="form-control" id="phone" autocomplete="off" placeholder="Téléphone du passager" name="phone" value="{{ $reservation ? old('phone', $reservation['phone']) : old('phone') }}" required>
                            @error("phone")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="email" class="form-label"><b>Email du passager</b></label>
                            <input type="email" class="form-control" id="email" autocomplete="off" placeholder="Email du passager" name="email" value="{{ $reservation ? old('email', $reservation['email']) : old('email') }}" required>
                            @error("email")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="description" class="form-label"><b>Description de la réservation</b> (Type de billet, Ville de départ, Ville d'arrivée, Nombre de passager, Informations sur passagers, Choix de compagnie)</label>
                            <textarea style="height: 200px" name="description" class="form-control" required placeholder="Description de la réservation">{{ $reservation ? old('description', $reservation['description']) : old('description') }}</textarea>
                            @error("description")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-3">
                            <label for="files" class="form-label"><b>Pièces</b></label>
                            <input type="file" class="form-control" id="files" autocomplete="off" name="files[]" multiple>
                            @error("files")
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