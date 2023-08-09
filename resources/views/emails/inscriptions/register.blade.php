@component('mail::message')
<h3>Hi, {{ $user->name }}</h3>
# Votre inscription a bien été enregistré. 

Pour finaliser votre inscription, vous devez confirmer votre email en cliquant sur ce lien. <br>
<a href="{{ route('verifyEmail', ['email' => $user->email, 'token' => $user->token]) }}">
	{{ route('verifyEmail', ['email' => $user->email, 'token' => $user->token]) }}
</a> <br>
Cliquez sur le bouton ci-dessous pour confirmer votre compte. <br>

@component('mail::button', ['url' => route('verifyEmail', ['email' => $user->email, 'token' => $user->token])])
	Confirmez mon compte
@endcomponent

Cordialement, l'Equipe ORAH AIRPORT. <br>

@endcomponent