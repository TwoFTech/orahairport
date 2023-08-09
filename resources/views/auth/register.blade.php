@extends('auth/app')
@section('content')

    <form action="{{ route('registration') }}" method="post" onsubmit="process(event)" name="form">
        @csrf
        <div class="form-group mb-2">
            <label for="fullname">Nom Complet</label>
            <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Ex: Deo John" value="{{ old('fullname') }}">
            @error("fullname")
                <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Ex: john@gmail.com" value="{{ old('email') }}">
            @error("email")
                <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="phone">Numéro Mobile</label>
            <input type="text" id="phone" name="phone" class="form-control" placeholder="Ex: 0022966000001" value="{{ old('phone') }}">
            @error("phone")
                <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Ex: John@22">
            @error("password")
                <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="password_confirmation">Confirmez mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ex: John@22">
            @error("password_confirmation")
                <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
        <div class="form-group mb-2 d-flex">
            <input type="checkbox" class="custom-control-input" id="terme" name="terme">
            <label class="custom-control-label mb-0 ms-1 text-info lh-1" for="terme">
                <a target="_blank" href="{{ route('rgpd.policies') }}">J'ai lu et j'accepte les conditions et la politique de confidentialité.</a>
            </label>
        </div>
        @error('terme')
            <p class="text-danger"><small>{{ $message }}</small></p>
        @enderror
        <div class="comment-btn mb-2 pb-2 text-center">
            <button type="submit" class="nir-btn w-100">S'inscrire</button>
        </div>
        <p class="text-center">J'ai déjà un compte?
            <a href="{{ route('login') }}" class="theme btn btn-info" style="color: white !important">
                Se Connecter
            </a>
        </p>
    </form>
@stop
