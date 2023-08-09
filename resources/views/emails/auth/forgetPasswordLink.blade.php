@component('mail::message')

# Votre inscription a bien été enregistré.

Cliquez sur le bouton ci-dessous pour définir votre mot de passe. <br>

@component('mail::button', ['url' => route('loginForm')])
	Cliquez sur ce bouton pour vous connecter
@endcomponent

Cordialement, l'Equipe ORAH AIRPORT. <br>

@endcomponent