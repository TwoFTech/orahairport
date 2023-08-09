@extends('layouts.app')

@section('content')
    <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
        <form class="forms-sample">
            <div class="row align-items-center">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    @if(Route::currentRouteName() == "sCommissions.specific")
                        <h5>Liste de vos commissions</h5>
                    @else
                        <h5>Liste des commissions des points marchands</h5>
                    @endif
                    @if(!isMerchant())
                        <span>Montant total: {{ getStandCommissionsTotal() }}</span>
                    @endif
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="pointsTable" class="table">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Montant</th>
                                    <th>Type</th>
                                    <th class="text-center">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($scommissions as $index => $scommission)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ getFormattedPrice($scommission->amount) }} F</td>
                                        <td>
                                            {{ $scommission->type }}
                                        </td>
                                        <td class="text-center"><span class="status {{ $scommission->status == 'unsold' ? '' : 'validated' }}">{{ $scommission->status == "unsold" ? "Non payé" : "Payé" }}</span></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6">
                                        @if(Route::currentRouteName() == "sCommissions.specific")
                                            Il n'y a pas de commission pour vous pour le point de vente actif.
                                        @else
                                            Il n'y a pas de commission pour les points marchands!
                                        @endif
                                    </td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- <div class="dataTables_paginate">
            <ul class="pagination">
                <li class="paginate_button page-item">
                    <a href="#" class="page-link">Previous</a>
                </li>
                <li class="paginate_button page-item active"><a href="#" class="page-link">1</a></li>
                <li class="paginate_button page-item"><a href="#" class="page-link">2</a></li>
                <li class="paginate_button page-item"><a href="#" class="page-link">3</a></li>
                <li class="paginate_button page-item"><a href="#" class="page-link">Next</a></li>
            </ul>
        </div> -->
    </div>
@endsection