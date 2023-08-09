<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('index') }}" class="sidebar-brand">
            <b><h3>ORAH<span class="text-warning">AIRPORT</span></h3></b>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Tableau de bord</span>
                </a>
            </li>
            <li class="nav-item  {{ Route::currentRouteName() == 'reservations.index' || Route::currentRouteName() == 'reservations.create' || Route::currentRouteName() == 'reservations.confirm' ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#reservation" role="button" aria-expanded="false" aria-controls="reservation">
                    <i class="link-icon" data-feather="table"></i>
                    <span class="link-title">Réservations</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="reservation">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('reservations.index') }}" class="nav-link">Liste</a>
                        </li>
                        <li class="nav-item">
                            @if(getStandActive())
                                <a href="{{ route('reservations.create', ['stand' => getStandActive(), 'token' => getStandActive()->token]) }}" class="nav-link">Nouvelle réservation</a>
                            @else
                                <span class="text-warning">Créez au moins un point marchand pour pouvoir enregistrer des réservations</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </li>
            @if(!isAdmin())
                <li class="nav-item {{ Route::currentRouteName() == 'stands.index' || Route::currentRouteName() == 'stands.edit' || Route::currentRouteName() == 'stands.show' || Route::currentRouteName() == 'stands.delegate' || Route::currentRouteName() == 'stands.create' || Route::currentRouteName() == 'stands.contacts' || Route::currentRouteName() == 'stands.payment' ? 'active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#stand" role="button" aria-expanded="false" aria-controls="stand">
                        <i class="link-icon" data-feather="list"></i>
                        <span class="link-title">Points de Ventes</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="stand">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('stands.index') }}" class="nav-link">Liste</a>
                            </li>
                            @if(isMerchant())
                                <li class="nav-item">
                                    <a href="{{ route('stands.create') }}" class="nav-link">Effectuer une demande</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            @if(isPrivate() || isAccountManager() || isMerchant())
                <li class="nav-item {{ Route::currentRouteName() == 'dCommissions.index' ? 'active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#ticket" role="button" aria-expanded="false" aria-controls="ticket">
                        <i class="link-icon" data-feather="dollar-sign"></i>
                        <span class="link-title">Commissions</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="ticket">
                        <ul class="nav sub-menu">
                            @if(isPrivate() || isAccountManager())
                                <li class="nav-item">
                                    <a href="{{ route('dCommissions.index') }}" class="nav-link">Equipe Technique</a>
                                </li>
                             @endif
                             @if(isPrivate() || isAccountManager())
                                <li class="nav-item">
                                    <a href="{{ route('sCommissions.index') }}" class="nav-link">Points Marchands</a>
                                </li>
                             @endif
                            <li class="nav-item">
                                <a href="{{ route('sCommissions.specific') }}" class="nav-link">Mes commissions</a>
                            </li>
                             @if(isMerchant())
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Rétirer</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Historiques</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif

            @if(isPrivate() || isAdmin() || isBusinessDev() || isResa())
                <li class="nav-item {{ Route::currentRouteName() == 'contacts.index' ? 'active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#contacts" role="button" aria-expanded="false" aria-controls="contacts">
                        <i class="link-icon" data-feather="phone"></i>
                        <span class="link-title">Contacts</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="contacts">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('contacts.index', 'clients') }}" class="nav-link">Clients</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('contacts.index') }}" class="nav-link">Recommandés</a>
                            </li>
                            @if (isPrivate() || isBusinessDev() || isResa())
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Marchands</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>

                @if (isPrivate())
                    <li class="nav-item {{ Route::currentRouteName() == 'users.index' ? 'active' : '' }}">
                        <a class="nav-link" data-bs-toggle="collapse" href="#user" role="button" aria-expanded="false" aria-controls="user">
                            <i class="link-icon" data-feather="users"></i>
                            <span class="link-title">Utilisateurs</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="user">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link">Liste</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('users.create') }}" class="nav-link">Nouveau</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Liste Marchands</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#accessibility" role="button" aria-expanded="false" aria-controls="accessibility">
                            <i class="link-icon" data-feather="key"></i>
                            <span class="link-title">Accessibilités</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="accessibility">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}" class="nav-link">Liste Service</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('roles.create') }}" class="nav-link">Role & Service</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('permission_manager') }}" class="nav-link">Gérer Permissions</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            @endif

            @if(isAdmin() || isPrivate() || isBusinessDev())
                <li class="nav-item {{ Route::currentRouteName() == 'cities.create' ? 'active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#center" role="button" aria-expanded="false" aria-controls="center">
                        <i class="link-icon" data-feather="home"></i>
                        <span class="link-title">Centres</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="center">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('centers.index') }}" class="nav-link">Nos centres</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('centers.create') }}" class="nav-link">Nouveau centre</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cities.create') }}" class="nav-link">Nouvelle ville</a>
                            </li>
                            @if(isPrivate())
                                <li class="nav-item">
                                    <a href="{{ route('settings.index') }}" class="nav-link">Autoriser pays</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>

                <li class="nav-item {{ Route::currentRouteName() == 'companies.index' || Route::currentRouteName() == 'companies.create' || Route::currentRouteName() == 'companies.edit' ? 'active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#company" role="button" aria-expanded="false" aria-controls="company">
                        <i class="link-icon" data-feather="navigation"></i>
                        <span class="link-title">Compagnies</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="company">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('companies.index') }}" class="nav-link">Liste</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('companies.create') }}" class="nav-link">Ajouter une compagnie</a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- @if(isPrivate() || isBusinessDev())
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#supplier" role="button" aria-expanded="false" aria-controls="supplier">
                            <i class="link-icon" data-feather="user-plus"></i>
                            <span class="link-title">Fournisseurs</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="supplier">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Nos Partenaires</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Nouveau Partenaire</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Demander un salaire</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif --}}
            @endif

            @if(isPrivate())
                <li class="nav-item {{ Route::currentRouteName() == 'countries.index' || Route::currentRouteName() == 'countries.edit' || Route::currentRouteName() == 'settings.index' || Route::currentRouteName() == 'settings.edit' ? 'active' : '' }}">
                    <a href="{{ route('settings.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="settings"></i>
                        <span class="link-title">Paramètres</span>
                    </a>
                </li>
            @endif

            @if(isMerchant())
                <li class="nav-item {{ Route::currentRouteName() == 'cgv' ? 'active' : '' }}">
                    <a href="{{ route('cgv') }}" class="nav-link text-danger">
                        <i class="link-icon" data-feather="activity"></i>
                        <span class="link-title">Les CGV</span>
                    </a>
                </li>
            @endif

            <li class="nav-item {{ Route::currentRouteName() == 'users.profil' ? 'active' : '' }}">
                <a href="{{ route('users.profil') }}" class="nav-link">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">Profil</span>
                </a>
            </li>

            <li class="nav-item {{ Route::currentRouteName() == 'password.reset' ? 'active' : '' }}">
                <a href="{{ route('password.reset') }}" class="nav-link">
                    <i class="link-icon" data-feather="edit"></i>
                    <span class="link-title">Modifier le mot de passe</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link">
                    <i class="link-icon" data-feather="log-out"></i>
                    <span class="link-title">Se Déconnecter</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
