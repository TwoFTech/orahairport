@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Demande de point de vente</h4>
                <form class="forms-sample" method="post" action="{{ route('stands.store') }}">
                    @csrf
                    <div class="row">
                        <!-- <div class="col-lg-12 mb-3">
                            <label for="upload" class="form-label">Coupon Banner Image</label>
                            <input class="form-control" type="file" id="upload">
                        </div> -->
                        <div class="col-lg-6 mb-3">
                            <label for="fullname" class="form-label">Enseigne</label>
                            <input type="text" class="form-control" id="enseigne" autocomplete="off" placeholder="L'enseigne du point de vente" name="enseigne" value="{{ old('enseigne', $stand['name']) }}" required>
                            @error("enseigne")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="text" class="form-label">Numéro de Téléphone du point de vente</label><br>
                            <input type="text" class="form-control" id="phone" autocomplete="off" placeholder="Numéro de Téléphone du point de vente" name="phone" value="{{ old('phone', $stand['phone']) }}" required>
                            @error("phone")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="text" class="form-label">Pays</label>
                            <!-- <input type="text" class="form-control" id="country" autocomplete="off" placeholder="Pays du point de vente" name="country" value="Bénin" required> -->
                            <select id="country" class="form-control selectpicker" name="country" required>
                                <option default hidden value>-- Sélectionner le pays --</option>
                                @forelse(getCountries() as $index => $country)
                                    <option value="{{ $country->name }}" data-thumbnail="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/flags/4x3/'.strtolower($country->code).'.svg') }}" {{ old('country', $stand['country']) == $country->name ? 'selected' : '' }}>{{ $country->name }}</option>
                                @empty
                                    <option value>Il n'y a pas encore de pays approuvé !</option>
                                @endforelse
                            </select>
                            @error("country")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="text" class="form-label">Ville</label>
                            <select id="city" class="form-control selectpicker" name="city" required>
                                <option default hidden value>-- Sélectionner la ville --</option>
                                @forelse(getCities() as $index => $city)
                                    <option value="{{ $city->id }}" {{ old('city', $stand['city']) == $city->id ? 'selected' : '' }}>{{ $city->label }}</option>
                                @empty
                                    <option value>Il n'y a pas encore de villes approuvées !</option>
                                @endforelse
                                @error("city")
                                    <p class="text-danger"><small>{{ $message }}</small></p>
                                @enderror
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="text" class="form-label">Quartier</label>
                            <input type="text" class="form-control" id="phone" autocomplete="off" placeholder="Quartier" name="quartier" value="{{ old('quartier', $stand['quartier']) }}" required>
                            @error("quartier")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="text" class="form-label">Rue</label>
                            <input type="text" class="form-control" id="rue" autocomplete="off" placeholder="Rue" name="rue" value="{{ old('rue', $stand['rue']) }}" required>
                            @error("rue")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-3">
                            <input type="checkbox" class="" id="reduc" name="reduc" {{ $stand['reduc'] == "on" ? "checked" : "" }}>
                            <label for="reduc" class="form-label">Je veux fournir cinq contacts pour bénéficier de 20% de réduction.</label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn-sm text-white btn btn-info"><i class="link-icon" data-feather="send"></i> Faire Ma Demande</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection