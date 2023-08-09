@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h4 class="mb-4">Modification Ville</h4>
                <form class="forms-sample" action="{{ route('cities.update', $city) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="city" class="form-label">Libellé Ville</label>
                            <input type="text" class="form-control" id="city" value="{{ old('city') ? old('city') : $city->label }}" placeholder="Ex: Cotonou" name="city">
                            @error("city")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="country" class="form-label">Selectionnez Pays</label>
                            <select name="country" id="country" class="form-control">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" {{ $country->status == true ? '' : 'hidden' }} {{ $country->id == $city->country->id ? 'selected' : '' }}>
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
