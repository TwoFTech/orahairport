@extends('auth.app')

@section('auth')
    <div class="col-md-8 col-lg-6 col-xl-4">
        <div class="card shadow-none">
            <div class="card-body p-3">        
                <div class="w-full">
                    <div class="auth-logo text-center">
                        <a href="{{ route('index') }}" class="logo logo-dark">
                            <span class="logo-lg">
                                <b><span class="text-info mb-4">ORAH<span class="text-warning">AIRPORT</span></span>
                            </span>
                        </a>
                        <h4>Page de connexion</h4> 
                    </div>
                    <p class="text-muted mt-3">
                        Entrez vos identifiants pour vous connecter.
                    </p>
                </div>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse Email</label>
                        <input class="form-control" type="email" name="email" required placeholder="Ex: orah@gmail.com" value="{{ old('email') }}">
                        @error("email")
                            <p class="text-danger"><small>{{ $message }}</small></p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de Passe</label>
                        <div class="input-group input-group-merge">
                            <input type="password" name="password" required class="form-control" placeholder="Ex: Aipor@01$">
                            <div class="input-group-text" data-password="false">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                            <label class="form-check-label" for="checkbox-signin">Se souvenir de moi</label>
                        </div>
                    </div>

                    <div class="text-center d-grid">
                        <button class="btn btn-primary" type="submit"> Se Connecter </button>
                    </div>

                </form>
                <div class="text-center mt-3">
                    <div class="col-12">
                        <p> <a href="{{ route('forget.password.get') }}" class="text-muted ms-1">Mot de passe oublié ?</a></p>
                        <p class="text-muted">Vous n'avez pas de compte ? <a href="{{ route('register') }}" class="text-primary text-decoration-underline ms-1"><b>S'inscrire</b></a></p>
                    </div> <!-- end col -->
                </div>
            </div> <!-- end card-body -->
        </div>

    </div> <!-- end col -->
@endsection
