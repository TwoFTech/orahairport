@extends('layouts.app')

@section('content')
    <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
        <form class="forms-sample">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <h5>Paramètres</h5>
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
                                    <td width="30%">Montant d'abonnement par an sur point de vente</td>
                                    <td width="60%">{{ getFormattedPrice($settings->stand_amount) }} {{ $settings->currency }}</td>
                                    <td width="10%"><a href="{{ route('settings.edit', 'stand_amount') }}">Modifier</a></td>
                                </tr>
                                <tr>
                                    <td>Commission des développeurs par abonnement sur points de vente</td>
                                    <td>{{ $settings->dev_commission_on_point * 100 }}% &bull; {{ getFormattedPrice($settings->dev_commission_on_point * $settings->stand_amount) }} {{ $settings->currency }}</td>
                                    <td><a href="{{ route('settings.edit', 'dev_commission_on_point') }}">Modifier</a></td>
                                </tr>
                                <tr>
                                    <td>Commission des développeurs sur les réservations</td>
                                    <td>{{ $settings->dev_commission_on_reservation * 100 }}% des réservations</td>
                                    <td><a href="{{ route('settings.edit', 'dev_commission_on_reservation') }}">Modifier</a></td>
                                </tr>
                                <tr>
                                    <td>Taux TVA</td>
                                    <td>{{ $settings->tva_tax * 100 }}%</td>
                                    <td><a href="{{ route('settings.edit', 'tva_tax') }}">Modifier</a></td>
                                </tr>
                                <tr>
                                    <td>Devise</td>
                                    <td>XOF</td>
                                    <td><a href="{{ route('settings.edit', 'currency') }}">Modifier</a></td>
                                </tr>
                                <tr>
                                    <td>Pays autorisés</td>
                                    <td>
                                        @forelse($countriesAccepted as $index => $country)
                                            <span class="country"><img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/flags/4x3/'.strtolower($country->code).'.svg') }}">{{ $country->name }}</span>
                                        @empty
                                            <span class="text-danger">Aucun pays n'est pour le moment accepté !</span>
                                        @endforelse
                                    </td>
                                    <td>
                                        <a href="{{ route('countries.index') }}">Modifier</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        
    </div>
@endsection