@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h4 class="mb-4">Nouvelle compagnie</h4>
                <form class="form-company" action="{{ route('companies.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-7 mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="name" placeholder="Nom de la compagnie" name="name" value="{{ old('name') }}">
                            @error("name")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn-sm text-white btn btn-info">Ajouter la compagnie</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
