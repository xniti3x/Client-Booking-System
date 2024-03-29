<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><?php echo $user["user_company"]; ?></title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />

	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>/custom_assets/wizard_styles/img/apple-icon.png" />
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
					<form action="<?php echo site_url("bookings/post_step2"); ?>" method="post">
						<!--        You can switch " data-color="blue" "  with one of the next bright colors: "green", "orange", "red", "purple"             -->

						<div class="wizard-header">
							<h2 class="info-text">Info</h2>
						</div>

						<div class="tab-content" align="center">
							<h3 style="color:red;">Es tut uns leid, Leider hat jemand in der gleichen Zeit eins der Zimmern reserviert.<br>
								Bitte starten sie den Prozess erneut.
							</h3>
						</div>
						<div class="wizard-footer">
							<div class="pull-right">
								<a href="<?php echo site_url("bookings/index"); ?>" class='btn btn-next btn-fill btn-danger btn-wd' name='weiter' value='OK'>OK</a>
							</div>
							<div class="pull-left"></div>
							<div class="clearfix"></div>
						</div>
					</form>
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