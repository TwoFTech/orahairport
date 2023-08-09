@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Contacts ({{ Cookie::get('contacts') ? count(unserialize(Cookie::get('contacts'))) : 0 }})</h4>
                <form class="forms-sample" method="post" action="{{ route('stands.contacts.send') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="name" class="form-label">Nom & prénoms</label>
                            <input type="text" class="form-control" id="name" autocomplete="off" placeholder="Nom et prénoms du contact" name="name" value="{{ old('name') }}">
                            @error("name")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label for="phone" class="form-label">Numéro de téléphone</label>
                            <input type="text" class="form-control" id="phone" autocomplete="off" placeholder="Numéro de téléphone du contact" name="phone" value="{{ old('phone') }}">
                            @error("phone")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>

                        <!-- <div class="col-lg-6 mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" class="form-control" id="email" autocomplete="off" placeholder="Adresse email du contact" name="email" value="{{ old('email') }}">
                            @error("email")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>   -->
                    </div>
                    
                    <button type="submit" class="btn-sm text-white btn btn-info" style="float: right;"><i class="link-icon" data-feather="send"></i> Ajouter un contact</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection