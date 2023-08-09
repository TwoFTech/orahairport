@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Etude des infos du passager</h4>
                <form class="forms-passenger" method="post" action="{{ route('passengers.study.post', ['passenger' => $passenger, 'reservation' => $reservation, 'token' => $reservation->token, 'step' => $step]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        @if($step == 1)
                            <div class="col-lg-4 mb-3">
                                <label for="amount" class="form-label"><b>Montant du billet</b></label>
                                <input type="text" class="form-control" id="amount" autocomplete="off" placeholder="Montant du billet" name="amount" value="{{ old('amount') }}" required>
                                @error("amount")
                                    <p class="text-danger"><small>{{ $message }}</small></p>
                                @enderror
                            </div>
                        @endif
                        @if($step == 2)
                            <div class="col-lg-4 mb-3">
                                <label for="ticket_number" class="form-label"><b>Numéro du billet</b></label>
                                <input type="text" class="form-control" id="ticket_number" autocomplete="off" placeholder="Numéro du billet" name="ticket_number" value="{{ old('ticket_number') }}" required>
                                @error("ticket_number")
                                    <p class="text-danger"><small>{{ $message }}</small></p>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="ticket_file" class="form-label"><b>Billet</b></label>
                                <input type="file" class="form-control" id="ticket_file" autocomplete="off" placeholder="Billet" name="ticket_file" value="{{ old('ticket_file') }}" required>
                                @error("ticket_file")
                                    <p class="text-danger"><small>{{ $message }}</small></p>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-9"></div>
                        <div class="col-md-3 mb-3">
                            <div class="text-center">
                                @if($step === 1)
                                    <button type="submit" class="btn-sm text-white btn btn-primary"><i class="link-icon" data-feather="credit-card"></i> Définir le montant</button>
                                @else
                                    <button type="submit" class="btn-sm text-white btn btn-primary"><i class="link-icon" data-feather="image"></i> Définir les infos de billet</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection