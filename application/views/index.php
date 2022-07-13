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
	<link rel="stylesheet" href="https://common.olemiss.edu/_js/pickadate.js-3.5.3/lib/themes/classic.css" id="theme_base">
		<link rel="stylesheet" href="https://common.olemiss.edu/_js/pickadate.js-3.5.3/lib/themes/classic.date.css" id="theme_date">
</head>
<body>
	<div class="image-container set-full-height">

	    <!--   Big container   -->
	    <div class="container">
	        <div class="row">
		        <div class="col-sm-12 col-sm-offset-0">
		            <!--      Wizard container        -->
		            <div class="wizard-container">
		                <div class="card wizard-card" data-color="red" id="wizard">
							<form action="<?php echo site_url("bookings/post_step1") ?>" method="post">
		                    	<div class="wizard-header">
		                        	<h3 class="wizard-title">
									<?php echo($user["user_company"]); ?>
		                        	</h3>
									<h4 class="info-text"></h4>
								</div>
		                        <div class="tab-content">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group label-floating">
												<label class="control-label">Start</label>
												<input id="date_1" name="start" data-date-inline-picker="true" value="<?php echo htmlspecialchars($_POST['start'] ?? date("Y-m-d"), ENT_QUOTES); ?>" type="date" class="form-control">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group label-floating">
												<label class="control-label">Ende</label>
												<input id="date_2" name="ende" data-date-inline-picker="true" value="<?php echo htmlspecialchars($_POST['ende'] ?? date('Y-m-d', strtotime("+1 day")), ENT_QUOTES); ?>" type="date" class="form-control">
											</div>
										</div>
										<div><?php empty($rooms)?"":print_r($rooms); ?></div>
									</div>
									<div align="center" style="color:<?php echo (empty($error_message)? "#000":"red"); ?>; font-size:14pt;" ><br><?php echo (empty($error_message))?"Bitte Übernachtunszeitraum auswählen.":$error_message; ?></div>
									
								</div>
								
	                        	<div class="wizard-footer">
	                            	<div class="pull-right"><input type='submit' class='btn btn-next btn-fill btn-danger btn-wd' name='weiter' value='weiter' /></div>
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
	<script src="https://common.olemiss.edu/_js/jquery.js"></script>
		<script src="https://common.olemiss.edu/_js/pickadate.js"></script>
		<script type="text/javascript">
// PICKADATE FORMATTING

	$( '#date_1' ).pickadate( {
		format: 'dddd, dd mmm, yyyy',
		formatSubmit: 'yyyy-mm-dd',
		firstDay: 1,
		monthsFull: [ 'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember' ],
		monthsShort: [ 'Jan', 'Feb', 'März', 'Apr', 'Mai', 'Juni', 'Juli', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez' ],
		weekdaysShort: [ 'So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa' ],
		weekdaysFull: [ 'Sontag', 'Montag', 'Dinstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag' ],
		today: 'Heute',
		clear: false,
		close:false,
		selectMonths: true,
		selectYears: true,
		hiddenName: true,
		min: true,
		max: 90,
		closeOnSelect: true,
		onStart: function() {
			this.set('select', new Date())
		},
	}
	);

	 $( '#date_2' ).pickadate( {
		format: 'dddd, dd mmm, yyyy',
		formatSubmit: 'yyyy-mm-dd',
		firstDay: 1,
		monthsFull: [ 'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember' ],
		monthsShort: [ 'Jan', 'Feb', 'März', 'Apr', 'Mai', 'Juni', 'Juli', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez' ],
		weekdaysShort: [ 'So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa' ],
		weekdaysFull: [ 'Sontag', 'Montag', 'Dinstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag' ],
		today: 'Heute',
		clear: false,
		close:false,
		selectMonths: true,
		selectYears: true,
		hiddenName: true,
		onStart: function() {
			const date = new Date();
			date.setDate(date.getDate() + 1);
			this.set('select', date);
		},
		min: +1,
		max: 90,
		closeOnSelect: true,
	}
	);

</script>
</body>
</html>
