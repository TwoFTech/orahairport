@extends('layouts.app')

@section('content')
    <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
        <form class="forms-sample">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <h5>Liste des points de vente</h5>
                </div>
                <!-- <div class="col-lg-6 col-md-4">
                    <input type="text" placeholder="Search by category title" class="form-control">
                </div> -->
                <!-- <div class="col-lg-3 col-md-4">
                    <select class="form-select form-select-lg">
                        <option selected>Show Entries</option>
                        <option value="1">10</option>
                        <option value="2">20</option>
                        <option value="3">30</option>
                    </select>
                </div> -->
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
                                    <th>Enseigne</th>
                                    <th>Pays &bull; Ville &bull; Quartier &bull; Rue</th>
                                    <th>Téléphone</th>
                                    <th>Statut</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stands as $index => $stand)
                                    <tr>
                                        <td>{{ count($stands) - $index }}</td>
                                        <td>{{ $stand->name }}</td>
                                        <td>
                                            {{ $stand->city->country->name }} &bull; {{ $stand->city->label }} &bull; {{ $stand->quartier }} &bull; {{ $stand->rue }}
                                        </td>
                                        <td>{{ $stand->phone }}</td>
                                        {{-- @if(!isAdmin()) <td>{{ $stand->pivot->role }}</td> @endif --}}
                                        <td><span class="status {{ $stand->status ? 'validated' : '' }}">{{ $stand->status ? 'Validé': 'En cours' }}</span></td>
                                        <td class="text-center">
                                            <a href="{{ route('stands.show', ['stand' => $stand, 'token' => $stand->token]) }}" class="">Consulter</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6">Il n'y a pas de demande de point de vente !</td></tr>
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