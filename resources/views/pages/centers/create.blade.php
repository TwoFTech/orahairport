@extends('layouts.app')

@section('content')

    @section('nav')
        <a href="{{ route('centers.create') }}" class="btn btn-primary"><i class="link-icon" data-feather="list"></i>Liste</a>
    @endsection
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h4 class="mb-4">Nouveau Centre</h4>
                    <form class="forms-sample" action="{{ route('centers.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="label" class="form-name">Nom Centre</label>
                                <input type="text" class="form-control" id="label" value="{{ old('label') ?? '' }}" placeholder="Ex: Cotonou Business" name="label">
                                @error("label")
                                    <p class="text-danger"><small>{{ $message }}</small></p>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="headquarters" class="form-headquarters">Siège Social</label>
                                <input type="text" class="form-control" id="headquarters" value="{{ old('headquarters') ?? '' }}" placeholder="Ex: Kowegbo, 2ème arrondissement, Cotonou, Bénin" name="headquarters">
                                @error("headquarters")
                                    <p class="text-danger"><small>{{ $message }}</small></p>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="email" class="form-email">Email Reception</label>
                                <input type="email" class="form-control" id="email" value="{{ old('email') ?? '' }}" placeholder="Ex: cotonou@travel-orahaiport.com" name="email">
                                @error("email")
                                    <p class="text-danger"><small>{{ $message }}</small></p>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="phone" class="form-phone">Téléphone Client</label>
                                <input type="text" class="form-control" id="phone" value="{{ old('phone') ?? '' }}" placeholder="Ex: +22967000003" name="phone">
                                @error("phone")
                                    <p class="text-danger"><small>{{ $message }}</small></p>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="country" class="form-label">Selectionnez Pays</label>
                                <select name="country" id="country" class="form-control">
                                    <option value="" selected disabled>-- Selectionnez --</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" {{ $country->status == true ? '' : 'hidden' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error("country")
                                    <p class="text-danger"><small>{{ $message }}</small></p>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn-sm text-white btn btn-info">
                                    <i class="link-icon" data-feather="plus"></i>
                                    Ajouter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
