@extends('layouts.app')

@section('content')
    <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
        <form class="forms-sample">
            <div class="row align-items-center">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h5>Consulter le passager</h5>
                    <a href="{{ route('reservations.show', ['reservation' => $reservation, 'token' => $reservation->token]) }}" class="btn-sm btn btn-info"><i class='link-icon' data-feather='back'></i> Aller à la réservation</a>
                </div>
            </div>
        </form>
    </div>
    <div class="row sPointActions mb-3">
        <div class="col-12">
            @if($reservation->pnr == null && $reservation->amount == null)
                <!-- <a class="btn-sm btn btn-warning" href="#"><i class='link-icon' data-feather='edit-3'></i> Modifier</a> -->
                <a class="btn-sm btn btn-danger" href="{{ route('passengers.destroy', ['passenger' => $passenger, 'reservation' => $reservation, 'token' => $reservation->token]) }}" onclick="return confirm('Voulez-vous vraiment effectuer cette opération ?')"><i class='link-icon' data-feather='trash'></i> Supprimer</a>
                @if($reservation->status == 'En étude')
                    <a class="btn-sm btn {{ $passenger->amount == null ? 'btn-dark' : 'btn-warning text-white'}}" href="{{ route('passengers.study', ['passenger' => $passenger, 'reservation' => $reservation, 'token' => $reservation->token, 'step' => 1]) }}">
                        <i class='link-icon' data-feather='folder'></i>
                        {{ $passenger->amount == null ? 'Définir' : 'Modifier'}} le montant
                    </a>
                @endif
            @else
                @if($reservation->status === 'Payée' && ($passenger->ticket_number == null || $passenger->ticket_file == null))
                    <a class="btn-sm btn btn-dark" href="{{ route('passengers.study', ['passenger' => $passenger, 'reservation' => $reservation, 'token' => $reservation->token, 'step' => 2]) }}"><i class='link-icon' data-feather='folder'></i> Définir un billet</a>
                @endif
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="settingsTable" class="table">
                            <tbody>
                                <tr>
                                    <td width="30%">Formule</td>
                                    <td>{{ $passenger->formula ? ($passenger->formula == 'aller_simple' ? 'Aller simple' : 'Aller retour') : '-' }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Catégorie</td>
                                    <td>{{ $passenger->category ? $passenger->category : '' }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Classe</td>
                                    <td>{{ $passenger->cabin ? $passenger->cabin : '' }}</td>
                                </tr>
                                {{-- <tr>
                                    <td width="30%">Ville de départ</td>
                                    <td>{{ $reservation->departure_city }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Ville de destination</td>
                                    <td>{{ $reservation->destination_city }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Date de départ</td>
                                    <td>{{ date('d-m-Y', strtotime($passenger->departure_date)) }}</td>
                                </tr> --}}
                                @if($passenger->return_date != null)
                                    <tr>
                                        <td width="30%">Date de retour</td>
                                        <td>{{ $passenger->return_date }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td width="30%">Nom & Prénom(s)</td>
                                    <td>{{ $passenger->lastname }} {{ $passenger->firstname }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Numéro de téléphone</td>
                                    <td>{{ $passenger->phone ? $passenger->phone : '-' }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Adresse email</td>
                                    <td>{{ $passenger->email ? $passenger->email : '-' }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Numéro passeport</td>
                                    <td>{{ $passenger->passport_number ? $passenger->passport_number : '-' }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Fichier passeport</td>
                                    <td>
                                        @if($passenger->passport_file)
                                            <a href="{{ $passenger->passport_file }}" target="_blank"><i class="link-icon" data-feather="file"></i> Consulter la pièce jointe</a>
                                        @else
                                            -
                                        @endif

                                        {{-- @forelse(unserialize($passenger->files) as $index => $file)
                                            <p>
                                                <a href="{{ $file }}" target="_blank"><i class="link-icon" data-feather="file"></i> Consulter la pièce jointe #{{ ++$index }}</a>
                                            </p>
                                        @empty
                                            <p>
                                                Il n'y a pas d'images!
                                            </p>
                                        @endforelse
                                        @if($passenger->purchase)
                                            <p>
                                                <a href="{{ $passenger->purchase }}" target="_blank"><i class="link-icon" data-feather="file"></i> Consulter le bon de commande</a>
                                            </p>
                                        @endif --}}
                                    </td>
                                </tr>
                                <tr class="{{ $passenger->amount ? 'text-success' : 'text-danger' }}">
                                    <td width="30%">Montant</td>
                                    <td>{{ $passenger->amount ? getFormattedPrice($passenger->amount) . ' F' : 'Pas de montant' }}</td>
                                </tr>
                                <tr class="{{ $passenger->ticket_number ? 'text-success' : 'text-danger' }}">
                                    <td width="30%">Numéro du billet</td>
                                    <td>{{ $passenger->ticket_number ? $passenger->ticket_number : 'Pas de billet' }}</td>
                                </tr>
                                <tr class="{{ $passenger->ticket_file ? 'text-success' : 'text-danger' }}">
                                    <td width="30%">Fichier du billet</td>
                                    <td>
                                        @if($passenger->ticket_file)
                                            <a href="{{ $passenger->ticket_file }}" target="_blank"><i class="link-icon" data-feather="file"></i> Consulter le billet</a>
                                        @else
                                            Pas de billet
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Créée le</td>
                                    <td>{{ $passenger->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Modifiée le</td>
                                    <td>{{ $passenger->updated_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
