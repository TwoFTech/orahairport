@extends('layouts.app')

@section('content')
    <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
        <form class="forms-sample">
            <div class="row align-items-center">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h5>Liste des contacts {{ $category ? 'clients' : ' recommandés' }}</h5>
                    <!-- <a href="mailto:{{ $contacts->implode('email', ';') }}" class="btn-sm text-white btn btn-info"><i class="link-icon" data-feather="mail"></i> Mail de masse</a> -->
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
                                    <th>Nom & Prénom(s)</th>
                                    <th>Téléphone</th>
                                    <!-- <th>Email</th> -->
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contacts as $index => $contact)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ !$category ? $contact->name : $contact->lastname . ' ' . $contact->firstname }}</td>
                                        <td>
                                            {{ $contact->phone }}
                                        </td>
                                        <!-- <td>{{ $contact->email }}</td> -->
                                        <td class="text-center">
                                            <a href="https://wa.me/{{ $contact->phone }}" class="" target="_blank">Whatsapp</a> | 
                                            <!-- <a href="mailto:{{ $contact->email }}" class="">Courrier</a> -->
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6">Il n'y a pas de contact !</td></tr>
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