@extends('auth.app1')

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
                        <h4 class="mb-3">Réinitialisation de mot de passe</h4> 
                    </div>
                    @if (Session::has('message'))
                         <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                </div>

                <form action="{{ route('forget.password.post') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <!-- <label for="email" class="form-label">Adresse Email</label> -->
                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Entrez votre adresse email">
                        @error("email")
                            <p class="text-danger"><small>{{ $message }}</small></p>
                        @enderror
                    </div>

                    <div class="text-center d-grid">
                        <button class="btn btn-primary" type="submit"> Envoyer un lien de réinitialisation </button>
                    </div>

                </form>
            </div> <!-- end card-body -->
        </div>

    </div> <!-- end col -->
@endsection
