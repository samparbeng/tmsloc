<?php
global $dbh;
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
	
	<title>Car Rental Portal|Vendor Management</title>
	
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
	<!-- Admin Style -->
  	<link rel="stylesheet" href="css/style.css">
  	<link rel="stylesheet" href="css/majorco.css">
  	<link rel="stylesheet" href="css/jquery-bootstrap-datepicker.css">
  <style>

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
					<h2 class="page-title">Vendors</h2>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Add Vendors
							</div>
								<div class="panel-body">
									<div class="row row-no-gutters">
									    <div class="col-sm-5">
                                            <form name="venregister" class="form-style-9" action="venproc.php" method="post" enctype="multipart/form-data">
                                                <ul>
                                                    <li>                                      
														<label class="label-style label-split align-left">VENDOR CAT</label>
                                                            <select type="text" class="field-style" name="vendorcat">
                                                                <?php
                                                                    $sqldr = "SELECT * from vendorcat order by CatNames ";
                                                                    $query = $dbh -> prepare($sqldr);
                                                                    $query->execute();
                                                                    $results = $query->fetchAll(PDO::FETCH_ASSOC);
                                                                    echo strtoupper('<option value="" disabled selected>SELECT CATEGORY</option>');
                                                                    foreach ($results as $row) {
                                                                    echo strtoupper('<option>'.$row['CatNames'].'</option>');
                                                                    }
                                                                ?>
                                                            </select>
                                                    </li>
                                                    <li>						  			
						  							    <label class="label-style label-split align-left">Vendor Name</label>
                                                            <input style="text-transform: uppercase;" type="text" name="txtVendorName" class="field-style field-split align-right" placeholder="Vendor Name" required="required"/>
                                                    </li>
                                                    <li>						  			
						  							    <label class="label-style label-split align-left">Contact Person</label>
                              						    <input style="text-transform: uppercase;" type="text" name="txtContactPerson" class="field-style field-split align-right" placeholder="Contact Person" required="required"/>
                          						    </li>
                                                    <li>						  			
						  							    <label class="label-style label-split align-left">Vendor Address</label>
                              						    <input style="text-transform: uppercase;" type="text" name="txtVendorAddress" class="field-style field-split align-right" placeholder="Contact Address" required="required"/>
                          						    </li>
                                                    <li>						  			
						  							    <label class="label-style label-split align-left">Phone Contact</label>
                              						    <input style="text-transform: uppercase;" type="text" name="txtTellNum" class="field-style field-split align-right" placeholder="Tell Num" required="required"/>
                          						    </li>                                                                                                
                                                    <li>                                      
														<label class="label-style label-split align-left">PAYMENT TYPE</label>
															<select type="text" class="field-style" name="PayType">
                                    							<?php
																	$sqldr = "SELECT * from PayType order by PayType ";
																	$query = $dbh -> prepare($sqldr);
																	$query->execute();
																	$results = $query->fetchAll(PDO::FETCH_ASSOC);
                                                            		echo strtoupper('<option value="" disabled selected>SELECT TYPE</option>');
                                                            		foreach ($results as $row) {
                                                                		echo strtoupper('<option>'.$row['PayType'].'</option>');																	
																	}																
																?>
                                    						</select>
						  							</li>                     
                                                    <li>						  			
						  							    <label class="label-style label-split align-left">Credit Term</label>
                              						    <input style="text-transform: uppercase;" type="text" name="CreditTerm" class="field-style field-split align-right" placeholder="Credit Term" required="required"/>
                          						    </li>                                                                                                                                                                                                                                                                                                                              
                                                    <li>
													    <table id="zttc" class="display table table-striped table-bordered table-hover" cellspacing="0" width="50%">
														    <tr>
															    <td>
																    <button type="submit" name="entres" id="entvendor" class="btn btn-md btn-primary active">ADD VENDOR</button>
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
	<!--script src="js/jquery-ui-1.8.18.custom.min.js"></script-->
	<!--script src="js/jquery-1.7.1.min.js"></script-->														




</body>
</html>
		