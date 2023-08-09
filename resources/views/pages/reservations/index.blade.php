@extends('layouts.app')

@section('content')
    <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
        <form class="forms-sample">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <h5>Liste des réservations</b></h5>
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
                                    <th>Client</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th>Compagnie</th>
                                    <th>Statut</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reservations as $index => $reservation)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $reservation->lastname }} {{ $reservation->firstname }}</td>
                                        <td>
                                            {{ $reservation->phone }}
                                        </td>
                                        <td>{{ $reservation->email }}</td>
                                        <td>{{ $reservation->company }}</td>
                                        <td><span class="statut validated">{{ $reservation->status }}</span></td>
                                        <td class="text-center">
                                            <a href="{{ route('reservations.show', ['reservation' => $reservation, 'token' => $reservation->token]) }}" class="">Consulter</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6">Il n'y a pas encore de réservation enregistrée !</td></tr>
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
