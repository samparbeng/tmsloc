<?php
session_start();
error_reporting();
include('includes/config.php');
include('includes/cconfig.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:loadres.php');
}
?>

<?php
 if ($_SERVER['REQUEST_METHOD'] ==='POST'){
	if(!empty($_POST['drsel'])) {
		$assigneddriver = trim($_POST['drsel']);
	}
	if(!empty($_POST['vehsel'])) {
		$assignedvehicle = trim($_POST['vehsel']);
	}
	if(!empty($_POST['tpsel'])) {
		$tripcode = trim($_POST['tpsel']);
	}
	if(!empty($_POST['settingid'])) {
		$settingid = trim($_POST['settingid']);
	}

	mysqli_query($conn, "UPDATE reservations SET assigneddriver='$assigneddriver', assignedvehicle='$assignedvehicle', tripcode='$tripcode'
	WHERE mypr=$settingid");
	echo "Record updated successfully";
	$msg="Details succefully set for this reservation";

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
	
	<title>Car Rental Portal |Admin Manage testimonials</title>

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
							<div class="panel-heading">View Reservations</div>
							<div class="panel-body">
								<table id="zttb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="50%">
									<thead>
										<tr>
										    <th width="18%">ITEM</th>
											<th>DETAILS</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th width="18%">ITEM</th>
										    <th>DETAILS</th>
										</tr>
									</tfoot>
									<tbody>

									<?php $sql = "SELECT sydate, ashase, awie, compname, contactper, phonenum, destination, assignedvehicle, assigneddriver, tripcode, vtype, remarks, user, 
									duration, confirm, mypr from reservations where mypr = trim($settingid)";
									$query = $dbh -> prepare($sql);
									$query->execute();
									$results=$query->fetchAll(PDO::FETCH_OBJ);
									$cnt=1;
									if($query->rowCount() > 0)
									{
									foreach($results as $result)
									{?>	
                                        <tr>
											<td width="19%">DATE RESERVED</td>
											<td><strong><?php echo htmlentities($result->sydate);?></strong></td>
										</tr>
										<tr>
											<td>RESERVATION ID</td>
											<td><strong><?php echo htmlentities($result->mypr);?></strong></td>
										</tr>
										<tr>

										<tr>
											<td>COMPANY NAME</td>
											<td><strong><?php echo htmlentities($result->compname);?></strong></td>
										</tr>
										<tr>
											<td>CONTACT'S NAME</td>
											<td><strong><?php echo htmlentities($result->contactper);?></strong></td>
										</tr>
										<tr>
											<td>CONTACT NUMBER</td>
											<td><strong><?php echo htmlentities($result->phonenum);?></strong></td>
										</tr>

                                        <tr>
											<td>START DATE</td>
											<td><strong><?php echo date("d-m-Y", strtotime($result->ashase));?></strong></td>
										</tr>
										<tr>
											<td>END DATE</td>
											<td><strong><?php echo date("d-m-Y", strtotime($result->awie));?></strong></td>
										</tr>
										<tr>
											<td>NO. OF DAYS</td>
											<td><strong><?php echo htmlentities($result->duration);?></strong></td>
										</tr>
										<tr>
											<td>VEHICLE CATEGORY</td>
											<td><strong><?php echo htmlentities($result->vtype);?></strong></td>
										</tr>
										<tr>
											<td>DESTINATION</td>
											<td><strong><?php echo htmlentities($result->destination);?></strong></td>
										</tr>
                                        <tr>
											<td>STATUS</td>
											<td><strong><?php echo htmlentities($result->confirm);?></strong></td>
										</tr>
										<tr>
											<td>ASSIGNED DRIVER</td>
											<td><strong><?php echo htmlentities($result->assigneddriver);?></strong></td>
										</tr>
										<tr>
											<td>ASSIGNED VEHICLE</td>
											<td><strong><?php echo htmlentities($result->assignedvehicle);?></strong></td>
										</tr>
										<tr>
											<td>TRIP CODE</td>
											<td><strong><?php echo htmlentities($result->tripcode);?></strong></td>
										</tr>
										<tr>
											<td>REMARKS</td>
											<td><strong><?php echo htmlentities($result->remarks);?></strong></td>
										</tr>
										<tr>
											<td>USER ID</td>
											<td><strong><?php echo htmlentities($result->user);?></strong></td>
										</tr>

										<?php $cnt=$cnt+1; }} ?>										
									</tbody>
								</table>
							</div>
							<div>
							
							</div>
                        </div>
                    </div>
                </div>
			</div>
			<?php 
 
?>

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
</body>
</html>
