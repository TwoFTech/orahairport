@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Etude de la Réservation</h4>
                <form class="forms-sample" method="post" action="{{ route('reservations.study.post', ['reservation' => $reservation, 'token' => $reservation->token]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <label for="pnr" class="form-label"><b>Numéro PNR de la réservation</b></label>
                            <input type="text" class="form-control" id="pnr" autocomplete="off" placeholder="Numéro PNR de la réservation" name="pnr" value="{{ old('pnr') }}" required>
                            @error("pnr")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="amount" class="form-label"><b>Montant de la réservation</b></label>
                            <input type="text" class="form-control" id="amount" autocomplete="off" placeholder="Montant de la réservation" name="amount" value="{{ getFormattedPrice($reservation->passengers->sum('amount')) . ' F' }}" required readonly>
                            @error("amount")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9"></div>
                        <div class="col-md-3 mb-3">
                            <div class="">
                                <button type="submit" class="btn-sm text-white btn btn-primary ss"><i class="link-icon" data-feather="send"></i> Valider</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection