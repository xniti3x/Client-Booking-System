<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><?php echo $user["user_company"]; ?></title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />

	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>/custom_assets/wizard_styles/img/favicon.png" />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
	<link href="<?php echo base_url(); ?>/custom_assets/wizard_styles/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>/custom_assets/wizard_styles/css/material-bootstrap-wizard.css" rel="stylesheet" />

	<link href="<?php echo base_url(); ?>/custom_assets/wizard_styles/css/demo.css" rel="stylesheet" />
</head>
<!--   Big container   -->
<div class="container">
	<div class="row">
		<div class="col-sm-12 col-sm-offset-0">
			<!--      Wizard container        -->
			<div class="wizard-container">
				<div class="card wizard-card" data-color="red" id="wizard">
					<div class="card table-responsive">
						<p class="card-body" align="center">
							<img src="<?php echo base_url(); ?>/custom_assets/wizard_styles/img/check.png" width="32px" /> <br>
							Vielen Dank, Ihre Buchung war erfolgreich !!!<br>
							In Kürze erhalten Sie eine Bestätigungsmail unter, <u><?php echo $_SESSION["meta"]["user"]["email"]; ?></u><br> Sollte innerhalb 5min keine Bestätigung eingehen, bitten wir Sie telefonisch Kontakt aufzunehmen.<br>
						</p>

						<table class="table">
							<tr style="font-weight: bold;">
								<td align="right"><?php echo $_SESSION["meta"]["user"]["firma"]; ?><br />
									<?php echo $_SESSION["meta"]["user"]["strase"]; ?><br />
									<?php echo $_SESSION["meta"]["user"]["plz"] . " " . $_SESSION["meta"]["user"]["ort"]; ?>
								</td>
								<td>
									<?php echo $user["user_company"]; ?><br />
									<?php echo $user["user_address_1"]; ?><br />
									<?php echo $user["user_zip"] . " " . $user["user_city"]; ?><br />
								</td>
							</tr>
						</table>

						<table class="table table-striped table-responsive" cellpadding="5px" cellspacing="15px">
							<tr style="font-weight: bold;">
								<td>Zimmertyp</td>
								<td>Zeitraum</td>
								<td>Nächte</td>
								<td>Preis</td>
								<td>Summe</td>
							</tr>
							<?php $total = 0;
							foreach ($_SESSION["meta"]["rooms"] as $room) { ?>
								<tr>
									<td><?php echo ($room["kategorie"]) ?></td>
									<td><?php echo date('d-m-Y', strtotime($_SESSION["meta"]["start"])) . " - " . date('d-m-Y', strtotime($_SESSION["meta"]["ende"])); ?></td>
									<td><?php echo $days = $_SESSION["meta"]["days"];  ?></td>
									<td><?php echo ($room["selc_preis"]); ?>€</td>
									<td><?php echo $preis = ($days * $room["selc_preis"]);
										$total += $preis;  ?> €</td>

								</tr>
							<?php } ?>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td>Gesamtpreis</td>
								<td><?php echo $total; ?> €</td>
							</tr>
							<tr>
								<td><?php echo $user["user_web"]; ?><br>
									<?php echo $user["user_email"]; ?><br><?php echo $user["user_phone"]; ?></td>
								<td><?php echo $user["user_subscribernumber"]; ?><br><?php echo $user["user_iban"]; ?></td>
								<td><?php echo $user["user_vat_id"]; ?><br><?php echo $user["user_tax_code"]; ?></td>
								<td></td>
								<td><a href="<?php echo site_url("bookings/index"); ?>" class="btn btn-info">NEU BUCHUNG</a></td>
							</tr>
						</table>
					</div>
				</div>
			</div> <!-- wizard container -->
		</div>
	</div> <!-- row -->
</div> <!--  big container -->
<div class="footer">

	<div class="container text-center"></div>
</div>
</div>
</body>

</html>