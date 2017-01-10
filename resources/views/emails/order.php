<!DOCTYPE html>
<html>
<head>
	<title>Podaci Korisnika</title>
</head>
<body>
	<hr>
	<h1>Podaci kupca:</h1>
	<div style="background-color: #efefef;">		
		<ul style="list-style-type: none; padding: 10px;">
			<li><strong>Ime i Prezime: </strong> <?php echo $request->name; ?></li>
			<li><strong>Email: </strong> <?php echo $request->email; ?></li>
			<li><strong>Mesto: </strong> <?php echo $request->mesto; ?></li>
			<li><strong>Adresa: </strong> <?php echo $request->adresa; ?> </li>
			<li><strong>Napomena: </strong> <?php echo $request->napomena; ?></li>
		</ul>
	</div>
	<hr>
	<h2>Naruceni predmet(i)</h2>
	<table style="border-collapse: collapse; width: 100%;">
		<tr>
			<th style="text-align: left; padding: 8px;"><strong>Naziv: </strong></th>
			<th style="text-align: left; padding: 8px;"><strong>Sifra: </strong></th>
			<th style="text-align: left; padding: 8px;"><strong>Kolicina: </strong></th>
			<th style="text-align: left; padding: 8px;"><strong>Cena: </strong></th>
		</tr>
		
		<?php foreach($cart->items as $item) : ?>
			
			<tr>				
				<td style="text-align: left; padding: 8px;"><?php echo $item['item']->name; ?></td>
				<td style="text-align: left; padding: 8px;"><?php echo $item['item']->sifra; ?></td>
				<td style="text-align: left; padding: 8px;"><?php echo $item['qty']; ?></td>
				<td style="text-align: left; padding: 8px;"><?php echo $item['price']; ?></td>
			</tr>

		<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<th><strong>Ukupno: </strong><i><?php echo $order->total ?>din</i></th>
			</tr>
	</table>
</body>
</html>