<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/cconfig.php');

if(strlen($_SESSION['alogin'])==0)
{	
    header('location:index.php');
}
 ?>

<?php 
    $selvid = $_GET['vehnum'];
?>
<?php
	if ($_SERVER['REQUEST_METHOD'] ==='POST'){
		// the request method is fine
	if(isset($_POST["btnveh"])){
		if (!empty($_POST['vsel'])) {
			$selvid = trim($_POST['vsel']);
	}
	}
	}
?>
<?php 
	$serveveh = $_GET['vehnum'];
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
									<div class="col-sm-5">
								<table id="zttg" class="display table table-striped table-bordered table-hover" cellspacing="0" width="50%">
									<thead>
										<tr>
										    <th width="30%">ITEM</th>
											<th>DETAILS</th>
										</tr>
									</thead>
									<tbody>

									<?php $sqlv = "SELECT id, MAKE, MODEL, CATEGORY, COUNTRY, YOM, TYRESIZE, PAINTCOL, INSURANCE, ROADWORTHY, REGNUMBER, CHASSIS, ENGINENUMBER FROM fleetmain WHERE REGNUMBER = '".$serveveh."'";
									$query = $dbh -> prepare($sqlv);
									$query->execute();
									$results=$query->fetchAll(PDO::FETCH_OBJ);
									if($query->rowCount() > 0);
									{
									    $rowdex = $query->rowCount();
									    foreach($results as $result)
										{
                                    ?>	
                                        <tr>
											<td width="30%">REGISTRATION </td>
											<td><strong><?php echo htmlentities($result->REGNUMBER);?></strong></td>
										</tr>
										<tr>
											<td>MAKE</td>
											<td><strong><?php echo htmlentities($result->MAKE);?></strong></td>
										</tr>

										<tr>
											<td>MODEL</td>
											<td><strong><?php echo htmlentities($result->MODEL);?></strong></td>
										</tr>
										<tr>
											<td>CATEGORY</td>
											<td><strong><?php echo htmlentities($result->CATEGORY);?></strong></td>
										</tr>
										<tr>
											<td>ROADWORTHY EXPIRY</td>
											<td><strong><?php echo date("d-m-Y", strtotime($result->ROADWORTHY));?></strong></td>
										</tr>

                                        <tr>
											<td>INSURANCE EXPIRY</td>
											<td><strong><?php echo date("d-m-Y", strtotime($result->INSURANCE));?></strong></td>
										</tr>
										
										<tr>
											<td>YEAR OF MANUF.</td>
											<td><strong><?php echo htmlentities($result->YOM);?></strong></td>
										</tr>
										<tr>
											<td>COUNTRY OF ORIGIN</td>
											<td><strong><?php echo htmlentities($result->COUNTRY);?></strong></td>
										</tr>
										<tr>
											<td>TYRES SIZE</td>
											<td><strong><?php echo htmlentities($result->TYRESIZE);?></strong></td>
										</tr>
                                        <tr>
											<td>PAINT COLOUR</td>
											<td><strong><?php echo htmlentities($result->PAINTCOL);?></strong></td>
										</tr>
                                        <tr>
											<td>CHASSIS NUMBER</td>
											<td><strong><?php echo htmlentities($result->CHASSIS);?></strong></td>
										</tr>
                                        <tr>
											<td>ENGINE NUMBER</td>
											<td><strong><?php echo htmlentities($result->ENGINENUMBER);?></strong></td>
										</tr>										
											<?php
												$i = 1;	
												$stmt = "SELECT id, servicedate, servicevehicle, serviceodo, servicegarage, glocation, servicedriver, serviceuser FROM servicerecords WHERE servicevehicle = '".$serveveh."' order by servicedate ";																								
												$query = $dbh -> query($stmt);																																													
												$query->setFetchMode(PDO::FETCH_ASSOC);																		
												while($row = $query->fetch()): 																								
													$allRows = $query->rowCount();
													if ($allRows == $i) 
													{
														/* Do Something Here*/																									
														//echo $allRows;
														$lastserdate = $row['servicedate'];																				
														$lastserodo = $row['serviceodo'];
													} 
													else 
													{
														"NO RECORD";
													}
													$i++;
												endwhile;
											?>
										<tr>
											<td>LAST SERVICE DATE</td>
											<td><strong><?php echo date("d-m-Y", strtotime($lastserdate));?></strong></td>																							
										</tr>                                       
									   <tr>
											<td>LAST SERVICE KM</td>
											<td><strong><?php echo $lastserodo;?></strong></td>
									   </tr>
									   <tr>
											<td>NEXT SERVICE KM</td>
											<td><strong><?php echo $lastserodo + 5000;?></strong></td>
									   </tr>
									    <?php 
                                        }
                    
                                    }
                                        ?>									
									</tbody>
								</table>
							</div>
								</div>
							</div>
							<div>
							<form>
								<table id="zttc" class="display table table-striped table-bordered table-hover" cellspacing="0" width="50%">
									<tr><td>
										<button id="btclose" type="button" class="btn btn-md btn-danger" onClick="parent.location='view-fleet-det.php'">GO BACK</button>
									</td></tr>
								</table>
							</form>
							</div>
							<div id="actapp" width="50%">

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
</body>
</html>
