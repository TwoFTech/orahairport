@extends('layouts.app')

@section('content')

    @section('nav')
        <a href="{{ route('centers.create') }}" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i>Nouveau</a>
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
                                    <th>Nom Centre</th>
                                    <th>Siège Social</th>
                                    <th>Téléphone</th>
                                    <th>Email Service</th>
                                    <th>Pays</th>
                                    <th>Date de création</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($centers as $index => $center)
                                    <tr>
                                        <td>{{ $index +1 }}</td>
                                        <td>{{ $center->name }}</td>
                                        <td>{{ $center->headquarters }}</td>
                                        <td>{{ $center->phone }}</td>
                                        <td>{{ $center->email }}</td>
                                        <td>{{ $center->country->name }}</td>
                                        <td>{{ $center->created_at }}</td>
                                        <td class="text-center">
                                            {{-- <a href="{{ route('centers.show', $center) }}" class="text-info">Plus Détails</a> | --}}
                                            <a href="{{ route('centers.edit', $center) }}" class="text-warning">Modifier</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6">Aucun centre trouvé !</td></tr>
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
