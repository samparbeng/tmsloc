<?php
session_start();
error_reporting();
include('includes/config.php');
include('includes/cconfig.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}

?>
 
 


<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Car Rental Portal |Reservation Management</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/majorco.css">
  
  <style>

		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
</style>

</head>
<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
					<h2 class="page-title">Vehicle</h2>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Enter Enter Service Record
							</div>
								<div class="panel-body">
								<div class="table-responsive">    
                                <div class="row row-no-gutters">
									<div class="col-sm-6">										
                    					<form name="servicerecord" class="form-style-9" method="post" action="proc-serve-rec.php" enctype="multipart/form-data"">
											<ul>
                                                <li>
						  							<label class="label-style label-split align-left">Date of Service</label>
                                					<input id="servicedate" name="servicedate" type="date" class="field-style field-split align-right" required="true"/>   
						  						</li>  
                                                <li>
													<label class="label-style label-split align-left">Vehicle</label>
													<select type="text" class="field-style align-right" name="servicevehicle" width="208">
                                    					<?php
															$sqldr = "SELECT id, regnumber from fleetmain order by regnumber ";
															$query = $dbh -> prepare($sqldr);
															$query->execute();
															$results = $query->fetchAll(PDO::FETCH_ASSOC);
                                                            echo strtoupper('<option value="" disabled selected>SELECT VEHICLE</option>');
                                                            foreach ($results as $row) {

                                                                echo strtoupper('<option>'.$row['regnumber'].'</option>');
															}
														?>
                                    				</select>
						  						</li>
                                                <li>
													<label class="label-style label-split align-left">Service Odometer</label>
													<input style="text-transform: uppercase;" type="text" name="serviceodo" class="field-style field-split align-right" placeholder="Service Odometer" required="true" />
                          						</li>
                          						<li>
                                                      <label class="label-style label-split align-left">Garage</label>
                                                        <input style="text-transform: uppercase;" type="text" name="servicegarage" class="field-style field-split align-right" placeholder="Garage" required="true"/>
						 	 					</li>
						  						<li>
						  							<label class="label-style label-split align-left">Location</label>
						  							<input style="text-transform: uppercase;" type="text" name="garagelocation" class="field-style field-split align-right" placeholder="Garage Location" required="true"/>
						  						</li>
											</ul>
											<ul>
												<li>
													<label class="label-style label-split align-left">Driver</label>
													<select type="text" class="field-style align-right" name="servicedriver" width="208">
                                    					<?php
															$sqlservedr = "SELECT id, fullname from drivers order by fullname ";
															$query = $dbh -> prepare($sqlservedr);
															$query->execute();
                                                            $results = $query->fetchAll(PDO::FETCH_ASSOC);
                                                            echo strtoupper('<option value="" disabled selected>SELECT DRIVER</option>');
															foreach ($results as $row) {
		   					 								echo strtoupper('<option>'.$row['fullname'].'</option>');
															}
														?>
                                    				</select>
						  						</li>
						  						<li>
						  							<label class="label-style label-split align-left">Service Details</label>
                              						<textarea style="text-transform: uppercase;" name="servicedetail" class="field-style field-split align-right" placeholder="Service Details" rows="6" cols="40"></textarea>
                          						</li>
												<li>
													<label class="label-style label-split align-left">Amount Charged</label>
													<input type="number" min="1" step="any" name="cAmount" class="field-style field-split align-right" placeholder="Amount Spent" required="true"/>
												</li>			
											</ul>
											<ul>
						  						<li>
													<table id="zttc" class="table table-bordered table-hover" cellspacing="0" width="50%">
														<tr>
															<td>
																<button type="submit" name="enter-service-record" id="enter-service-record" class="btn btn-md btn-primary active">ENTER SERVICE RECORD</button>
																<button type="reset" id="setact"  class="btn  btn-md btn-success active">RESET FORM</button>
																<button type="button" id="btclose"  class="btn btn-md btn-danger" onClick="parent.location='dashboard.php'">GO BACK</button>
															</td>
														</tr>
													</table>
						  						</li>
											</ul>
										</form>
									</div>
									</div>		
								</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );

  </script>
</body>
</html>
