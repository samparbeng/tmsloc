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
if ($_SERVER['REQUEST_METHOD'] ==='POST'){
		// the request method is fine
	if (!empty($_POST['txtCompName'])) {
    $compname = trim($_POST['txtCompName']);
    }

    if(!empty($_POST['txtContPer'])){
    $contper = trim($_POST['txtContPer']);
    }

    if(!empty($_POST['txtPhoneNum'])) {
    $phonenum = trim($_POST['txtPhoneNum']);       
    }

    if(!empty($_POST['txtVehCat'])){
    $vehcat = trim($_POST['txtVehCat']);
    }
    
	if(!empty($_POST['stadate'])){
	$stadate = ($_POST['stadate']);
    }
    
	if(!empty($_POST['enddate'])){
	$enddate = ($_POST['enddate']);
    }
    
    if(!empty($_POST['txtDur'])){
	$duration = $_POST['txtDur'];
    $duration = filter_var($duration, FILTER_VALIDATE_INT);
        if($duration === false) {
        exit('Invalid Number of Days');
        }
    }

    if (!empty($_POST['txtRemarks'])){
    $remarks = trim($_POST['txtRemarks']);
    }
    
	if (!empty($_POST['txtDestination'])){
    $destination = trim($_POST['txtDestination']);
    $rstatus = 'Pending';
    $resid = 'RS000000';
    $user = "". $_SESSION['alogin'];
    }		
            
    $sql="INSERT INTO  reservations(COMPNAME,CONTACTPER,PHONENUM,VTYPE,DURATION,ASHASE,AWIE,REMARKS,DESTINATION,CONFIRM,USER) 
    VALUES(:compname,:contper,:phonenum,:vehcat,:duration,:stadate,:enddate,:remarks,:destination,:rstatus,:user)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':compname',$compname,PDO::PARAM_STR);
    $query->bindParam(':contper',$contper,PDO::PARAM_STR);
    $query->bindParam(':phonenum',$phonenum,PDO::PARAM_STR);
    $query->bindParam(':vehcat',$vehcat,PDO::PARAM_STR);
    $query->bindParam(':duration',$duration,PDO::PARAM_STR);
    $query->bindParam(':stadate',$stadate,PDO::PARAM_STR);
    $query->bindParam(':enddate',$enddate,PDO::PARAM_STR);
    $query->bindParam(':remarks',$remarks,PDO::PARAM_STR);
    $query->bindParam(':destination',$destination,PDO::PARAM_STR);
    $query->bindParam(':rstatus',$rstatus,PDO::PARAM_STR);
    $query->bindParam(':user',$user,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    
    if($lastInsertId)
    {
    $msg="New Reservation successfully logged";
    }
    else 
    {
    $error="Something went wrong. Please try again";
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
							<div class="panel-heading">Enter Reservations</div>
							<div class="panel-body">
				            <div class="resContainer-style">	
				            <td>
							<div class="resViewer" height=resEntry.height>
							<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>START</th>
											<th>END</th>
											<th>COMPANY</th>
											<th>DAYS</th>
											<th>STATUS</th>
											<th>RES ID</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
											<th>START</th>
											<th>END</th>
											<th>COMPANY</th>
											<th>DAYS</th>
											<th>STATUS</th>
											<th>RES ID</th>
										</tr>
									</tfoot>
									<tbody>

									<?php $sql = "SELECT ashase, awie, compname, duration, confirm, resid from reservations where confirm='Pending' ";
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
											<td><?php echo date($result->ashase);?></td>
											<td><?php echo date($result->awie);?></td>
											<td><?php echo htmlentities($result->compname);?></td>
											<td><?php echo htmlentities($result->duration);?></td>
											<td><?php echo htmlentities($result->confirm);?></td>
											<td><?php echo htmlentities($result->resid);?></td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>										
									</tbody>
								</table>
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

