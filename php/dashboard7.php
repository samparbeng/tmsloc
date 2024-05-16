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
</head>
<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
			<div id="dashboard-heading" class="col-sm-12">
				<h2 class="page-title">Dashboard</h2>																											
				<div id="welcome-info" class="row">												
					<div class="col-md-12">	
						<div class="panel panel-default">
							<div class="panel-body bk-primary text-light">
								<table>
									<tr><td>WELCOME:			</td><td>--</td></tr>
									<tr><td>TODAY'S DATE:		</td><td>--</td></tr>
									<tr><td>TODAY'S FOREX RATE:	</td><td>--</td></tr>																					
								</table>
							<div class="stat-panel-number h1 "></div>
						</div>
					</div>					
				</div>														
									
				<div id="first-row" class="col-sm-12">																																
					<div id="users" class="col-sm-3">
						<div class="panel panel-default">
							<div class="panel-body bk-primary text-light">
								<div class="stat-panel text-center">
									<?php 
										$sql ="SELECT id from administrator ";
										$query = $dbh -> prepare($sql);
										$query->execute();
										$results=$query->fetchAll(PDO::FETCH_OBJ);
										$regusers=$query->rowCount();
									?>
										<div class="stat-panel-number h1 "><?php echo htmlentities($regusers);?></div>
										<div class="stat-panel-title text-uppercase">Registered Users</div>
								</div>
							</div>
								<a href="reg-users.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
						</div>
					</div>								
					<div id="vehicles" class="col-sm-3">
						<div class="panel panel-default">
							<div class="panel-body bk-success text-light">
								<div class="stat-panel text-center">
									<?php 
											$sql1 ="SELECT REGNUMBER from fleetmain ";
											$query1 = $dbh -> prepare($sql1);;
											$query1->execute();
											$results1=$query1->fetchAll(PDO::FETCH_OBJ);
											$totalvehicle=$query1->rowCount();
										?>
										<div class="stat-panel-number h1 "><?php echo htmlentities($totalvehicle);?></div>
										<div class="stat-panel-title text-uppercase">Listed Vehicles</div>
								</div>
							</div>
								<a href="view-fleet-det.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
						</div>
					</div>																					
					<div id="drivers" class="col-sm-3">
						<div class="panel panel-default">
							<div class="panel-body bk-info text-light">
								<div class="stat-panel text-center">
									<?php 
										$sql2 ="SELECT FULLNAME from drivers";
										$query2= $dbh -> prepare($sql2);
										$query2->execute();
										$results2=$query2->fetchAll(PDO::FETCH_OBJ);
										$bookings=$query2->rowCount();
									?>
										<div class="stat-panel-number h1 "><?php echo htmlentities($bookings);?></div>
										<div class="stat-panel-title text-uppercase">NUMBER OF DRIVERS</div>
								</div>
							</div>
								<a href="view-drivers.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
						</div>
					</div>													
					<div id="pendingres" class="col-sm-3">
							<div class="panel panel-default">
								<div class="panel-body bk-warning text-light">
									<div class="stat-panel text-center">
										<?php 
											$sql3 ="SELECT MYPR from reservations where confirm='Pending' ";
											$query3= $dbh -> prepare($sql3);
											$query3->execute();
											$results3=$query3->fetchAll(PDO::FETCH_OBJ);
											$brands=$query3->rowCount();
										?>												
										<div class="stat-panel-number h1 "><?php echo htmlentities($brands);?></div>
										<div class="stat-panel-title text-uppercase">PENDING RESERVATIONS</div>
									</div>
								</div>
									<a href="view-pending-reservations.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
							</div>
						</div>					
					</div>																							
				</div>	
				
				<div id="second-row" class="col-sm-12">	
					<div id="allreservations" class="col-sm-3">
						<div class="panel panel-default">
							<div class="panel-body bk-primary text-light">
								<div class="stat-panel text-center">
									<?php 
										$sql5 ="SELECT resid from reservations ";
										$query5= $dbh -> prepare($sql5);
										$query5->execute();
										$results5=$query5->fetchAll(PDO::FETCH_OBJ);
										$totalreservations=$query5->rowCount();
									?>
										<div class="stat-panel-number h1 "><?php echo htmlentities($totalreservations);?></div>
										<div class="stat-panel-title text-uppercase">Total Reservations</div>
								</div>
							</div>
								<a href="view-reservations.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
						</div>
					</div>					
					<div id="vendors" class="col-sm-3">
						<div class="panel panel-default">
							<div class="panel-body bk-success text-light">
								<div class="stat-panel text-center">
									<?php 
										$sqlvendor ="SELECT id from vendor ";
										$query6= $dbh -> prepare($sqlvendor);
										$query6->execute();
										$results6=$query6->fetchAll(PDO::FETCH_OBJ);
										$totalreservations=$query6->rowCount();
									?>
										<div class="stat-panel-number h1 "><?php echo htmlentities($totalreservations);?></div>
										<div class="stat-panel-title text-uppercase">Vendors</div>
								</div>
							</div>
								<a href="view-vendor-det.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
						</div>
					</div>										
					<div id="alerts" class="col-sm-3">
						<div class="panel panel-default">
							<div class="panel-body bk-danger text-light">
								<div class="stat-panel text-center">
									<?php 													
										$dtoday = new datetime();
										echo $dtoday->format('Y-m-d H:i:s');
										$sqlinsurance ="SELECT * FROM fleetmain WHERE insurance >= $dtoday";
										$query6= $dbh -> prepare($sqlinsurance);
										$query6->execute() or die(print_r($query6->errorInfo(), true));													
										$results6=$query6->fetchAll(PDO::FETCH_OBJ);
										if($query6->rowCount > 0)
										{
											$totalinsurance=$query6->rowCount();
										}else
										{
											$totalinsurance=0;
										}
									?>
										<div class="stat-panel-number h1 "><?php echo $totalinsurance;?></div>
										<div class="stat-panel-title text-uppercase">Upcoming Insurance Renewals</div>
								</div>
							</div>
								<a href="view-vendor-det.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
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
