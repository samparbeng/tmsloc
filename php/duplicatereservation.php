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

<?php 
    $selresmod = $_GET['dupid'];
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
					<h2 class="page-title">Reservations</h2>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Modify Reservations
							</div>
								<div class="panel-body">
									<div class="row row-no-gutters">
									<div class="col-sm-7">										                                    
                                    <?php
										$sql = "SELECT sydate, ashase, awie, compname, contactper, phonenum, destination, assignedvehicle, assigneddriver, tripcode, vtype, remarks, user, 
                                        duration, confirm, mypr from reservations where mypr='$selresmod'";
										$result = mysqli_query ($conn, $sql) or die (mysqli_error ());
                                        $cnt=1;
                                        while ($row2 = mysqli_fetch_array ($result)){
                                    ?>
                                        <form name="resEntry" class="form-style-9" method="post" action="procdup.php" enctype="multipart/form-data"">
											<ul>
                          						<li>
													<label class="label-style label-split align-left">Client Name</label>
													<input style="text-transform: uppercase;" type="text" name="txtCompName" class="field-style field-split align-right" value="<?php echo $row2['compname'];?>" required="true"/>
                          						</li>
                          						<li>
						  							<label class="label-style label-split align-left">Contact Person</label>
						  							<input style="text-transform: uppercase;" type="text" name="txtContPer" class="field-style field-split align-right" value="<?php echo $row2['contactper'];?>" required="true"/>
						 	 					</li>
						  						<li>
						  							<label class="label-style label-split align-left">Phone Number</label>
						  							<input type="text" name="txtPhoneNum" class="field-style field-split align-right" value="<?php echo $row2['phonenum'];?>" required="true"/>
						  						</li>
											</ul>
											<ul>
												<li>
													<label class="label-style label-split align-left">Vehicle Category</label>
													<select type="text" class="field-style align-right" name="txtVehCat" width="208" placeholder="Select Vehicle Category">
                                    					<?php
															$sqldr = "SELECT category, descri from vehcat order by id ";
															$query = $dbh -> prepare($sqldr);
															$query->execute();
															$results = $query->fetchAll(PDO::FETCH_ASSOC);
																echo strtoupper('<option>'.$row2['vtype'].'</option>');
															foreach ($results as $row) 
                                                            {
		   					 								    echo strtoupper('<option>'.$row['descri'].'</option>');
															}
														?>
                                    				</select>
						  						</li>
						  						<li>
						  							<label class="label-style label-split align-left">Start Date</label>
                                					<input id="stadate" name="stadate" type="text" class="field-style field-split align-right" value=<?php echo date("m/d/Y", strtotime($row2['ashase']));?> required="true"/>   
						  						</li>
						  						<li>
						  							<label class="label-style label-split align-left">End Date</label>
                                					<input id="enddate"  name="enddate" type="text" class="field-style field-split align-right" value=<?php echo date("m/d/Y", strtotime($row2['awie']));?> required="true"/>
						  						</li> 		
						  						<li>
						  							<label class="label-style label-split align-left">Duration</label>
						  							<input id="txtDur" type="number" name="txtDur" class="field-style field-split align-right" value=<?php echo $row2['duration'];?> required="true" />
                          						</li>
                          						<li>
						  							<label class="label-style label-split align-left">Destination</label>
                              						<input style="text-transform: uppercase;" type="text" name="txtDestination" class="field-style field-split align-right" value=<?php echo $row2['destination'];?> required="true"/>
                          						</li>
                        					</ul>
											<ul>
						  						<li>
						  							<label class="label-style label-split align-left">Remarks</label>
                              						<textarea style="text-transform: uppercase;" name="txtRemarks" class="field-style field-split align-right" value="<?php echo $row2['remarks'];?>" rows="6" cols="40"></textarea>
                          						</li>
											</ul>
											<ul>
						  						<li>
													<table id="zttc" class="display table table-striped table-bordered table-hover" cellspacing="0" width="50%">
														<tr>
															<td>																
																<button type="submit" name="dupres" id="dupres" class="btn btn-md btn-primary active">SAVE CHANGES</button>
																<button type="reset" id="setact"  class="btn  btn-md btn-success active">CANCEL CHANGES</button>
																<button type="button" id="btclose"  class="btn btn-md btn-danger" onClick="parent.location='dashboard.php'">GO BACK</button>
															</td>
														</tr>
													</table>
						  						</li>
											</ul>
										</form>
                                    </div>
                                    <?php 
                                        }
                                        ?>		
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

<script>
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
</script>
</body>
</html>
