@extends('auth/app')
@section('content')
    
    <form action="{{ route('reset.password.post') }}" method="post">
        @csrf
        <div class="form-group mb-2">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Entrer l'adresse email" value="{{ old('email') }}">
            @error("email")
                <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="password">Nouveau mot de passe</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Entrer le nouveau mot de passe" value="{{ old('password') }}">
            @error("password")
                <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="password_confirmation">Retaper mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirmer le nouveau mot de passe" value="{{ old('password_confirmation') }}">
            @error("password_confirmation")
                <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
        <div class="comment-btn mb-2 pb-2 text-center border-b">
            <button type="submit" class="nir-btn w-100">Réinitialiser le mot de passe</button>
        </div>
    </form>
@stop