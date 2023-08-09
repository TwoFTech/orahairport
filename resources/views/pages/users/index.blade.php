@extends('layouts.app')

@section('content')

    @section('nav')
        <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i>Nouveau</a>
    @endsection

    <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
        <form class="forms-sample">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <h5>Liste des utilisateurs</h5>
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
                                    <th>Nom Complet</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    {{-- @if(!isAdmin()) <th>Rôle</th> @endif --}}
                                    <th>Rôles</th>
                                    <th>Date de création</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $index => $user)
                                    <tr>
                                        {{-- <td>{{ $index +1 }}</td> --}}
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>{{ $user->phone }}</td>
                                        <td>
                                            <span class="status">
                                                @if(!empty($user->getRoleNames()))
                                                    @foreach($user->getRoleNames() as $role)
                                                        {{ showRole($role)  }}
                                                    @endforeach
                                                @endif
                                            </span>
                                        </td>
                                        {{-- @if(!isAdmin()) <td>{{ $user->pivot->role }}</td> @endif --}}
                                        <td>{{ $user->created_at }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('users.edit', $user) }}" class="text-info">Modifier</a> |
                                            <a onclick="confirm('Êtes-vous sûr {{ $user->status == true ? 'de désactiver' : 'd\'activer' }} cet utilisateur ?');" href="{{ route('users.active', $user) }}" class="{{ $user->status == true ? 'text-danger' : 'text-warning' }}">
                                                {{ $user->status == true ? 'Désactiver' : 'Activer' }}
                                            </a>
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
