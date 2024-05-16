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
        if (!empty($_POST['txtVehCat'])){
            $vehcat = trim($_POST['txtVehCat']);
		}
		if(!empty($_POST['stadate'])){
			$stadate = ($_POST['stadate']);
		}

		if(!empty($_POST['enddate'])){
			$enddate = ($_POST['enddate']);
		}

        if (!empty($_POST['txtDur'])) {
	
            $duration = $_POST['txtDur'];
            $duration = filter_var($duration, FILTER_VALIDATE_INT);
        
            if ($duration === false) {
                exit('Invalid Number of Days');
            }

		}

		if (!empty($_POST['txtRemarks'])){
            $remarks = trim($_POST['txtRemarks']);
		}
		
        if (!empty($_POST['txtDestination'])){
            $destination = trim($_POST['txtDestination']);
            $rstatus = 'Pending';
        }
           
else {
    exit('Invalid Request');
}			
			

			$sql="INSERT INTO reservations(COMPNAME,CONTACTPER,PHONENUM,VTYPE,DURATION,ASHASE,AWIE,REMARKS,DESTINATION,CONFIRM,RESID) VALUES
            ('$compname','$contper','$phonenum','$vehcat','$duration','$stadate','$enddate','$remarks','$destination','$rstatus','$resid')";          
           
            if(mysqli_query($conn, $sql)){
			$msg = "New Reservation Successfully Logged.";
			}
			
            if(mysqli_error($conn)===TRUE ){
            $operror = "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
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
                    <form name="resEntry" class="form-style-9" method="post" action="procreservation.php" enctype="multipart/form-data"">
						<ul>
                          <li>
								<label class="label-style label-split align-left">Company Name</label>
								<input style="text-transform: uppercase;" type="text" name="txtCompName" class="field-style field-split align-right" placeholder="Company Name" required="true" />
                          </li>
                          <li>
						  		<label class="label-style label-split align-left">Contact Person</label>
						  		<input style="text-transform: uppercase;" type="text" name="txtContPer" class="field-style field-split align-right" placeholder="Contact Person" required="true"/>
						  </li>
						  <li>
						  		<label class="label-style label-split align-left">Phone Number</label>
						  		<input type="text" name="txtPhoneNum" class="field-style field-split align-right" placeholder="Phone Number" required="true"/>
						  </li>
						</ul>
						<ul>
							<li>
								<label class="label-style label-split align-left">Vehicle Category</label>
								<select type="text" class="field-style align-right" name="txtVehCat" width="208" placeholder="Select Vehicle Category">
                                    <option>RG SAL</option>
                                    <option>EX SAL</option>
                                    <option>PR 4X4</option>
                                    <option>V8 4X4</option>
                                    <option>VX 4X4</option>
                                    <option>15 STR</option>
                                    <option>30 STR</option>
                                    <option>45 STR</option>
                                    </select>
						  	</li>
						  <li>
						  		<label class="label-style label-split align-left">Start Date</label>
                                <input id="stadate" name="stadate" type="date" class="field-style field-split align-right" placeholder="Enter start date" required="true"/>   
						  </li>
						  <li>
						  		<label class="label-style label-split align-left">End Date</label>
                                <input id="enddate"  name="enddate" type="date" class="field-style field-split align-right" placeholder="Enter end date." required="true"/>
						  </li>
						  		
						  <li>
						  		<label class="label-style label-split align-left">Duration</label>
						  		<input id="txtDur" type="number" name="txtDur" class="field-style field-split align-right" required="true" />
                          </li>
                          <li>
						  		<label class="label-style label-split align-left">Destination</label>
                              	<input style="text-transform: uppercase;" type="text" name="txtDestination" class="field-style field-split align-right" placeholder="Destination" required="true"/>
                          </li>
                        </ul>
						<ul>
						  <li>
						  		<label class="label-style label-split align-left">Remarks</label>
                              <textarea style="text-transform: uppercase;" name="txtRemarks" class="field-style field-split align-right" placeholder="Remarks" rows="6" cols="40"></textarea>
                          </li>
						</ul>
						<ul>
                          <li>
						  		<input type="reset" value="Reset" />
                          </li>
						  <li>
						  		<input type="submit" value="Enter Reservation" />
						  </li>
                        </ul>
					</form>
				</td>
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
