@component('mail::message')

# Une réservation a été bien finalisée.

@component('mail::button', ['url' => route('loginForm')])
	Cliquez sur ce bouton pour vous connecter
@endcomponent

Cordialement, l'Équipe ORAHAIRPORT. <br>

@endcomponent