@extends('layouts.app')

@section('content')
    <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
        <form class="forms-sample">
            <div class="row align-items-center">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h5>Consulter un point de vente</h5>
                    <a href="{{ route('stands.index') }}" class="btn-sm btn btn-info"><i class='link-icon' data-feather='list'></i> Liste des points de vente</a>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="settingsTable" class="table">
                            <tbody>
                                <tr>
                                    <td width="30%">Enseigne</td>
                                    <td>{{ $stand->name }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Statut</td>
                                    <td><span class="status {{ $stand->status ? 'validated' : '' }}">{{ $stand->status ? 'Validé' : 'En cours' }}</span></td>
                                </tr>
                                <tr>
                                    <td width="30%">Numéro de téléphone</td>
                                    <td>{{ $stand->phone }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">ID de transfert</td>
                                    <td>{{ $stand->id_transfert }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Réglé par</td>
                                    <td>{{ $stand->pay_by }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Pays</td>
                                    <td>{{ $stand->city->country->name }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Ville</td>
                                    <td>{{ $stand->city->label }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Quartier</td>
                                    <td>{{ $stand->quartier }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Indication</td>
                                    <td>{{ $stand->indication ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Rue</td>
                                    <td>{{ $stand->rue }}</td>
                                </tr>
                                @if($stand->status == true)
                                    <tr style="color: red;">
                                        <td width="30%">Abonnement</td>
                                        <td>{{ getSubscriptionDelay($stand) }} jours restants</td>
                                    </tr>

                                    <tr>
                                        <td width="30%">Validé par</td>
                                        <td>{{ getStandValidatorName($stand) }}</td>
                                    </tr>

                                    <tr>
                                        <td width="30%">Total commission</td>
                                        <td>{{ getFormattedPrice($stand->scommissions->sum('amount')) }} F</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td width="30%">Créé le</td>
                                    <td>{{ $stand->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Modifié le</td>
                                    <td>{{ $stand->updated_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row sPointActions">
        <div class="col-12">
            @if(isResa() || isPrivate() || isBusinessDev())
                @if($stand->status == false)
                    <a class="btn-sm btn btn-info" href="{{ route('stands.edit', ['stand' => $stand, 'token' => $stand->token]) }}"><i class='link-icon' data-feather='edit-3'></i> Modifier</a>
                    <a class="btn-sm btn btn-primary ss" href="{{ route('stands.validated', ['stand' => $stand, 'token' => $stand->token]) }}" onclick="return confirm('Voulez-vous vraiment valider cette demande ?')"><i class='link-icon' data-feather='check'></i> Valider</a>
                @endif
            @endif

            @if(getStandOwner($stand) === Auth::id())
                <a class="btn-sm btn btn-info" href="{{ route('stands.delegate', ['stand' => $stand, 'token' => $stand->token]) }}"><i class='link-icon' data-feather='plus'></i> Déléguer le point de vente</a>
            @endif
        </div>
    </div>
@endsection
