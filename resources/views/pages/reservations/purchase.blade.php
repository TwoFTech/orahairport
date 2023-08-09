<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bon de commande</title>
	</style>
</head>
<body>
	<div class="row header">
		<p>
			<table>
				<tbody>
					<tr>
						<td style="left: 20px; top: 0px; position: absolute; color: #00A2E8;"><h1>BON DE COMMANDE</h1></td>
						<td><img src="images/logo.jpg" style="width: 100px; right: 20px; position: absolute; top: 20px;"></td>
					</tr>
				</tbody>
			</table>
			<hr>
		</p>
	</div>
	<div class="row title">
		<h2>ORAHAIRPORT</h2>
	</div>
	<p>Kowegbo, 2ème arrondissement</p>
	<p>Cotonou, Bénin</p>
	<p>Téléphone:  (+229) 63854326</p>
	<table>
		<tbody>
			<tr>
				<td style="margin-top: 20px; background-color: transparent; padding: 10px; width: 100%;">
					<div>
						<div>
							<p>Date: {{ $reservation->created_at->format('d/m/Y') }}</p>
							<p>Réservation n°: OR-{{ date('ymd') }}{{ str_pad($reservation->id, 5, '0', STR_PAD_LEFT) }}</p>
							<p>N° PNR: {{ $reservation->pnr }}</p>
							<p>Montant: {{ getFormattedPrice($reservation->amount) }} F</p>
							<p>Statut: {{ $reservation->status }}</p>
							<p>Client: {{ $reservation->lastname }} {{ $reservation->firstname }}</p>
							<p>Téléphone: {{ $reservation->phone }}</p>
							<p>Initié par: {{ $reservation->user->name }}</p>
						</div>
						<h4 style="margin-top: 20px">Liste des passagers</h4>
						<table>
							<thead>
								<th>N°</th>
								<th>Nom & Prénom(s)</th>
								<th>Montant</th>
							</thead>
							<tbody>
								@foreach($reservation->passengers as $index => $passenger)
									<tr>
										<td>{{ ++$index }}</td>
										<td>{{ $passenger->lastname . ' ' . $passenger->firstname }}</td>
										<td>{{ getFormattedPrice($passenger->amount) . ' F' }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	<div class="row" style="margin-top: 20px; text-align: center;">
		<img src="images/cocan.jpg" style="width: 100px;"> 
	</div>
	<div class="row" style="margin-top: 20px; color: orange;">
		Validez votre réservation et bénéficiez d'une entrée au stade à la CAN 2023 - Côte d'ivoire <img src="images/ci.svg" style="width: 15px;">. 
	</div>
	<div class="row" style="margin-top: 20px;">
		Pour toute information, contactez-nous aux numéros suivants :
		<p>
			<b>Afrique de l'Ouest</b>
			Bénin, Togo, Niger, Burkina Faso, Côte d'Ivoire, Guinée Conakry, Sénégal
			Téléphone : (+229) 63854326
		</p>
		<p>
			<b>Afrique centrale</b>
			Cameroun, RDC, Gabon, Comores
			Téléphone : (+241) 060003260
		</p>
	</div>
</body>
</html>