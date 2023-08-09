@component('mail::message')

# Une réservation a été bien reglée.

{{-- Client: {{ $reservation->lastname }} {{ $reservation->firstname }}<br>
Numéro de téléphone: {{ $reservation->phone }} <br>
N° PNR: {{ $reservation->pnr }} <br>
Nombre de passager : {{ $reservation->passenger_number }}
Montant: {{ getFormattedPrice($reservation->amount) }} F <br> --}}

@component('mail::button', ['url' => route('loginForm')])
	Cliquez sur ce bouton pour vous connecter
@endcomponent

Cordialement, l'Équipe ORAHAIRPORT. <br>

@endcomponent