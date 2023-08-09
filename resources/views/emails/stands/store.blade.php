@component('mail::message')

# Votre demande de point de vente est en étude.

Cliquez sur le bouton ci-dessous pour suivre son avancement. <br>

Enseigne: {{ $standStore->name }} <br>
Numéro de téléphone: {{ $standStore->phone }} <br>
Statut: "En cours" <br>
Pays: {{ $standStore->city->country->name }} <br>
Ville: {{ $standStore->city->label }} <br>
Quartier: {{ $standStore->quartier }} <br>
Rue: {{ $standStore->rue }} <br>
Montant payé: {{ $standStore->amount }} <br>
ID de la transaction: {{ $standStore->id_transfert }} <br>

@component('mail::button', ['url' => route('home')])
	Cliquez ici.
@endcomponent

Cordialement, l'Equipe ORAH AIRPORT. <br>

@endcomponent