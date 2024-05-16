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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	

</head>
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
						<h2 class="page-title">Fleet</h2>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">View Vehicle Details</div>
							<div class="panel-body">
								<div class="row">
										<table id="zctb" class="display table table-responsive table-striped table-bordered table-hover" cellspacing="0" width=100%">
											<thead>
												<tr>
													<th>#</th>
													<th>DATE OF SERVICE</th>
													<th>VEHICLE</th>
													<th>SERVICE ODOMETRE</th>
													<th>GARAGE</th>
													<th>LOCATION</th>
													<th>DRIVER</th>
													<th>AMOUNT</th>
													<th>USER</th>
													<th>SERVID</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
												<th>#</th>
													<th>DATE OF SERVICE</th>
													<th>VEHICLE</th>
													<th>SERVICE ODOMETRE</th>
													<th>GARAGE</th>
													<th>LOCATION</th>
													<th>DRIVER</th>
													<th>AMOUNT</th>
													<th>USER</th>
													<th>SERVID</th>
												</tr>
											</tfoot>
											<tbody>
												<?php $sql = "SELECT id, servicedate, servicevehicle, serviceodo, servicegarage, glocation, servicedriver, 
													serviceuser, amountspent from servicerecords order by servicedate";
													$query = $dbh -> prepare($sql);
													$query->execute();
													$results=$query->fetchAll(PDO::FETCH_OBJ);
													$cnt=1;
													if($query->rowCount() > 0)
														{
															foreach($results as $result)
														{?>	
												<tr>
													<td><?php echo htmlentities($cnt);?></td>
													<td><?php echo date("d-m-Y", strtotime($result->servicedate));?></td>							
													<td><a href="selected-vehicle-sr.php?serveveh=<?php echo htmlentities($result->servicevehicle);?>"><?php echo htmlentities($result->servicevehicle);?></a></td>
													<td><?php echo htmlentities($result->serviceodo);?></td>
													<td><?php echo htmlentities($result->servicegarage);?></td>
													<td><?php echo htmlentities($result->glocation);?></td>
													<td><?php echo htmlentities($result->servicedriver);?></td>
													<td><?php echo ($result->amountspent);?></td>
													<td><?php echo htmlentities($result->serviceuser);?></td>
													<td><a href="selected-vehicle-sr.php?serveveh=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->id);?></a></td>
												</tr>
													<?php $cnt=$cnt+1; }} ?>										
											</tbody>
											<table id="zttc" class="table table-bordered table-hover" cellspacing="0" width="50%">
												<tr>
													<td>
														<button type="button" id="btref" class="btn btn-md btn-danger" onClick="parent.location='view-all-service-records.php'">REFRESH PAGE</button>
														<button type="button" id="btclose"  class="btn btn-md btn-danger" onClick="parent.location='add-service-record.php'">GO BACK</button>
													</td>
												</tr>
											</table>
										</table>
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
</body>
</html>
