@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Informations sur la réservation</h4>
                <form class="forms-sample" method="post" action="{{ route('reservations.done', ['stand' => $stand, 'token' => $stand->token]) }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="lastname" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="lastname" autocomplete="off" placeholder="Le nom du passager" name="lastname" value="{{ $reservation['lastname'] }}" readonly>
                            @error("lastname")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="firstname" class="form-label">Prénom(s)</label>
                            <input type="text" class="form-control" id="firstname" autocomplete="off" placeholder="Le prénom du passager" name="firstname" value="{{ $reservation['firstname'] }}" readonly>
                            @error("firstname")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="text" class="form-label">Numéro mobile</label>
                            <input type="text" class="form-control" id="phone" autocomplete="off" placeholder="Numéro de téléphone du passager" name="phone" value="{{ $reservation['phone'] }}" readonly>
                            @error("phone")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="text" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" autocomplete="off" placeholder="Adresse email du passager" name="email" value="{{ $reservation['email'] }}" readonly>
                            @error("email")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="text" class="form-label">Point de vente</label>
                            <input type="text" class="form-control" id="stand" autocomplete="off" placeholder="Point de vente" name="stand" value="{{ $stand->name }}" readonly>
                            @error("stand")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="text" class="form-label">Description</label>
                            <textarea style="height: 200px" name="description" class="form-control" required>{{ $reservation['description'] }}</textarea>
                            @error("description")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        @forelse(unserialize($reservation['files']) as $index => $file)
                            <div class="col-lg-3 mb-3">
                                <a href="{{ $file }}" target="_blank"><i class="link-icon" data-feather="file"></i> Consulter la pièce jointe #{{ ++$index }}</a>
                            </div>
                        @empty
                            <div class="col-lg-3 mb-3">
                                Il n'y a pas d'images!
                            </div>
                        @endforelse
                    </div>
                    
                    <a href="{{ route('reservations.create', ['stand' => $stand, 'edit' => 'edit', 'token' => $stand->token]) }}" class="btn-sm btn btn-dark btn-update"><i class='link-icon' data-feather='edit-3'></i> Modifier</a>
            
                    <button type="submit" class="btn-sm text-white btn btn-info btn-pay"><i class='link-icon' data-feather='send'></i> Confirmer</button>
                </form>
                @if($stand['country'] === 'Cameroun')
                    <form method="post" action="https://www.my-dohone.com/dohone/pay" style="margin-top: -40px;">
                        <input type="hidden" name="cmd" value="start">
                        <input type="hidden" name="rN" value="{{ Auth::user()->name }}">
                        <input type="hidden" name="rT" value="{{ Auth::user()->phone }}">
                        <input type="hidden" name="rH" value="MG216U34571964786098606">
                        <input type="hidden" name="rMt" value="{{ getStandAmount() }}">
                        <input type="hidden" name="rDvs" value="XAF">
                        <input type="hidden" name="source" value="Orahairport Travel">
                        <input type="hidden" name="endPage" value="{{ route('home') }}">
                        <input type="hidden" name="notifyPage" value="{{ route('home') }}">
                        <input type="hidden" name="cancelPage" value="{{ route('stands.payment') }}">
                        <button type="submit" class="btn-sm text-white btn btn-info btn-pay"><i class='link-icon' data-feather='send'></i> Payer {{ getFormattedPrice(getStandAmount()) }} F</button>
                    </form>
                @endif
            </div>
            
        </div>
    </div>
</div>
@endsection