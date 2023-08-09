@component('mail::message')

# Votre demande de point de vente a été validée.

Cliquez sur le bouton ci-dessous pour y accéder. <br>

Enseigne: {{ $stand->name }} <br>
Numéro de téléphone: {{ $stand->phone }} <br>
Statut: "Validé" <br>
Pays: {{ $stand->city->country->name }} <br>
Ville: {{ $stand->city->label }} <br>
Quartier: {{ $stand->quartier }} <br>
Rue: {{ $stand->rue }} <br>

@component('mail::button', ['url' => route('home')])
	Cliquez ici.
@endcomponent

Cordialement, l'Equipe ORAH AIRPORT. <br>

@endcomponent