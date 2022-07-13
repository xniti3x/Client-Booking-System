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
		                    <form action="<?php echo site_url("bookings/post_step3"); ?>" method="post">
		                <!--        You can switch " data-color="blue" "  with one of the next bright colors: "green", "orange", "red", "purple"             -->

		                    	<div class="wizard-header">
		                        	<h3 class="wizard-title">
									<?php echo $user["user_company"]; ?>
		                        	</h3>
									<h4 class="info-text">Kostenübersicht</h4>
								</div>

								<?php 
								
								//print_r($response);
								?>
		                        <div class="table-responsive">
									
									<table class="table align-middle mb-0 bg-white">
										<thead class="bg-light">
										  <tr>
											<th>Kategorie</th>
											<th>Beschreibung</th>
											<th>Nächte</th>
											<th>Preis</th>
											<th>Summe</th>
										  </tr>
										</thead>
										<tbody>
											
										<?php $total=0; $preis=0; foreach($selected_rooms as $room){ 
									//echo $item;
									//respose=fetch roomObj from id;
									//echo "<br>".$response[$itemid]->kategorie." - ".$_POST["preis-".$itemid]; 
											?>
										  <tr>
											<td>
												<div class="ms-3">
												  <p class="fw-bold mb-1"><?php echo $room["kategorie"]; ?></p>
												</div>
											  <div class="d-flex align-items-center"></div>
											</td>
											<td><p class="fw-normal mb-1"><?php echo $room["beschreibung"]; ?></p></td>
											<td><p class="fw-normal mb-1"><?php echo $nights; ?></p></td>
											<td><p class="fw-normal mb-1"><?php echo $preis=($room["selc_preis"]); ?></p></td>
											
											<td><?php  echo $preis=$preis*$nights; $total+=$preis; ?> €</td>
											
										  </tr>
										<?php } ?>
										  <tr>
											<td><p class="fw-normal mb-1">-</p></td>
											<td><div class="form-check">-</div></td>
											<td><div class="form-check">-</div></td>
											<td><div class="form-check">-</div></td>
											<td><?php echo $total; ?> €</td>
										  </tr>
										</tbody>
									  </table>

								</div>
	                        	<div class="wizard-footer">
	                            	<div class="pull-right">
	                                    <input type='submit' class='btn btn-next btn-fill btn-danger btn-wd' name='next' value='weiter' />
	                                </div>
	                                <div class="pull-left">
	                                    <a href="<?php echo site_url("bookings/index"); ?>" class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Zurück' >Zurück</a>  
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
