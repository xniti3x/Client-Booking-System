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
		                    <form id="myform" action="<?php echo site_url("bookings/post_step2"); ?>" method="post">

		                    	<div class="wizard-header">
		                        	<h3 class="wizard-title"><?php echo $user["user_company"]; ?></h3>
									<h4 class="info-text">Raumauswahl</h4>
									<h5>Zeitraum: <?php echo date('d-m-Y',strtotime($_SESSION["meta"]["start"]))." - ".date('d-m-Y',strtotime($_SESSION["meta"]["ende"])); ?></h5>
								</div>

		                        <div class="table-responsive">
									<table class="table align-middle mb-0 bg-white">
										<thead class="bg-light">
										  <tr>
											<th>Kategorie</th>
											<th><i class="fa fa-user user"></i></th>
											<th><i class="fa fa-user user"></i><i class="fa fa-user user"></i></th>
											<th><i class="fa fa-user user"></i><i class="fa fa-user user"></i><i class="fa fa-user user"></i></th>
											<th>Buchen</th>
										  </tr>
										</thead>
										<tbody>
											
											<?php if(!empty($response)){  foreach($response as $obj){ ?>
										  <tr>
											<td>
												<div class="ms-4">
												  <p class="fw-bold mb-1"><?php echo $obj->kategorie; ?></p>
												</div>
											  <div class="d-flex align-items-center"></div>
											</td>
											<!-- <td><p class="fw-normal mb-1"><?php echo $obj->beschreibung; ?></p></td> -->
											<td>
											  <div class="form-check">
												<input class="form-check-input" type="radio" name="preis-<?php echo $obj->id; ?>" checked value="<?php echo $obj->preis1; ?>"/>€<?php echo $obj->preis1; ?>
											  </div>
											</td>
											<td>
												<div class="form-check">
													<?php  if(!empty($obj->preis2)){
														?> 
														<input class="form-check-input" type="radio" name="preis-<?php echo $obj->id; ?>" value="<?php echo $obj->preis2; ?>"/><?php echo $obj->preis2;
													} 
														?>
												</div>
											</td>
											<td>
												<div class="form-check">
													<?php  if(!empty($obj->preis3)){
														?> 
														<input class="form-check-input" type="radio" name="preis-<?php echo $obj->id; ?>" value="<?php echo $obj->preis3; ?>"/><?php echo $obj->preis3;
													} ?> 
												</div>
											</td>
											<td><div class="box" align="center" style="width:20px;"><input  class="form-check-input" type="checkbox" name="buchung[]" value="<?php echo $obj->id; ?>" /></div></td>
										  </tr>
										<?php } }?> 
										</tbody>
									  </table>
										
									  <br><?php echo empty($error_msg) ?"":$error_msg; ?>
								</div>
								<p style="font-size: 14pt;" align="center">Bitte beachten Sie, alle aufgelisteten Preise sind ohne Frühstück.</p>
	                        	<div class="wizard-footer">
								<div class="pull-right">
	                                   <?php  if(empty($error_msg)){ ?> <input type='button' onclick="myFunction()" class='btn btn-next btn-fill btn-danger btn-wd' name='next' value='weiter' /> <?php }else{ ?><a href="<?php echo site_url("bookings/index"); ?>" class='btn btn-next btn-fill btn-danger btn-wd' value='OK'>OK</a> <?php } ?>
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
	<script>
function myFunction() {
	var cboxes = document.getElementsByName('buchung[]');
    var len = cboxes.length;
	var next=false;
    for (var i=0; i<len; i++) {
        if(cboxes[i].checked==true){next=true; break;}
    }
	if(next){
  	document.getElementById("myform").submit();
	}else{ 
		var collection = document.getElementsByClassName("box");
		for (let i = 0; i < collection.length; i++) {
		collection[i].style.backgroundColor = "#FF9FC2";
		}
		alert("Bitte wählen Sie ein Zimmer aus.");
	}
}
</script>
</body>
</html>
