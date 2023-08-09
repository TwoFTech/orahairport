@extends('layouts.app')

@section('content')
    <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
        <form class="forms-sample">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <h5>Liste des promotions</h5>
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
                                    <th>Libéllé</th>
                                    <th>Code</th>
                                    <th>Pourcentage</th>
                                    <th>Début</th>
                                    <th>Fin</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($promos as $index => $promo)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $promo->name }}</td>
                                        <td>{{ $promo->code }}</td>
                                        <td>{{ $promo->percentage }}</td>
                                        <td>{{ $promo->begin->format('d-m-Y') }}</td>
                                        <td>{{ $promo->end->format('d-m-Y') }}</td>
                                        <td class="text-center">
                                            <a href="#" class="">Consulter</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6">Il n'y a pas code promo !</td></tr>
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