@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                
                <h4 class="mb-4">Profil</h4>
                <form class="forms-sample" action="{{ route('users.profil.up') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="name" class="form-label">Nom & prénom(s)</label>
                            <input type="text" class="form-control" id="name" placeholder="Nom & prénom(s)" name="name" value="{{ old('name') ?? Auth::user()->name }}">
                            @error("name")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{ Auth::user()->email }}" readonly>
                            @error("email")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="phone" placeholder="Téléphone" name="phone" value="{{ Auth::user()->phone }}" readonly>
                            @error("phone")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn-sm text-white btn btn-info"><i class="link-icon" data-feather="send"></i> Effectuer les modifications</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection