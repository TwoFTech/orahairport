@extends('auth.app')

@section('auth')
<div class="col-md-8 col-lg-6 col-xl-4">
    <div class="card shadow-none">

        <div class="card-body p-3">
            
            <div class="text-center w-75 m-auto">
                <div class="auth-logo">
                <a href="{{ route('index') }}" class="logo logo-dark">
                    <span class="logo-lg">
                        <b><span class="text-info mb-4">ORAH<span class="text-warning">AIRPORT</span></span> 
                    </span>
                </a>
                </div>
                <p class="text-muted mb-4 mt-3">Vous n'avez pas de compte? Créez votre compte en moins d'une minute.</p>
            </div>

            <form action="{{ route('registration') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="fullname" class="form-label">Nom Complet</label>
                    <input class="form-control" type="text" id="fullname" placeholder="Entrez votre nom et votre prénom" required name="fullname" value="{{ old('fullname') }}">
                    @error("fullname")
                        <p class="text-danger"><small>{{ $message }}</small></p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="emailaddress" class="form-label">Adresse email</label>
                    <input class="form-control" type="email" id="email" required placeholder="Entrez votre adresse email" name="email" value="{{ old('email') }}">
                    @error("email")
                        <p class="text-danger"><small>{{ $message }}</small></p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Numéro de téléphone</label>
                    <input class="form-control" type="text" id="phone" required placeholder="Entrez votre numéro de téléphone" name="phone" value="{{ old('phone') }}">
                    @error("phone")
                        <p class="text-danger"><small>{{ $message }}</small></p>
                    @enderror
                </div>
                {{--<input type="hidden" id="role" required name="role" value="marchand">
                <input type="hidden" id="role" required name="email_verified_at" value="1">--}}
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control" placeholder="Entrer votre mot de passe" name="password">
                        <div class="input-group-text" data-password="false">
                            <span class="password-eye"></span>
                        </div>
                    </div>
                    @error("password")
                        <p class="text-danger"><small>{{ $message }}</small></p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Confirmez le mot de passe</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="passwordConfirmation" class="form-control" placeholder="Confirmez le mot de passe" name="password_confirmation">
                    </div>
                </div>
                {{--<div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox-signup">
                        <label class="form-check-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                    </div>
                </div>--}}
                <div class="text-center d-grid">
                    <button class="btn btn-primary" type="submit"> S'inscrire </button>
                </div>
            </form>

            <div class="text-center mt-3">
                <div class="col-12">
                    <p class="text-muted">J'ai déjà un compte ?  <a href="{{ route('loginForm') }}" class="link-dark text-decoration-underline ms-1"><b>Se Connecter</b></a></p>
                </div> <!-- end col -->
            </div>

        </div> <!-- end card-body -->
    </div>
    <!-- end card -->
    <!-- end row -->

</div> <!-- end col -->
@endsection
