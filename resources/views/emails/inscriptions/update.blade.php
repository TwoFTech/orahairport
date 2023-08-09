@component('mail::message')
<h3>Hi, {{ $user->name }}</h3>
# Modification de vos coordonnées par l'équipe ORAH ORAIRPORT. 
<p>
	Suite aux corrections de vos coordonnées sur la plateforme ORAH ORAIRPORT, <br>
	nous vennons de modifier vos informations. 
	
</p>
Vos nouveaux coordonnés sont les suivantes : <br>

<b>Nom : </b> {{ $user->name }}<br>
<b>Téléphone : </b> {{ $user->phone }}<br>
<b>Email : </b> {{ $user->email }}<br>

Cordialement, l'Equipe ORAH AIRPORT. <br>
@endcomponent
