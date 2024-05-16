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
  	<link rel="stylesheet" href="css/jquery-bootstrap-datepicker.css">
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
					<h2 class="page-title">Drivers</h2>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Add Driver
							</div>
								<div class="panel-body">
									<div class="row row-no-gutters">
									<div class="col-sm-7">										
                    					<form name="resEntry" class="form-style-9" method="post" action="procdri.php" enctype="multipart/form-data"">
											<ul>
                          						<li>
													<label class="label-style label-split align-left">Last Name</label>
													<input style="text-transform: uppercase;" type="text" name="txtlastname" class="field-style field-split align-right" placeholder="LAST NAME" required="true" />
                          						</li>
                                                <li>
													<label class="label-style label-split align-left">First Name</label>
													<input style="text-transform: uppercase;" type="text" name="txtfirstname" class="field-style field-split align-right" placeholder="FIRST NAME" required="true" />
                          						</li>
                          						<li>
						  							<label class="label-style label-split align-left">Category</label>
						  							<input style="text-transform: uppercase;" type="text" name="txtcat" class="field-style field-split align-right" placeholder="DRIVER CATEGORY" required="true"/>
						 	 					</li>						  						
                                                <li>
						  							<label class="label-style label-split align-left">Phone Number</label>
						  							<input type="text" name="txtPhoneNum" class="field-style field-split align-right" placeholder="PHONE NUMBER" required="true"/>
						  						</li>
											</ul>					
											<ul>
						  						<li>
													<table id="zttc" class="display table table-striped table-bordered table-hover" cellspacing="0" width="50%">
														<tr>
															<td>
																<button type="submit" name="savedriver" id="savedriver" class="btn btn-md btn-primary active">SAVE DRIVER</button>
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

<!--script>
$('#stadate').datepicker();
$('#enddate').datepicker({
  onSelect: function() {
    var diff = dateDiff($('#stadate').datepicker("getDate"), $('#enddate').datepicker("getDate"));
    $('#txtDur').val(diff + 1);
  }
});

function dateDiff(startDate, endDate) {
  if(endDate && startDate)
    return (endDate.getTime() - startDate.getTime()) / (1000*60*60*24);
  return "You must complete both dates!";
}
</script-->

<!--script>
$('#stadate').datepicker();
$('#enddate').datepicker({
  onSelect: function() {
    var diff = dateDiff($('#stadate').datepicker("getDate"), $('#enddate').datepicker("getDate"));
    $('#txtDur').val(diff + 1);
  }
});
function dateDiff(startDate, endDate) {
  if(endDate && startDate)
    return (endDate.getTime() - startDate.getTime()) / (1000*60*60*24);
  return "You must complete both dates!";
}
</script-->
</body>
</html>
