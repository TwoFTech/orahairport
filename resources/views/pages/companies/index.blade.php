@extends('layouts.app')

@section('content')

    @section('nav')
        <a href="{{ route('companies.create') }}" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i>Nouvelle compagnie</a>
    @endsection

    <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
        <form class="forms-sample">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <h5>Liste des compagnies aériennes</h5>
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
                                    {{-- <th>N°</th> --}}
                                    <th>Nom</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(getCompanies() as $index => $company)
                                    <tr>
                                        {{-- <td>{{ $index +1 }}</td> --}}
                                        <td>{{ $company->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('companies.edit', $company) }}" class="text-info">Modifier</a> |
                                            <form class="d-inline-block" action="{{ route('companies.destroy', $company) }}" method="POST" onsubmit="return confirm('Etes-vous sûrs de la suppression?');">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn text-danger" style="padding: 0; margin-top: -2px;" value="Supprimer">
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="2">Aucune compagnie !</td></tr>
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
