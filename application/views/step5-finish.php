<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><?php echo $user["user_company"]; ?></title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<br><br><br>
	<div class="container" style="font-size:14pt;">
<div class="card table-responsive">
<p class="card-body" align="center">
	<img src="<?php echo base_url(); ?>/custom_assets/wizard_styles/img/check.png" width="32px" /> <br>
	Vielen Dank, Ihre Buchung war erfolgreich !!!<br>
	In Kürze erhalten Sie eine Bestätigungsmail unter, <u><?php echo $_SESSION["meta"]["user"]["email"]; ?></u><br> sollte innerhalb 5min keine Bestätigung eingehen, bitten wir Sie telefonisch kontakt aufzunehmen.<br>
	<a href="<?php echo site_url("bookings/index"); ?>" class="btn btn-info">NEU BUCHUNG</a> </p>

	<table class="table table-striped" width="100%" cellpadding="5px" cellspacing="15px">
				<tr style="font-weight: bold;">
								<td align="right">
									<?php echo $_SESSION["meta"]["user"]["firma"]; ?><br />
									<?php echo $_SESSION["meta"]["user"]["strase"]; ?><br />
									<?php echo $_SESSION["meta"]["user"]["plz"]." ".$_SESSION["meta"]["user"]["ort"]; ?>
								</td>
								<td colspan="3">
									<?php echo $user["user_company"]; ?><br />
									<?php echo $user["user_address_1"]; ?><br />
									<?php echo $user["user_zip"]." ".$user["user_city"]; ?><br />
								</td>
				</tr>
				
				<tr>
					<td>Zeitraum: <?php echo date('d-m-Y',strtotime($_SESSION["meta"]["start"]))." - ".date('d-m-Y',strtotime($_SESSION["meta"]["ende"])); ?></td>
					<td>Nächte</td>
					<td>Preis</td>
					<td>Summe</td>
				</tr>
				<?php $total=0; foreach($_SESSION["meta"]["rooms"] as $room){ ?>	
				<tr>
				<td><?php echo($room["kategorie"])." - ".($room["beschreibung"]); ?></td>
				<td><?php echo $days=$_SESSION["meta"]["days"];  ?></td>	
				<td><?php echo ($room["selc_preis"]); ?></td>
				<td><?php echo $preis=($days*$room["selc_preis"]); $total+=$preis;  ?> €</td>
				
				</tr>
				<?php } ?>
				<tr>
					<td></td><td></td><td></td>
					<td><?php echo $total; ?> €</td>
				</tr>
				<tr>
					<td></td><td></td><td></td>
					<td> <br></td>
				</tr>
				<tr>
				<td> <?php echo $user["user_company"]; ?><br /><?php echo $user["user_address_1"]; ?><br /><?php echo $user["user_zip"]." ".$user["user_city"]; ?><br /></td>
				<td><?php echo $user["user_web"]; ?><br>
				<?php echo $user["user_email"]; ?><br><?php echo $user["user_phone"]; ?></td><td><?php echo $user["user_subscribernumber"]; ?><br><?php echo $user["user_iban"]; ?></td><td><?php echo $user["user_vat_id"]; ?><br><?php echo $user["user_tax_code"]; ?></td>
				</tr>
			</table>
		</div>

		</div>
		</body>
</html>