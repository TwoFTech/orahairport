@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                
                <h4 class="mb-4">Profil</h4>
                <form class="forms-sample" action="{{ route('users.update', $user) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="fullname" class="form-label">Nom & prénom(s)</label>
                            <input type="text" class="form-control" id="fullname" placeholder="Nom & prénom(s)" name="fullname" value="{{ old('fullname') ?? $user->name }}">
                            @error("fullname")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email') ?? $user->email }}" readonly>
                            @error("email")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="phone" placeholder="Téléphone" name="phone" value="{{ old('phone') ?? $user->phone }}">
                            @error("phone")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        {{-- <div class="col-lg-6 mb-3">
                            <label for="role" class="form-label">Selectionnez son rôle</label>
                            <select name="role" id="role" class="form-control">
                                <option value="" selected disabled>-- Selectionnez --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" @if($role->name == 'merchant' || $role->name == 'dev') hidden @endif>
                                        {{ $role->name == 'dev' ? 'développeur' : $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error("role")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div> --}}
                        <div class="text-center">
                            <button type="submit" class="btn-sm text-white btn btn-info">Modifier Utilisateur</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection