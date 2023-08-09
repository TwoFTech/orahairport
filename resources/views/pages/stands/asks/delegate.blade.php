@extends('layouts.app')

@section('content')
    <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
        <form class="forms-sample">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <h5>Délégation du point de vente</h5>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- <form class="row align-items-center" method="post" action="{{ route('stands.delegated', ['stand' => $stand, 'token' => $stand->token]) }}"> -->
                    <form class="row align-items-center" method="post" action="#">
                        @csrf
                        <div class="col-lg-3 col-md-6">
                            <select id="user" class="form-control selectpicker" name="user" required>
                                <option default hidden value>-- Sélectionner l'utilisateur --</option>
                                @forelse(getUsers() as $index => $user)
                                    <option value="{{ $user->id }}" {{ old('user') == $user->name ? 'selected' : '' }}>{{ $user->name }}</option>
                                @empty
                                    <option value>Il n'y a pas d'autre utilisateur marchand !</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <button type="submit" class="btn-sm text-white btn btn-info"><i class="link-icon" data-feather="plus"></i> Ajouter</button>
                        </div>
                    </form>
                    @error("user")
                        <p class="text-danger"><small>{{ $message }}</small></p>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="settingsTable" class="table">
                            <tbody>
                                <tr>
                                    <td width="10%">Propriétaire</td>
                                    <td width="60%">{{ getUserName(Auth::user()->stands->first()->pivot->user_id) }}</td>
                                    <td width="30%">Contrôle total sur le point de vente</td>
                                </tr>
                                <tr>
                                    <td>Gérants</td>
                                    <td>
                                        <table id="delegateTable">
                                            @if($stand->users->count() <= 1)
                                                <tr>
                                                    <td>Vous n'avez pas encore ajouté d'utilisateur !</td>
                                                </tr>
                                            @else
                                                @foreach($stand->users as $index => $user)
                                                    @if($index != 0)
                                                        <tr>
                                                            <td width="60%">{{ getUserName($user->pivot->user_id) }}</td>
                                                            <td width="40%"><span class="status confirmed">En attente de confirmation</span></td>
                                                            <td>x</td>
                                                        </tr>
                                                    @endif                                         
                                                @endforeach
                                            @endif
                                        </table>
                                    </td>
                                    <td>Ajout de réservation etc...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        
    </div>
@endsection