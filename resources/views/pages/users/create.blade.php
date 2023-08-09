@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h4 class="mb-4">Nouvel utilisateur</h4>
                <form class="forms-sample" action="{{ route('users.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="fullname" class="form-label">Nom & prénom(s)</label>
                            <input type="text" class="form-control" id="fullname" placeholder="Nom & prénom(s)" name="fullname" value="{{ old('fullname') ?? '' }}">
                            @error("fullname")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email') ?? '' }}">
                            @error("email")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="phone" placeholder="Téléphone" name="phone" value="{{ old('phone') ?? '' }}">
                            @error("phone")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="role" class="form-label">Selectionnez son rôle</label>
                            <select name="role" id="role" class="form-control" onchange="yesnoCheck(this);">
                                <option value="" selected disabled>-- Selectionnez rôle --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" @if($role->name == 'merchant' || $role->name == 'dev') hidden @endif>
                                        {{ showRole($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error("role")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3" id="ifYes" @error("center") {{ 'style="display: block;"' }} @enderror style="display: none;">
                            <label for="center" class="form-label">Ajouter le centre</label>
                            <select name="center" id="center" class="form-control">
                                <option value="" selected disabled>-- Selectionnez centre --</option>
                                @foreach ($centers as $center)
                                    <option value="{{ $center->id }}" @if($center->status == false) hidden @endif>
                                        {{ $center->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error("center")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn-sm text-white btn btn-info">Ajouter Utilisateur</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function yesnoCheck(that) {
        if (that.value == "admin") {
            document.getElementById("ifYes").style.display = "block";
        } else {
            document.getElementById("ifYes").style.display = "none";
        }
    }
</script>
@endsection
