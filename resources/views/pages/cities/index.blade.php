@extends('layouts.app')

@section('content')

    @section('nav')
        <a href="{{ route('cities.create') }}" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i>Nouveau</a>
    @endsection

    <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
        <form class="forms-sample">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <h5>{{ $title }}</h5>
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
                                    <th>#</th>
                                    <th>Libellé Ville</th>
                                    <th>Pays</th>
                                    <th>Date de création</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cities as $index => $city)
                                    <tr>
                                        <td>{{ $index +1 }}</td>
                                        <td>{{ $city->label }}</td>
                                        <td>{{ $city->country->name }}</td>
                                        <td>{{ $city->created_at }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('cities.edit', $city) }}" class="text-info">Modifier</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6">Aucun utilisateur trouvé !</td></tr>
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
