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
	if(isset($_POST["savedriver"])){
		
		if (!empty($_POST['txtlastname'])) 
		{
    		$dlastname = trim($_POST['txtlastname']);
            $dlastname = strtoupper($dlastname);
		}		
		if(!empty($_POST['txtfirstname']))
		{
			$dfirstname = trim($_POST['txtfirstname']);
			$dfirstname = strtoupper($dfirstname);
        }
        
        if(!empty($_POST['txtfirstname']) &!empty($_POST['txtlastname']))
		{
			$dfullname = $dfirstname." ".$dlastname;
			
        }

        if(!empty($_POST['txtcat']))
		{
    		$dcat = trim($_POST['txtcat']);
   	 	}
        
        if(!empty($_POST['txtPhoneNum']))
		{
    		$dphonenumber = trim($_POST['txtPhoneNum']);       
    	}  

        $user = "". $_SESSION['alogin'];
			      
        $sql="INSERT INTO drivers(FULLNAME,LASTNAME,FIRSTNAME,CAT,CONTACTNO,USER) 
        VALUES(:fullname,:lastname,:firstname,:cat,:contactno,:user)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fullname',$dfullname,PDO::PARAM_STR);
        $query->bindParam(':lastname',$dlastname,PDO::PARAM_STR);
        $query->bindParam(':firstname',$dfirstname,PDO::PARAM_STR);
        $query->bindParam(':cat',$dcat,PDO::PARAM_STR);
        $query->bindParam(':contactno',$dphonenumber,PDO::PARAM_STR);
        $query->bindParam(':user',$user,PDO::PARAM_STR);
	    $query->execute() or die(print_r($query->errorInfo(), true));
	    $lastInsertId = $dbh->lastInsertId();
        if($lastInsertId)
        {
    	    $msg="New Driver successfully Added";
        }
        else 
        {
    	    $msg=$query->errorInfo();
	    } 
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
					<div class="col-sm-6">

						<h2 class="page-title">Drivers</h2>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">View Drivers <?php $dfullname && $dphonenumber; ?></div>
							<div class="panel-body table-responsive">
							<div class="errorWrap"><strong>MESSAGE</strong>:<?php echo $msg; ?></div>
								<div class="resContainer-style">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										    <th>#</th>
											<th>DRIVER NAME</th>
											<th>CATEGORY</th>
											<th>DESIGNATION</th>
											<th>CONTACT</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										    <th>#</th>
                                            <th>DRIVER NAME</th>
											<th>CATEGORY</th>
											<th>DESIGNATION</th>
											<th>CONTACT</th>
										</tr>
									</tfoot>
									<tbody>

									<?php $sql = "SELECT id, FULLNAME, CAT, DESIG, CONTACTNO from drivers order by FULLNAME";
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
											<td><a href="driverdetail.php?drname=<?php echo($result->id);?>"><?php echo strtoupper($result->FULLNAME);?></a></td>
											<td><?php echo htmlentities($result->CAT);?></td>
											<td><?php echo htmlentities($result->DESIG);?></td>
											<td><?php echo htmlentities($result->CONTACTNO);?></td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>										
									</tbody>
								</table>
								</div>
							</div>
						<div>
							<button type="button" id="btclose"  class="btn btn-md btn-danger" onClick="parent.location='dashboard.php'">GO BACK</button>
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

