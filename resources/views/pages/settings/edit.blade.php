@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Modifier des paramètres</h4>
                <form class="forms-sample" method="post" action="{{ route('settings.update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="stand_amount" class="form-label">Montant d'abonnement par an sur point de vente</label>
                            <input type="text" class="form-control" id="stand_amount" autocomplete="off" placeholder="Montant de la création de point de vente" name="stand_amount" value="{{ old('stand_amount', $settings->stand_amount) }}" {{ $field == "stand_amount" ? "autofocus" : "" }}>
                            @error("stand_amount")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="dev_commission_on_point" class="form-label">Commission des développeurs par abonnement sur points de vente</label>
                            <input type="text" class="form-control" id="dev_commission_on_point" autocomplete="off" placeholder="Commission des développeurs sur les points de vente" name="dev_commission_on_point" value="{{ old('dev_commission_on_point', $settings->dev_commission_on_point) }}" {{ $field == "dev_commission_on_point" ? "autofocus" : "" }}>
                            @error("dev_commission_on_point")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="dev_commission_on_reservation" class="form-label">Commission des développeurs sur les réservations</label>
                            <input type="text" class="form-control" id="dev_commission_on_reservation" autocomplete="off" placeholder="Commission des développeurs sur les réservations" name="dev_commission_on_reservation" value="{{ old('dev_commission_on_reservation', $settings->dev_commission_on_reservation) }}" {{ $field == "dev_commission_on_reservation" ? "autofocus" : "" }}>
                            @error("dev_commission_on_reservation")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="tva_tax" class="form-label">Taux TVA</label>
                            <input type="text" class="form-control" id="tva_tax" autocomplete="off" placeholder="Taux TVA" name="tva_tax" value="{{ old('tva_tax', $settings->tva_tax) }}" {{ $field == "tva_tax" ? "autofocus" : "" }}>
                            @error("tva_tax")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="currency" class="form-label">Devise</label>
                            <input type="text" class="form-control" id="currency" autocomplete="off" placeholder="Devise" name="currency" value="{{ old('currency', $settings->currency) }}" {{ $field == "currency" ? "autofocus" : "" }}>
                            @error("currency")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="text-center">
                            <a href="{{ route('settings.index') }}" class="btn-sm text-white btn btn-dark"><i class="link-icon" data-feather=""></i> Annuler</a>
                            <button type="submit" class="btn-sm text-white btn btn-info"><i class="link-icon" data-feather="send"></i> Effectuer les modifications</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection