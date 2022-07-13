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
		                    <form action="<?php echo site_url("bookings/post_step4"); ?>" method="post">
		                <!--        You can switch " data-color="blue" "  with one of the next bright colors: "green", "orange", "red", "purple"             -->

		                    	<div class="wizard-header">
		                        	<h3 class="wizard-title">
									<?php echo $user["user_company"]; ?>
		                        	</h3>
									<h4 class="info-text">Kontaktdaten</h4>
								</div>
								<?php //session_start();   echo session_id(); ?>
		                        <div class="tab-content">
									
									<!-- * Firma oder (vorname,nachname) ausfüllen. -->
									<div class="row">
										<div class="col-sm-6">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="material-icons"></i>
												</span>
												<div class="form-group label-floating">
													  <label class="control-label">* Firma</label>
													  <input name="firma" type="text" value="<?php echo htmlspecialchars($_POST['firma'] ?? '', ENT_QUOTES); ?>" class="form-control">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="material-icons"></i>
												</span>
												<div class="form-group label-floating">
													  <label class="control-label"># Vorname</label>
													  <input name="firstname" value="<?php echo htmlspecialchars($_POST['firstname'] ?? '', ENT_QUOTES); ?>" type="text" class="form-control">
												</div>
											</div>
										</div>

										<div class="col-sm-6">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="material-icons"></i>
												</span>
												<div class="form-group label-floating">
													  <label class="control-label"># Nachname</label>
													  <input name="lastname" value="<?php echo htmlspecialchars($_POST['lastname'] ?? '', ENT_QUOTES); ?>" type="text" class="form-control">
												</div>
											</div>
										</div>

										<div class="col-sm-6">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="material-icons"></i>
												</span>
												<div class="form-group label-floating">
													  <label class="control-label">Postleitzahl</label>
													  <input name="postcode" value="<?php echo htmlspecialchars($_POST['postcode'] ?? '', ENT_QUOTES); ?>" type="text" class="form-control">
												</div>
											</div>
										</div>
										
										<div class="col-sm-6">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="material-icons"></i>
												</span>
												<div class="form-group label-floating">
													  <label class="control-label">Ort</label>
													  <input name="city" value="<?php echo htmlspecialchars($_POST['city'] ?? '', ENT_QUOTES); ?>" type="text" class="form-control">
												</div>
											</div>
										</div>

										<div class="col-sm-6">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="material-icons"></i>
												</span>
												<div class="form-group label-floating">
													  <label class="control-label">Straße.Nr</label>
													  <input name="street" value="<?php echo htmlspecialchars($_POST['street'] ?? '', ENT_QUOTES); ?>" type="text" class="form-control">
												</div>
											</div>
										</div>


										<div class="col-sm-6">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="material-icons"></i>
												</span>
												<div class="form-group label-floating">
													  <label class="control-label">* Email</label>
													  <input name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES); ?>" type="text" class="form-control">
												</div>
											</div>
										</div>

										<div class="col-sm-6">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="material-icons"></i>
												</span>
												<div class="form-group label-floating">
													  <label class="control-label"># Tel.</label>
													  <input name="phone" value="<?php echo htmlspecialchars($_POST['phone'] ?? '', ENT_QUOTES); ?>" type="text" class="form-control">
												</div>
											</div>
										</div>

									</div>
									<div><?php echo empty($error_msg)?"":$error_msg; ?></div>
								</div>
	                        	<div class="wizard-footer">
	                            	<div class="pull-right">
	                                    <input type='submit' class='btn btn-next btn-fill btn-danger btn-wd' name='next' value='Jetzt Buchen' />
	                                </div>
	                                <div class="pull-left">
	                                <a href="<?php echo site_url("bookings/index"); ?>" class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Zurück'>Zurück</a>
	                                </div>
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
