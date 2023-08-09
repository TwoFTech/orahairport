@component('mail::message')

# Vous avez une nouvelle réservation pour étude.

@component('mail::button', ['url' => route('loginForm')])
	Cliquez sur ce bouton pour vous connecter
@endcomponent

Cordialement, l'Équipe ORAHAIRPORT. <br>

@endcomponent