@extends('layouts.app')

@section('content')
    <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
        <form class="forms-sample">
            <div class="row align-items-center">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h5>Liste des pays</h5>
                    <a href="{{ route('settings.index') }}" class="btn btn-info">Liste des paramètres</a>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="countriesTable" class="table">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th width="20%">Image</th>
                                    <th>Nom</th>
                                    <th>Code</th>
                                    <th>Statut</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($countries as $index => $country)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td><img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/flags/4x3/'.strtolower($country->code).'.svg') }}"></td>
                                        <td>{{ $country->name }}</td>
                                        <td>{{ $country->code }}</td>
                                        <td><span class="country {{ $country->status ? 'countryApproved' : 'countryUnapproved' }}">{{ $country->status ? "Approuvé" : "Non approuvé" }}</span></td>
                                        <td class="text-center">
                                            @if($country->status)
                                                <a href="{{ route('countries.proved', ['state' => 'false', 'country' => $country]) }}" style="color: red">Désapprouver</a>
                                            @else
                                                <a href="{{ route('countries.proved', ['state' => 'true', 'country' => $country]) }}">Approuver</a>
                                            @endif  
                                        </td>
                                    </tr>
                                @endforeach
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