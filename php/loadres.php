<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/cconfig.php');

if(strlen($_SESSION['alogin'])==0){	
header('location:index.php');
}
$user = "". $_SESSION['alogin'];
?>

<?PHP
if ($_SERVER['REQUEST_METHOD'] ==='POST'){
	// the request method is fine
	if(isset($_POST["btnrid"])){
		if (!empty($_POST['rid'])) {
			$settingbid = trim($_POST['rid']);
		}
	}
}
?>


<?php
if ($_SERVER['REQUEST_METHOD'] ==='POST')
{
	if(!empty($_POST['settingbid'])) 
	{
		$settingbid = trim($_POST['settingbid']); 
		if (isset($_POST["reschoice"]))
		{
			$reschoice = trim($_POST['source']);
			$resourcechoice = trim($_POST['source']);
			mysqli_query($conn, "UPDATE reservations SET reresource='$reschoice'
			WHERE mypr=$settingbid");
			echo "Record updated successfully";
			$msg="Details succefully set for this reservation";
		}
		
		if (isset($_POST["btsetdriver"]))
		{
			if(!empty($_POST['drsel'])) 
			{
				$assigneddriver = trim($_POST['drsel']);
		
				mysqli_query($conn, "UPDATE reservations SET assigneddriver='$assigneddriver'
				WHERE mypr=$settingbid");
				echo "Record updated successfully";
				$msg="Details succefully set for this reservation";
			}
		} 
		elseif ($_POST["btresetdriver"])
		{
			$assigneddriver = "";

			mysqli_query($conn, "UPDATE reservations SET assigneddriver='$assigneddriver'
			WHERE mypr=$settingbid");

		}
	
		if (isset($_POST["btsetvehicle"]))
		{
			if(!empty($_POST['vehsel'])) 
			{
				$assignedvehicle = trim($_POST['vehsel']);

				mysqli_query($conn, "UPDATE reservations SET assignedvehicle='$assignedvehicle'
				WHERE mypr=$settingbid");
				echo "Record updated successfully";
				$msg="Details succefully set for this reservation";
			}
		}
		elseif ($_POST["btresetvehicle"])
		{
			$assignedvehicle = "";

			mysqli_query($conn, "UPDATE reservations SET assignedvehicle='$assignedvehicle'
			WHERE mypr=$settingbid");
		}
	
	

		if (isset($_POST["btsettripcode"]))
		{
			if(!empty($_POST['tpsel'])) 
			{
				$tripcode = trim($_POST['tpsel']);
			
				mysqli_query($conn, "UPDATE reservations SET tripcode='$tripcode'
				WHERE mypr=$settingbid");
				echo "Record updated successfully";
				$msg="Details succefully set for this reservation";
			}
		}
		elseif ($_POST["btresettripcode"])
		{
			$tripcode = "";

			mysqli_query($conn, "UPDATE reservations SET tripcode='$tripcode'
			WHERE mypr=$settingbid");
		}

}
else{
	echo "NO ID";
}

}
 ?>




<?php

if(!empty($_POST['settingbid'])) 
{
	$settingbid = trim($_POST['settingbid']);
 	if (isset($_POST["btcommenceres"]))
 	{
		$persact = "In Progress";
		mysqli_query($conn, "UPDATE reservations SET confirm='$persact' WHERE mypr=$settingbid");
		echo "Record updated successfully";
		$msg="Reservation successfully started";
	}
	elseif ($_POST["btcloseres"])
	{
		$persact = "Closed";
		mysqli_query($conn, "UPDATE reservations SET confirm='$persact' WHERE mypr=$settingbid");
		echo "Record updated successfully";
		$msg="Reservation successfully closed";
	}
	elseif ($_POST["btcancelres"])
	{
		$persact = "Cancelled";
		mysqli_query($conn, "UPDATE reservations SET confirm='$persact' WHERE mypr=$settingbid");
		echo "Reservation successfully cancelled";
		$msg="Reservation successfully cancelled";
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
	
	<script>
	$(document).ready(function(){
    $('#show').click(function() {
      $('.menu').toggle("slide");
    });
	});
	</script>

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
						<h2 class="page-title">Reservations</h2>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">View Reservations</div>
							<div class="panel-body">
							<div class="row">
							<div class="col-md-6">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
								else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zttw" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										    <th width="25%">ITEM</th>
											<th width="45%">DETAILS</th>
										</tr>
									</thead>
									<tbody>
									<?php $sql = "SELECT sydate, ashase, awie, compname, contactper, phonenum, destination, assignedvehicle, assigneddriver, tripcode, vtype, remarks, user, 
									duration, confirm, mypr, reresource from reservations where mypr = $settingbid ";
									$query = $dbh -> prepare($sql);
									$query->execute();
									$results=$query->fetchAll(PDO::FETCH_OBJ);
									$cnt=1;
									if($query->rowCount() > 0)
									{
									foreach($results as $result)
										{?>	
                                        <tr>
											<td>DATE RESERVED</td>
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
											<td>REMARKS</td>
											<td><strong><?php echo htmlentities($result->remarks);?></strong></td>
										</tr>
										<tr>
											<td>SOURCE</td>
											<td><strong><?php echo htmlentities($result->reresource);?></strong></td>
										</tr>
										<tr>
											<td>USER ID</td>
											<td><strong><?php echo htmlentities($result->user);?></strong></td>
										</tr>
										</tbody>
								</table>
							</div>
							</div>
							<div class="row">
							<div class="col-md-6">
								<table id="zttc" class="display table table-borderless" cellspacing="0" width="100%">		
										<form id="setthis" name="setthis" method="post" action="">
										<input type="hidden" id="settingbid" name="settingbid" value=<?php echo htmlentities($result->mypr);?>>
										<tr>										
											<td width="25%">STATUS</td>
											<td width="35%"><strong><?php echo htmlentities($result->confirm);?></strong></td>
											<td width ="15%">
												<?php
													if(!empty($result->assigneddriver)&&!empty($result->assigneddriver)&&!empty($result->tripcode))
													{
														if(!empty($result->confirm))
														{
															$actas = $result->confirm;
															switch ($actas)
															{
																case "Pending":
																echo '<input id="btcommenceres" name="btcommenceres" type="submit" class="btn btn-block btn-success" value="COMMENCE"/>';																
																	break;
																case "In Progress":
																echo '<input id="btcloseres" name="btcloseres" type="submit" class="btn btn-block btn-danger" value="CLOSE"/>';
																	break;
																case "Closed":
																echo ("This reservation is closed");
																	break;
																case "Cancelled":
																echo ("This reservation is cancelled");	
															}
														}	
														else 
														{
															
														}														
													}
													else
													{
														if(!empty($result->confirm))
														{
															$actas = $result->confirm;
															switch ($actas)
															{
															case "Pending":															
															echo '<input id="btcancelres" name="btcancelres" type="submit" class="btn btn-block btn-danger" value="CANCEL"/>'; 														
																break;
															case "Cancelled":
															echo ("This reservation is cancelled");
															}
														}	
													}																
											echo '</td>';
											// LAST CELL
											echo '<td width="15%">';
											if(!empty($result->assigneddriver)&&!empty($result->assigneddriver)&&!empty($result->tripcode))
											{
												if(!empty($result->confirm))
												{
													$actas = $result->confirm;
													switch ($actas)
													{
														case "Pending":															
														echo '<input id="btcancelres" name="btcancelres" type="submit" class="btn btn-block btn-danger" value="CANCEL"/>'; 																																							
													}
												}
											}
											
																								
											echo '</td>';	
											echo '</tr>';
										
										echo '<tr>';
											echo '<td>';
												echo "SOURCE";
											echo '</td>';
											echo '<td>';											
													echo '<input type="radio" name="source" value="IH" checked="checked">IN-HOUSE<br />';
													echo '<input type="radio" name="source" value="TP">THIRD-PARTY';
												
											echo '</td>';
											echo '<td>';
													echo '<input type="submit" name="reschoice" id="reschoice" class="btn btn-block btn-success" value="IH/TP">';
											echo '</td>';
										echo '</tr>';
										echo '<tr>';											
											echo '<td>ASSIGNED DRIVER</td>'; 
											echo '<td>';											
												
												if(!empty($result->assigneddriver))
												{
													echo htmlentities($result->assigneddriver);
													$sldr = $result->assigneddriver;
													$resourcechoice = $result->reresource;																									
												}
												else
												{
													if ($resourcechoice != "IH") 
														{
															echo '<input type="text" name="drsel" id="drsel class="field-style align-right" placeholder="THIRD PARTY DRIVER NAME">';														
														}
														else
														{
															echo '<select type="text" class="field-style align-right" name="drsel">';
															$sqldr = "SELECT id, fullname from drivers where INSERV ='1' order by fullname ";
															$query = $dbh->prepare($sqldr);
															$query->execute();
															$results = $query->fetchAll(PDO::FETCH_ASSOC);
															echo strtoupper('<option value="" disabled selected>SELECT DRIVER</option>');
															foreach ($results as $row) 
															{
															echo '<strong>';
																echo strtoupper('<option>'.$row['fullname'].'</option>');
															echo '</strong>';
															}
															echo '</select>';
														}
												}
											echo '</td>';
											
											echo '<td>';
												//BUTTONS	
													if(!empty($result->confirm))
													{
														$actasdr = $result->confirm;
														if($actasdr !="Closed" && $actasdr !="Cancelled")
														{
															if(!empty($result->assigneddriver))
															{
																echo '<input id="btresetdriver" name="btresetdriver" type="submit" class="btn btn-block btn-danger" value="RESET DRIVER">';
															}
															else
															{	
																echo '<input id="btsetdriver" name="btsetdriver" type="submit" class="btn btn-block btn-success" value="SET DRIVER">';
															}
														}
														else
														{
															echo "";
														}
													}																										
											echo '</td>';										
										echo '</tr>';										
										
										echo '<tr>';
											echo '<td>ASSIGNED VEHICLE</td>';
											echo '<td>';										
												if(!empty($result->assignedvehicle))
												{
													 echo htmlentities($result->assignedvehicle);
												}
												else
												{	
													if ($resourcechoice != "IH")
													{
														echo '<input type="text" name="vehsel" id="vehsel class="field-style align-right" placeholder="THIRD PARTY VEHICLE">';
													}
													else
														{
												 		echo '<select type="text" class="field-style align-right" name="vehsel">';
														$sqlveh = "SELECT idid, regnumber from vehicle order by regnumber ";
			    										$query = $dbh -> prepare($sqlveh);
			    										$query->execute();
			    										$results = $query->fetchAll(PDO::FETCH_ASSOC);
														echo strtoupper('<option value="" disabled selected>SELECT VEHICLE</option>');
														foreach ($results as $row) 
														{
															echo '<strong>';
																echo strtoupper('<option>'.$row['regnumber'].'</option>');
															echo '</strong>';
														}
													echo '</select>';
													}
												}
											echo '</td>';
											
											echo '<td>';											
													//Buttons
												if(!empty($result->confirm))
												{
													$actasveh = $result->confirm;
													if($actasveh !="Closed" && $actasveh !="Cancelled")
													{
														if(!empty($result->assignedvehicle))													
														{
												 			echo '<input id="btresetvehicle" name="btresetvehicle" type="submit" class="btn btn-block btn-danger" value="RESET VEHICLE">';
														}
														else
														{	
															echo '<input id="btsetvehicle" name="btsetvehicle" type="submit" class="btn btn-block btn-success" value="SET VEHICLE">';
														}
													}
													else
													{
														echo "";	
													}
												}										
											echo '</td>';
									
										echo '</tr>';
									
										echo '<tr>';
											echo '<td>TRIP CODE</td>';
											echo '<td>';
												if(!empty($result->tripcode))
												{
											 		echo htmlentities($result->tripcode);
												}
												else
												{	
													echo '<select type="text" class="field-style align-right" name="tpsel">';
														$sqltp = "SELECT id, ratecode FROM vehiclerate ORDER BY id ";
														$query = $dbh -> prepare($sqltp);
														$query->execute();
														$results = $query->fetchAll(PDO::FETCH_ASSOC);
														echo strtoupper('<option value="" disabled selected>SELECT TRIPCODE</option>');
														foreach ($results as $row) 
														{
															echo '<strong>';	
																echo strtoupper('<option>'.$row['ratecode'].'</option>');
															echo '</strong>';
														}
													echo '</select>';
												}																						
											echo '</td>';

											echo '<td>';
													//BUTTONS
												if(!empty($result->confirm))
												{
													$actastri = $result->confirm;
													if($actastri !="Closed" && $actastri !="Cancelled")
													{
														if(!empty($result->tripcode))
														{
												 			echo '<input id="btresettripcode" name="btresettripcode" type="submit" class="btn btn-block btn-danger" value="RESET TRIPCODE"/>';
														}
														else
														{	
															echo '<input id="btsettripcode" name="btsettripcode" type="submit" class="btn btn-block btn-success" value="SET TRIPCODE"/>';
														}
													}
													else
													{
														echo "";
													}
												}
											
											echo '</td>';
										echo '</tr>';
										
										echo '<tr>';
											echo '<td>DRIVER CONTACT</td>';
											echo '<td>';
													$sqldcon = "SELECT fullname, contactno FROM drivers WHERE fullname='".$sldr."'";
													$query = $dbh -> prepare($sqldcon);
													$query->execute();
													$results=$query->fetchAll(PDO::FETCH_OBJ);													
													if($query->rowCount() > 0)
													{
														foreach($results as $result)
														{
															echo htmlentities($result->contactno);
														}
													}else
													{
														echo $query->rowCount();
													}
											echo '</td>';		
										echo '</tr>';
										
										 $cnt=$cnt+1; }}
										?>
									</form>								
									</table>';				
										
						</div>
						</div>
						</div>
							
						<div class="row">
							<div class="col-md-6">
								<form>										
									<button id="btclose" name="btclose" type="button" class="btn btn-md btn-danger" onClick="parent.location='view-pending-reservations.php'">GO BACK</button>
									<button id="btresmod" name="btresmod" type="button" class="btn btn-md btn-danger" onClick="parent.location='modreservation.php?modid=<?php echo $settingbid ?>'">MODIFY</button>												
									<button id="btresdup" name="btresdup" type="button" class="btn btn-md btn-success" onClick="parent.location='duplicatereservation.php?dupid=<?php echo $settingbid ?>'">COPY</button>
									<button id="btprint" name="btprint" type="button" class="btn btn-md btn-primary" onclick="window.print()">PRINT THIS</button>
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
									
