@component('mail::message')

# Vos infos de réservation sont disponibles.

Client: {{ $reservation->lastname }} {{ $reservation->firstname }}<br>
Numéro de téléphone: {{ $reservation->phone }} <br>
N° PNR: {{ $reservation->pnr }} <br>
Montant: {{ getFormattedPrice($reservation->amount) }} F <br>

Obtenez en pièce jointe votre bon de commande et procédez au règlement de
la réservation à travers le lien ci-dessous.<br>
<a href="{{ route('reservations.toPay', ['reservation' => $reservation, 'token' => $reservation->token]) }}">{{ route('reservations.toPay', ['reservation' => $reservation, 'token' => $reservation->token]) }}</a>

Cordialement, l'Équipe ORAHAIRPORT. <br>

@endcomponent