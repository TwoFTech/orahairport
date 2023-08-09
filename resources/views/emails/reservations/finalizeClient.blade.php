@component('mail::message')

# La réservation a été bien finalisée.

Obtenez ci-dessous les billets des différents passagers.

<x-mail::table>
| N° | Passager       | Billet       |
| -- | ------------- |:-------------:|
@foreach($passengers as $index => $passenger)
	| {{ ++$index }} | {{ $passenger->lastname . ' ' . $passenger->firstname }}      | <a href="{{ route('passengers.downloadTicket', ['passenger' => $passenger, 'reservation' => $passenger->reservation, 'token' => $passenger->reservation->token ]) }}">Télécharger le billet</a>      |
@endforeach
</x-mail::table>

Cordialement, l'Équipe ORAHAIRPORT. <br>

@endcomponent