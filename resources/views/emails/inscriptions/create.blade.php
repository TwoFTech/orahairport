@component('mail::message')
<h3>Hi, {{ $user->name }}</h3>

# Adhésion à l'équipe ORAH ORAIRPORT.
<p>
	ORAH ORAIRPORT dispose une plateforme de gestion de réservations de billet d'avion.
</p>

<p>Votre Profil :</p>
<p>
    <span><b>Nom:</b> {{ $user->name }}</span> <br>
    <span><b>Email: </b> {{ $user->email }}</span> <br>
    <span><b>Téléphone: </b> {{ $user->phone }}</span> <br>
    <span><b>Poste Occupé: </b>
        @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $role)
                {{ $role }}
            @endforeach
        @endif
    </span> <br>
</p>

Votre mot de passe de connexion est :
<span class="password">
    {{ $password }}
</span>
<br>
(<em class="text-danger">à ne pas difuser sous aucun prétexte.</em> ) <br>

Pour accéder à la plateforme ORAH AIRPORT, vous devez vous connecter en cliquant sur ce lien ci-dessous. <br>
<a href="{{ route('loginForm') }}">{{ route('loginForm') }}</a> <br>

Cordialement, l'Equipe ORAH AIRPORT. <br>


<style>
    .text-danger{
        color:red;
	}
	.password{
        width: 50%;
		height: 50px;
		background-color: #66d1d1;
		color: #fff;
	}
    </style>
    @endcomponent
