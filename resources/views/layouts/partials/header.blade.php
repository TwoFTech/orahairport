<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <div class="search-form text-white">
            <div class="m-auto float-left">
                <a class="btn-sm btn btn-primary " href="{{ route('stands.create') }}">
                    <i class="icon-sm" data-feather="plus"></i>
                    Demande de point de vente
                </a>

                @if(getStandActive())
                    <a class="btn-sm btn text-white btn-info" href="{{ route('reservations.create', ['stand' => getStandActive(), 'token' => getStandActive()->token]) }}">
                        <i class="icon-sm" data-feather="file"></i>
                        Nouvelle Réservation
                    </a>
                @endif
            </div>

        </div>
        <ul class="navbar-nav">
            @if(count(Auth::user()->stands) > 0)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span style="font-size:16px;">{{ getStandActive()->name }}</span>
                        <img class="wd-30 ht-30 rounded-circle" src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/flags/4x3/'.strtolower(getStandActive()->city->country->code).'.svg') }}" alt="profile">
                    </a>
                    @if(count(Auth::user()->stands) > 1)
                        <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                            <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                                <p>Mes Points Ventes (0{{ count(Auth::user()->stands) }})</p>
                            </div>
                            <div class="p-1">
                                @foreach(Auth::user()->stands as $stand)
                                    <a class="dropdown-item d-flex align-items-center py-2" href="{{ $stand->id == getStandActive()->id ? '#' : route('stands.active', ['stand' => $stand, 'token' => $stand->token]) }}">
                                        <div class="wd-25 ht-25 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                        <img class="wd-30 ht-30 rounded-circle" src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/flags/4x3/'.strtolower($stand->city->country->code).'.svg') }}" alt="profile">
                                        </div>
                                        <div class="flex-grow-1 me-2">
                                            <p>{{ $stand->name }}</p>
                                            <p class="tx-12 text-{{ $stand->id == getStandActive()->id ? 'success' : 'muted' }}">{{ $stand->id == getStandActive()->id ? 'Activé' : 'Sélectionner' }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            @if(count(Auth::user()->stands) > 3)
                                <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                                    <a href="{{ route('stands.all') }}">Afficher tout</a>
                                </div>
                            @endif
                        </div>
                    @endif
                </li>
            @endif
            {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="bell"></i>
                    <div class="indicator">
                        <div class="circle"></div>
                    </div>
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
                    <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                        <p>6 New Notifications</p>
                        <a class="text-muted">Clear all</a>
                    </div>
                    <div class="p-1">
                        <a class="dropdown-item d-flex align-items-center py-2">
                            <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                <i class="icon-sm text-white" data-feather="gift"></i>
                            </div>
                            <div class="flex-grow-1 me-2">
                                <p>New Order Recieved</p>
                                <p class="tx-12 text-muted">30 min ago</p>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center py-2">
                            <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                <i class="icon-sm text-white" data-feather="alert-circle"></i>
                            </div>
                            <div class="flex-grow-1 me-2">
                                <p>Server Limit Reached!</p>
                                <p class="tx-12 text-muted">1 hrs ago</p>
                            </div>
                        </a>
                    </div>
                    <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                        <a>View all</a>
                    </div>
                </div>
            </li>--}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="standDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="link-icon" data-feather="user"></i>
                    <!-- <img class="wd-30 ht-30 rounded-circle" src="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/images/reviewer/1.jpg') }}" alt="profile"> -->
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="standDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            <!-- <img class="wd-80 ht-80 rounded-circle" src="{{ asset(!\App::environment('local') ? 'public' : ''.'storage/images/reviewer/1.jpg') }}" alt=""> -->
                        </div>
                        <div class="text-center">
                            <p class="tx-16 fw-bolder">{{ Auth::user()->name }}</p>
                            <p class="tx-12 text-muted">
                                @if(!empty(Auth::user()->getRoleNames()))
                                    @foreach(Auth::user()->getRoleNames() as $role)
                                        {{ showRole($role)  }}
                                    @endforeach
                                @endif
                            </p>
                        </div>
                    </div>
                    <ul class="list-unstyled p-1">
                        <li class="dropdown-item py-2">
                            <a href="{{ route('users.profil') }}" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="user"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li class="dropdown-item py-2">
                            <a class="text-body ms-0" href="{{ route('password.reset') }}">
                                <i class="me-2 icon-md" data-feather="edit"></i>
                                <span>Modifier mot de passe</span>
                            </a>
                        </li>
                        <li class="dropdown-item py-2">
                            <a class="text-body ms-0" href="{{ route('logout') }}">
                                <i class="me-2 icon-md" data-feather="log-out"></i>
                                <span>Déconnexion</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
