@extends('auth/app')
@section('content')
    
    <form action="{{ route('forget.password.post') }}" method="post">
        @csrf
        <div class="form-group mb-2">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" class="form-control" placeholder="Ex: deo@gmail.com" value="{{ old('email') }}">
            @error("email")
                <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
        <div class="comment-btn mb-2 pb-2 text-center border-b">
            <button type="submit" class="nir-btn w-100">Envoyer un lien de réinitialisation</button>
        </div>
        <p class="text-center">Je me souviens ? <a href="{{ route('loginForm') }}" class="theme">Se Connecter</a></p>
    </form>
@stop