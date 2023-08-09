@extends('layouts.app')

@section('content')

    @section('nav')
        <a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i>Nouveau</a>
    @endsection

    <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
        <form class="forms-sample">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <h5>{{ $title }}</h5>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Libellé Role</th>
                                    <th class="text-center">Ajouter Permissions</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($roles as $index => $role)
                                    <form action="#" method="get">
                                        @csrf
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td width="60%" class="text-center">
                                                <select class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%" name="permission[]">
                                                    @foreach ($permissions as $permission)
                                                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <ul class="d-flex list-unstyled mb-0 justify-content-center">
                                                <li class="me-2">
                                                    <button type="submit" style="border: none;">
                                                        <i class="link-icon" data-feather="save"></i>
                                                    </button>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="link-icon" data-feather="eye"></i>
                                                    </a>
                                                </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </form>
                                @empty
                                    {{ 'Aucun rôle trouvé !' }}
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
