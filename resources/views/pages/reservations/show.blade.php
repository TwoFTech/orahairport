@extends('layouts.app')

@section('content')
    <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
        <form class="forms-sample">
            <div class="row align-items-center">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h5>Consulter la réservation</h5>
                    <a href="{{ route('reservations.index') }}" class="btn-sm btn btn-info"><i class='link-icon' data-feather='list'></i> Liste des réservations</a>
                </div>
            </div>
        </form>
    </div>
    <div class="row sPointActions">
        <div class="col-12 mb-3">
            @if($reservation->pnr == null && $reservation->amount == null)
                <!-- <a class="btn-sm btn btn-warning" href="#"><i class='link-icon' data-feather='edit-3'></i> Modifier</a> -->
                <a class="btn-sm btn btn-danger" href="{{ route('reservations.destroy', ['reservation' => $reservation, 'token' => $reservation->token]) }}" onclick="return confirm('Voulez-vous vraiment effectuer cette opération ?')"><i class='link-icon' data-feather='arrow-left'></i> Annuler la réservation</a>
                @if($reservation->status == 'Créée')
                    @if($reservation->for == 'me')
                        @if(count($reservation->passengers) == 1)
                            <a class="btn-sm btn btn-dark ss" href="{{ route('reservations.send', ['reservation' => $reservation, 'token' => $reservation->token]) }}" onclick="return confirm('Voulez-vous vraiment soumettre cette réservation ?')"><i class='link-icon' data-feather='folder'></i> Soumettre</a>
                        @endif
                    @else
                        @if(count($reservation->passengers) == $reservation->passenger_number)
                            <a class="btn-sm btn btn-dark ss" href="{{ route('reservations.send', ['reservation' => $reservation, 'token' => $reservation->token]) }}" onclick="return confirm('Voulez-vous vraiment soumettre cette réservation ?')"><i class='link-icon' data-feather='folder'></i> Soumettre</a>
                        @endif
                    @endif
                @endif
                @if(isAdmin() || isResa() || isPrivate())
                    @if($reservation->status == 'En étude')
                        @if (ActiveButSubMitResa($reservation) == true)
                            <a class="btn-sm btn btn-dark" href="{{ route('reservations.study', ['reservation' => $reservation, 'token' => $reservation->token]) }}"><i class='link-icon' data-feather='folder'></i> Soumettre l'étude réalisée</a>
                        @endif
                    @endif
                @endif
            @else
                @if($reservation->status == 'Traitée')
                    <span class="btn-sm btn btn-warning">En attente de paiement du client</span>
                @endif
            @endif

            {{-- @if($reservation->pnr != null && $reservation->amount != null && $reservation->transaction_id == null)
                <form class="forms-sample" method="post" action="{{ route('reservations.paid', ['reservation' => $reservation, 'token' => $reservation->token]) }}">
                    @csrf
                    <script
                        src="https://cdn.fedapay.com/checkout.js?v=1.1.7"
                        data-public-key="pk_live_3C2-et5Xf21F8qqLsm8hIoex"
                        data-button-text="<i class='link-icon' data-feather='send'></i> Payer avec {{ getFormattedPrice($reservation->amount) }} F"
                        data-button-class="btn-sm text-white btn btn-info btn-pay"
                        data-transaction-amount="{{ $reservation->amount }}"
                        data-transaction-description="Finalisation de réservation"
                        data-customer-email="{{ Auth::user()->email }}"
                        data-customer-lastname="{{ Auth::user()->name }}"
                        data-customer-firstname="{{ Auth::user()->name }}"
                        data-customer-iso="XOF">
                    </script>
                </form>
            @endif --}}

            @if(isAdmin() || isResa() || isPrivate())
                @if($reservation->status === 'Payée')
                    <a class="btn-sm btn btn-dark" href="{{ route('reservations.finalize', ['reservation' => $reservation, 'token' => $reservation->token]) }}"><i class='link-icon' data-feather='folder'></i> Finaliser la réservation</a>
                @endif
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="mt-4">Liste des passagers</h5>
                    <div class="table-responsive">
                        <table id="passengersTable" class="table">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom & Prénom(s)</th>
                                    <th>Formule</th>
                                    <th>Catégorie</th>
                                    <th>Montant</th>
                                    <th>N° Billet</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reservation->passengers as $index => $passenger)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $passenger->lastname . ' ' . $passenger->firstname }}</td>
                                        <td>{{ $passenger->formula ? ($passenger->formula == 'aller_simple' ? 'Aller simple' : 'Aller retour') : '-' }}</td>
                                        <td>{{ $passenger->category ? $passenger->category : '-' }}</td>
                                        <td>{{ $passenger->amount ? getFormattedPrice($passenger->amount) . ' F' : 'Non défini.' }}</td>
                                        <td>{{ $passenger->ticket_number ? $passenger->ticket_number : '-' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('passengers.show', ['passenger' => $passenger, 'reservation' => $reservation, 'token' => $reservation->token]) }}" class="">Consulter</a> |
                                            <!-- <a href="#" class="text-warning">Modifier</a> | -->
                                            <a class="text-danger" href="{{ route('passengers.destroy', ['passenger' => $passenger, 'reservation' => $reservation, 'token' => $reservation->token]) }}" onclick="return confirm('Voulez-vous vraiment effectuer cette opération ?')">Supprimer</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            Il n'y a aucun passager !
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-4">
                            @if($reservation->status == 'Créée')
                                <a class="btn-sm btn btn-primary" @if(PassengerInResa($reservation) == false) hidden @endif href="{{ route('passengers.create', ['reservation' => $reservation, 'token' => $reservation->token]) }}">
                                    <i class='link-icon' data-feather='plus'></i>
                                     Ajouter un passager
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="mt-4">Détails de la réservation</h5>
                    <div class="table-responsive">
                        <table id="settingsTable" class="table">
                            <tbody>
                                <tr>
                                    <td width="30%">Pour</td>
                                    <td>{{ $reservation->for == 'me' ? 'Client seul' : ($reservation->for == 'meOthers' ? 'Client + Autre(s) passager(s)' : 'Autre(s) passager(s) uniquement') }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Choix de compagnie</td>
                                    <td>{{ $reservation->company }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Ville de départ</td>
                                    <td>{{ $reservation->departure_city }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Ville de destination</td>
                                    <td>{{ $reservation->destination_city }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Date de départ</td>
                                    <td>{{ date('d-m-Y', strtotime($reservation->departure_date)) }}</td>
                                </tr>
                                {{-- <tr>
                                    <td width="30%">Date de retour</td>
                                    <td>{{ $reservation->return_date != "1970-01-01" ? date('d-m-Y', strtotime($reservation->return_date)) : "-" }}</td>
                                </tr> --}}
                                @if($reservation->for != 'me')
                                    <tr>
                                        <td width="30%">Nombre de passager</td>
                                        <td>{{ $reservation->passenger_number }}</td>
                                    </tr>
                                @endif
                                <!-- <tr>
                                    <td width="30%">Choix de compagnie</td>
                                    <td>{{ $reservation->company ? $reservation->company : '-' }}</td>
                                </tr> -->
                                <tr>
                                    <td width="30%">Code de fidélité</td>
                                    <td>{{ $reservation->fidelity_code ? $reservation->fidelity_code : '-' }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Nom & Prénom(s)</td>
                                    <td>{{ $reservation->lastname }} {{ $reservation->firstname }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Numéro de téléphone</td>
                                    <td>{{ $reservation->phone }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Adresse email</td>
                                    <td>{{ $reservation->email }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Statut</td>
                                    <td><span class="status {{ $reservation->status ? '' : '' }}">{{ $reservation->status }}</span></td>
                                </tr>
                                <tr class="{{ $reservation->pnr ? 'text-success' : 'text-danger' }}">
                                    <td width="30%">Numéro PNR</td>
                                    <td>{{ $reservation->pnr ? $reservation->pnr : 'Numéro PNR non defini' }}</td>
                                </tr>
                                <tr class="{{ $reservation->amount ? 'text-success' : 'text-danger' }}">
                                    <td width="30%">
                                        Montant
                                        @if (ActiveButSubMitResa($reservation) == true)
                                            ( {{ getFormattedPrice($reservation->passengers->sum('amount')) . ' F' }} )
                                        @endif
                                    </td>
                                    <td>{{ $reservation->amount ? getFormattedPrice($reservation->amount) . ' F' : 'Non Payé' }}</td>
                                </tr>
                                {{-- <tr>
                                    <td width="30%">Fichiers</td>
                                    <td>
                                        @forelse(unserialize($reservation->files) as $index => $file)
                                            <p>
                                                <a href="{{ $file }}" target="_blank"><i class="link-icon" data-feather="file"></i> Consulter la pièce jointe #{{ ++$index }}</a>
                                            </p>
                                        @empty
                                            <p>
                                                Il n'y a pas d'images!
                                            </p>
                                        @endforelse
                                        @if($reservation->purchase)
                                            <p>
                                                <a href="{{ $reservation->purchase }}" target="_blank"><i class="link-icon" data-feather="file"></i> Consulter le bon de commande</a>
                                            </p>
                                        @endif
                                    </td>
                                </tr> --}}
                                @if($reservation->stand)
                                    <tr>
                                        <td width="30%">Initié par</td>
                                        <td>{{ $reservation->user->surname }} &bull; {{ $reservation->user->name }}</td>
                                    </tr>
                                @endif
                                @if($reservation->study_id)
                                    <tr>
                                        <td width="30%">Etudié par</td>
                                        <td>{{ getUserName($reservation->study_id) }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td width="30%">Créée le</td>
                                    <td>{{ $reservation->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Modifiée le</td>
                                    <td>{{ $reservation->updated_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
