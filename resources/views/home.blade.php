@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow-1">
                    @if(isMerchant())
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <h6 class="card-title mb-0">Nombre de demande de point de vente</h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-12 col-xl-5">
                                            <h3 class="mb-2">{{ isMerchant() ? Auth::user()->stands->count() : getStandCount() }}</h3>
                                            <div class="d-flex align-items-baseline">
                                                <p class="text-success">
                                                    <!-- <span>+8.2%</span> -->
                                                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-12 col-xl-7">
                                            <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Nombre de point de vente validé</h6>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-md-12 col-xl-5">
                                        <h3 class="mb-2">{{ isMerchant() ? Auth::user()->stands->where('status', true)->count() : getStandValidatedCount() }}</h3>
                                        <div class="d-flex align-items-baseline">
                                            <p class="text-success">
                                                <!-- <span>+8.2%</span> -->
                                                <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-12 col-xl-7">
                                        <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(isMerchant())
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <h6 class="card-title mb-0">Commission point de vente</h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-12 col-xl-5">
                                            <h3 class="mb-2">{{ getStandActive() ? getFormattedPrice(getStandActive()->scommissions->sum('amount')) : 0 }} F</h3>
                                            <div class="d-flex align-items-baseline">
                                                <p class="text-success">
                                                    <!-- <span>+8.2%</span> -->
                                                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-12 col-xl-7">
                                            <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(isPrivate() || isAccountManager())
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <h6 class="card-title mb-0">Montant total point de vente</h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-12 col-xl-5">
                                            <h3 class="mb-2">{{ getFormattedPrice(getStandTotal()) }} {{ getCurrency() }}</h3>
                                            <div class="d-flex align-items-baseline">
                                                <p class="text-success">
                                                    {{-- <span>+8.2%</span> --}}
                                                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-12 col-xl-7">
                                            <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <h6 class="card-title mb-0">Commission de TwoF Technologies sur points de vente et réservations</h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-12 col-xl-5">
                                            <h3 class="mb-2">{{ getDevCommissionsTotal() }} </h3>
                                            <div class="d-flex align-items-baseline">
                                                <p class="text-success">
                                                    {{-- <span>+8.2%</span> --}}
                                                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-12 col-xl-7">
                                            <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @if (count(getMyResavation()) > 0)
            <div class="row">
                <div class="col-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-2">
                                <h6 class="card-title mb-0">Réservations</h6>
                                {{-- <div class="dropdown mb-2">
                                    <button class="btn p-0" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                                        <a class="dropdown-item d-flex align-items-center"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                                        <a class="dropdown-item d-flex align-items-center"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                                        <a class="dropdown-item d-flex align-items-center"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                                        <a class="dropdown-item d-flex align-items-center"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                                        <a class="dropdown-item d-flex align-items-center"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th class="pt-0">#</th>
                                            <th class="pt-0">Réservateur</th>
                                            <th class="pt-0">Date Départ</th>
                                            <th class="pt-0">Email Réservateur</th>
                                            <th class="pt-0">Status</th>
                                            <th class="pt-0">Compagnie</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(getMyResavation() as $index => $reservation)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $reservation->firstname . ' '.$reservation->lastname }}</td>
                                                <td>{{ $reservation->departure_date }}</td>
                                                <td>{{ $reservation->email }}</td>
                                                <td><span class="badge {{ setStatusResa($reservation->status) }}">{{ $reservation->status }}</span></td>
                                                <td>{{ $reservation->company }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('reservations.show', ['reservation' => $reservation, 'token' => $reservation->token]) }}" class="">Consulter</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if(!isMerchant())
            <div class="row mt-3">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-2">
                                <h6 class="card-title mb-0">Liste Equipe</h6>
                            </div>
                            <div class="table-responsive">
                                <table id="dataTableExample" class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            {{-- <th>Image</th> --}}
                                            <th>Nom complet</th>
                                            <th>Email</th>
                                            <th>Téléphone</th>
                                            <th>Role</th>
                                            <th class="text-center">Etat</th>
                                            @if (isPrivate())
                                                <th class="text-center">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (getPersonalList() as $index => $user)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                {{-- <td>
                                                    <img src="../images/reviewer/1.jpg" alt="">
                                                </td> --}}
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>
                                                    @if(!empty($user->getRoleNames()))
                                                        @foreach($user->getRoleNames() as $role)
                                                            {{ showRole($role)  }}
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <span class="form-check form-switch">
                                                        <input type="checkbox" {{ $user->status == true ? 'checked' : ''}}  class="form-check-input" id="status">
                                                    </span>
                                                </td>
                                                @if(isPrivate())
                                                    <td class="text-center">
                                                        <ul class="d-flex list-unstyled mb-0">
                                                            <li class="me-2">
                                                                <a href="{{ route('users.edit', $user) }}">
                                                                    <i class="link-icon" data-feather="edit"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
