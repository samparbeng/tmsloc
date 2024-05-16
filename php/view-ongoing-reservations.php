<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_REQUEST['eid']))
	{
$eid=intval($_GET['eid']);
$status="0";
$sql = "UPDATE reservations SET status=:status WHERE  id=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();

$msg="Testimonial Successfully Inacrive";
}


if(isset($_REQUEST['aeid']))
	{
$aeid=intval($_GET['aeid']);
$status=1;

$sql = "UPDATE reservations SET status=:status WHERE  id=:aeid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
$query -> execute();

$msg="Testimonial Successfully Active";
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
	
	<title>Car Rental Portal |Admin Manage testimonials   </title>

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
							<div class="panel-heading">View On-going Reservations</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>START</th>
											<th>END</th>
											<th>COMPANY</th>
											<th>DAYS</th>
											<th>DESTINATION</th>
											<th>DRIVER</th>
											<th>VEHICLE</th>
											<th>STATUS</th>
											<th>RESID</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th>START</th>
											<th>END</th>
											<th>COMPANY</th>
											<th>DAYS</th>
											<th>DESTINATION</th>
											<th>DRIVER</th>
											<th>VEHICLE</th>
											<th>STATUS</th>
											<th>RESID</th>
										</tr>
									</tfoot>
									<tbody>

									<?php $sql = "SELECT ashase, awie, compname, duration, destination, assignedvehicle, assigneddriver, confirm, mypr from reservations WHERE confirm = 'In Progress' order by ashase";
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
											<td><?php echo date("d-m-Y", strtotime($result->ashase));?></td>
											<td><?php echo date("d-m-Y", strtotime($result->awie));?></td>
											<td><?php echo htmlentities($result->compname);?></td>
											<td><?php echo htmlentities($result->duration);?></td>
											<td><?php echo htmlentities($result->destination);?></td>
											<td><?php echo htmlentities($result->assigneddriver);?></td>
											<td><?php echo htmlentities($result->assignedvehicle);?></td>
											<td><?php echo htmlentities($result->confirm);?></td>
											<td>
											<form id="rid" method="post" action="loadres.php">
											<input id="rid" name="rid" type="hidden" value=<?php echo htmlentities($result->mypr);?>>
												<?php
											$thisresid =  $result->mypr;
												if(!empty($result->confirm))
												{
													$actasc = $result->confirm;
													switch ($actasc)
													{
														case "Pending":
														echo '<button name="btnrid" class="btn btn-sm btn-warning" type="submit" id="btnrid">';
														echo $thisresid;
														echo '</button>';
															break;

														case "In Progress":
														echo '<button name="btnrid" class="btn btn-xs btn-success" type="submit" id="btnrid">';
														echo $thisresid;
														echo '</button>';
														echo '&nbsp';
														echo '&nbsp';
														echo '<button name="btnrid" class="btn btn-xs btn-success" type="button" data-toggle="modal" data-target="#myModal" id="btnrid">';
														echo "APPEND";
														echo '<input type="hidden" value="">';
														echo '</button>';
															break;

														case "Closed":
														echo '<button name="btnrid" class="btn btn-sm btn-primary" type="submit" id="btnrid">';
														echo $thisresid;
														echo '</button>';
															break;
															
														case "Cancelled":
														echo '<button name="btnrid" class="btn btn-sm btn-danger" type="submit" id="btnrid">';
														echo $thisresid;
														echo '</button>';																									 
													}
												}																				
													
											echo '</form>'
											?>
											</td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>										
									</tbody>
								</table>
							</div>
							<div>
								<button id="btclose" type="button" class="btn btn-md btn-danger" onClick="parent.location='dashboard.php'">GO BACK</button>
								<div class="modal fade" id="myModal" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    								<div class="modal-dialog">   
      								<!-- Modal content-->
      									<div class="modal-content">
        									<div class="modal-header">
          										<button type="button" class="close" data-dismiss="modal">&times;</button>
          										<h4 class="modal-title">Modal Header</h4>
        									</div>
        								<div class="modal-body">
         									 <p>Append Details to RESID <?php echo $result->mypr?></p>

        								</div>
        								<div class="modal-footer">
         	 								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        								</div>
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
	
	<script type="text/javascript">
	<!--
		function doubleSubmit(f)
		{
		//submit to action in form
		f.submit();
		//set second action abd submit
		f.target="_blank";
		f.action="loadres.php";
		f.submit();
		return false;
		}
		//-->
	</script>
</body>
</html>
<?php } ?>