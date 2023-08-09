@extends('auth/app')
@section('content')

    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="form-group mb-2">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre adresse email" value="{{ old('email') }}">
            @error("email")
                <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Entrez votre mot de passe">
            @error("password")
                <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
        <div class="form-group mb-2">
            <input type="checkbox" class="custom-control-input" id="remember">
            <label class="custom-control-label mb-0" for="remember">Se souvenir de moi</label>
            <a class="float-end" href="{{ route('forget.password.get') }}">Mot de passe perdu?</a>
        </div>
        <div class="comment-btn mb-2 pb-2 text-center border-b">
            <button type="submit" class="nir-btn w-100">Se Connecter</button>
        </div>
        <p class="text-center">J'ai pas de compte?
            <a href="{{ route('register') }}" class="theme btn btn-info" style="color: white !important">
                Créer Maintenant
            </a>
        </p>
    </form>
@stop
