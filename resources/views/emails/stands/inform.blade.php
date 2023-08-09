@component('mail::message')

# Vous avez une nouvelle demande de point de vente.

@component('mail::button', ['url' => route('loginForm')])
	Cliquez sur ce bouton pour vous connecter
@endcomponent

Cordialement, l'Equipe ORAH AIRPORT. <br>

@endcomponent