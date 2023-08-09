@extends('auth/app')
@section('content')
    
    <form action="{{ route('adhesion.validate', ['email' => $email, 'token' => $token]) }}" method="post">
        @csrf
        <input type="hidden" value="{{ $token }}" name="token">
        <div class="form-group mb-2">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Ex: deo@gmail.com" value="{{ old('email') ?? $email }}">
            @error("email")
                <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="oldPassword">Ancien Mot de passe</label>
            <input type="password" name="oldPassword" id="oldPassword" class="form-control" placeholder="Mot de passe copié">
            @error("oldPassword")
                <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="password">Nouveau Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Ex: Merchant@1$">
            @error("password")
                <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="password_confirmation">Confirmez mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ex: Merchant@1$">
            @error("password_confirmation")
                <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
        <div class="comment-btn mb-2 pb-2 text-center border-b">
            <button type="submit" class="nir-btn w-100">Modifier Mot de Passe</button>
        </div>
    </form>
@stop