@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                
                <h4 class="mb-4">Modification de mot de passe</h4>
                <form class="forms-sample" action="{{ route('password.update') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="oldPassword" class="form-label">Ancien Mot de passe</label>
                            <input type="password" class="form-control" id="oldPassword" placeholder="Votre mot de passe actuel" name="oldPassword">
                            @error("oldPassword")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="password" class="form-label">Nouveau</label>
                            <input type="password" class="form-control" id="password" placeholder="Nouveau mot de passe" name="password">
                            @error("password")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror 
                        </div>
                        <div class="col-12 mb-3">
                            <label for="password_confirmation" class="form-label">Confirmer Mot de passe</label>
                            <input type="password" class="form-control" id="password_confirmation" placeholder="Retaper nouveau mot de passe" name="password_confirmation">
                            @error("password_confirmation")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn-sm text-white btn btn-info">Modifier Mot de Passe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection