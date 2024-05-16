<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/cconfig.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	?>

<?php
	//Load Session Details from Database
	$siuser = "". $_SESSION['alogin'];
	$sqlUD = "SELECT * FROM administrator WHERE UserName = '".$siuser."'";
	$query = $dbh->query($sqlUD);
	$query->setFetchMode(PDO::FETCH_ASSOC);
	while ($rowud = $query->fetch()):												
		$_SESSION['userfullname'] = $rowud['UserFullName'];
		$_SESSION['userdesignation'] = $rowud['UserDesignation'];
		$_SESSION['uaddress'] = $rowud['Address'];
	endwhile;
?>

<?php
	//Exchange rate
	if ($_SERVER['REQUEST_METHOD'] ==='POST')
	{
		// the request method is fine
		if(isset($_POST["btexrate"]))
		{		
			if(!empty($_POST['txtrate']))
			{
				$sysexrate = $_POST['txtrate'];
				$sysexrate = floatval($sysexrate);
				$dollartocedi = filter_var($sysexrate, FILTER_VALIDATE_FLOAT);
					if($dollartocedi === false) 
					{
        				exit('Invalid Rate');
        			}
				$curdate = new datetime();
				$ratedate = $curdate->format('Y-m-d');	
				$user = $_SESSION['alogin'];
				
			}
		}
		$sql="INSERT INTO  exchangerate(dollartocedi,ratedate,user) 
		VALUES(:dollartocedi,:ratedate,:user)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':dollartocedi',$dollartocedi,PDO::PARAM_STR);
		$query->bindParam(':ratedate',$ratedate,PDO::PARAM_STR);
		$query->bindParam(':user',$user,PDO::PARAM_STR);
		$query->execute() or die(print_r($query->errorInfo(), true));
		$lastInsertId = $dbh->lastInsertId();
		if($lastInsertId)
		{
			$msg="New Exchange Rate Set";
		}
		else 
		{
			$msg=$query->errorInfo();
		} 	
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
	<title>TransPro Suite | Admin Dashboard</title>
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
					<div class="row">					
							<h2 class="page-title">Dashboard</h2>																																																																																																																	
							<div id="users" class="col-xs-12">
								<div class="panel panel-default">
									<div class="panel-body" style="background-color:powderblue;">																																	
										<table class="table">
											<tr>
												<td style="width:120px">USER:</td>
												<td>													
													<strong><?php echo $_SESSION['userfullname'];?></strong>
												</td>
											</tr>
											<tr>
												<td style="width:100px">DESIGNATION:</td>
												<td>													
													<strong><?php echo $_SESSION['userdesignation'];?></strong>
												</td>
											</tr>
											<tr>
												<td>DATE:</td>
												<td><strong>	
													<?php
														$currentdate = new datetime();
														$currentdate = $currentdate->format('d-m-Y');
														echo $currentdate;	
													?></strong>
												</td>
											</tr>
										</table>
																	
									</div>
									<!--<a href="reg-users.php" class="block-anchor panel-footer"><i class="fa fa-arrow-right"></i></a>-->
								</div>
							</div>											
							<div id="users" class="col-md-3">
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
							<div id="vehicles" class="col-md-3">
								<div class="panel panel-default">
									<div class="panel-body bk-success text-light">
										<div class="stat-panel text-center">
											<?php 
												$sql1 ="SELECT REGNUMBER from fleetmain ";
												$query1 = $dbh -> prepare($sql1);
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
							<div id="drivers" class="col-md-3">
								<div class="panel panel-default">
									<div class="panel-body bk-info text-light">
										<div class="stat-panel text-center">
											<?php 
												$sql2 ="SELECT FULLNAME from drivers where INSERV = '1' ";
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
							<div id="pendingres" class="col-md-3">
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
							<div id="allres" class="col-md-3">
								<div class="panel panel-default">
									<div class="panel-body bk-primary text-light">
										<div class="stat-panel text-center">
											<?php 
												$sql ="SELECT mypr from reservations ";
												$query = $dbh -> prepare($sql);
												$query->execute();
												$results=$query->fetchAll(PDO::FETCH_OBJ);
												$regusers=$query->rowCount();
											?>
											<div class="stat-panel-number h1 "><?php echo htmlentities($regusers);?></div>
											<div class="stat-panel-title text-uppercase">All Reservations</div>
										</div>
									</div>
										<a href="view-reservations.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
								</div>
							</div>								
							<div id="vendors" class="col-md-3">
								<div class="panel panel-default">
									<div class="panel-body bk-success text-light">
										<div class="stat-panel text-center">
											<?php 
												$sql1 ="SELECT VENDORNAME from vendor ";
												$query1 = $dbh -> prepare($sql1);
												$query1->execute();
												$results1=$query1->fetchAll(PDO::FETCH_OBJ);
												$totalvendors=$query1->rowCount();
											?>
											<div class="stat-panel-number h1 "><?php echo htmlentities($totalvendors);?></div>
											<div class="stat-panel-title text-uppercase">Listed Vendors</div>
										</div>
									</div>
										<a href="view-vendor-det.php" class="block-anchor panel-footer text-center">Full Detail &nbsp;<i class="fa fa-arrow-right"></i></a>
								</div>
							</div>
							<div id="roadworthy" class="col-md-3">
								<div class="panel panel-default">
									<div class="panel-body bk-info text-light">
										<div class="stat-panel text-center">
											<?php
												$dttoday = new datetime();
												$today = $dttoday->format('Y-m-d');
												$endofyear = date('Y-12-31');
												
												$sql1="SELECT * FROM fleetmain WHERE ROADWORTHY BETWEEN '".$today."' AND '".$endofyear."' ";
												$query1 = $dbh -> prepare($sql1);
												$query1->execute() or die(print_r($query1->errorInfo(), true));	
												$results1=$query1->fetchAll(PDO::FETCH_OBJ);
												$exratecount=$query1->rowCount();
											?>
											<div class="stat-panel-number h1 "><?php echo htmlentities($exratecount);?></div>								
											<div class="stat-panel-title text-uppercase">Roadworthy Renewals </div>
										</div>
									</div>
										<a href="view-rwvehicles.php" class="block-anchor panel-footer text-center">Full Detail &nbsp;<i class="fa fa-arrow-right"></i></a>
								</div>
							</div>
							<div id="insurance" class="col-md-3">
								<div class="panel panel-default">
									<div class="panel-body bk-warning text-light">
										<div class="stat-panel text-center">
											<?php
												$dttoday = new datetime();
												$today = $dttoday->format('Y-m-d');
												$endofyear = date('Y-12-31');

												$sql1="SELECT * FROM fleetmain WHERE INSURANCE BETWEEN '".$today."' AND '".$endofyear."' ";
												$query1 = $dbh -> prepare($sql1);
												$query1->execute() or die(print_r($query1->errorInfo(), true));	
												$results1=$query1->fetchAll(PDO::FETCH_OBJ);
												$exratecount=$query1->rowCount();
											?>
											<div class="stat-panel-number h1 "><?php echo htmlentities($exratecount);?></div>								
											<div class="stat-panel-title text-uppercase">Insurance Renewals </div>
										</div>
									</div>
										<a href="view-pivehicles.php" class="block-anchor panel-footer text-center">Full Detail &nbsp;<i class="fa fa-arrow-right"></i></a>
								</div>
							</div>

							<div id="vendors" class="col-md-3">
								<div class="panel panel-default">
									
											<?php
												$dttoday = new datetime();
												$today = $dttoday->format('Y-m-d');																			
												$sqlexrate="SELECT * FROM exchangerate WHERE ratedate = '".$today."' ";
												$query = $dbh -> query($sqlexrate);
												$query->setFetchMode(PDO::FETCH_ASSOC);																								
													$recd = $query->rowCount();
													if($recd > 0)
													{
													echo '<div class="panel-body bk-primary text-light">';
														echo '<div class="stat-panel text-center">';
														while ($r = $query->fetch()):
															$exchangerate = $r['dollartocedi'];														
															$exchangerateval = $exchangerate;																									
														endwhile;																								
														echo '<div class="stat-panel-number h1 ">';
														echo $exchangerateval;
														echo '</div>';								
														echo '<div class="stat-panel-title text-uppercase">';
														echo "Today's Dollar Ex. Rate"; 
														echo '</div>';
													}
													else
													{
														echo '<div class="panel-body bk-warning">';
														echo '<div class="stat-panel text-center">';
														echo '<div class="col-sm-3">';
															echo '<form method="post" action="">';
															echo '<input type="text" name="txtrate" style="text-color:powderblue;">';
															echo '<input type="submit" name="btexrate" class="btn btn-sm btn-success">';
															echo '</form>';
														echo '</div>';
													}
											?>
										</div>
									</div>
										<a href="#" class="block-anchor panel-footer text-center">Reset<?php echo $recd;?> &nbsp;<i class="fa fa-arrow-right"></i></a>
								</div>
							</div>																																																																																																					
					</div>
				</div>					
			</div>
	</div>										
<?php } ?>	
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
