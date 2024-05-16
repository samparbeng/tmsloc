<?php
global $dbh;
session_start();
error_reporting();
include('includes/config.php');
include('includes/cconfig.php');
if(strlen($_SESSION['alogin'])==0){	
    header('location:index.php');
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] ==='POST'){
		// the request method is fine
	if(isset($_POST["entvendor"])){		
		if (!empty($_POST['vendorcat'])){
    		$vendorcat = trim($_POST['vendorcat']);
			$vendorcat = strtoupper($vendorcat);
		}		
		if(!empty($_POST['txtVendorName'])){
			$vendorname = trim($_POST['txtVendorName']);
			$vendorname = strtoupper($vendorname);
    	}
		if(!empty($_POST['txtContactPerson'])){
    		$conPerson = trim($_POST['txtContactPerson']);
            $conPerson = strtoupper($conPerson);  
    	}

		if(!empty($_POST['txtVendorAddress'])){
    		$vendoraddress = trim($_POST['txtVendorAddress']);
            $vendoraddress = strtoupper($vendoraddress);
   	 	}

        if(!empty($_POST['txtTellNum'])){
            $tellnum = trim($_POST['txtTellNum']);
            $tellnum = strtoupper($tellnum);
         }
    
        if (!empty($_POST['PayType'])){
    		$paytype = trim($_POST['PayType']);
			$paytype = strtoupper($paytype);
		}

        if (!empty($_POST['CreditTerm'])){
    		$creditterm = trim($_POST['CreditTerm']);
			$creditterm = strtoupper($creditterm);
		}
        
            
    $sql="INSERT INTO  vendor(VendorCat, VendorName, ContactPerson, VendorAddress, TellNum, PayType, CreditTerm) 
    VALUES(:vendorcat,:vendorname,:conperson,:vendoraddress,:tellnum,:paytype, :creditterm)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':vendorcat',$vendorcat,PDO::PARAM_STR);
    $query->bindParam(':vendorname',$vendorname,PDO::PARAM_STR);
    $query->bindParam(':conperson',$conperson,PDO::PARAM_STR);
    $query->bindParam(':vendoraddress',$vendoraddress,PDO::PARAM_STR);
    $query->bindParam(':tellnum',$tellnum,PDO::PARAM_STR);
    $query->bindParam(':paytype',$paytype,PDO::PARAM_STR);
    $query->bindParam(':creditterm',$creditterm,PDO::PARAM_STR);
	$query->execute() or die(print_r($query->errorInfo(), true));
	$lastInsertId = $dbh->lastInsertId();
    	if($lastInsertId){
    		$msg="New Vendor successfully registered";
    	}
    	else
		{
    		$error=$query->errorInfo();
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
	
	<title>Car Rental Portal |Admin Manage Vehicles   </title>

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
						<h2 class="page-title">Vendors</h2>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Vedor Information</div>
							<div class="panel-body">

							
                            <form>
                                <table id="zctv" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>                                        
											<th>VENDOR NAME</th>
											<th>VENDOR CATEGORY</th>
											<th>CONTACT PERSON </th>
											<th>ADDRESS / LOCATION</th>
											<th>PHONE NUMBER</th>
                                            <th>ACTION</th>
										</tr>
									</thead>
									<tfoot>
									    <tr>
										    <th>#</th>
											<th>VENDOR NAME</th>
											<th>VENDOR CATEGORY</th>
											<th>CONTACT PERSON </th>
											<th>ADDRESS / LOCATION</th>
											<th>PHONE NUMBER</th>
											<th>ACTION</th>
										</tr>
									</tfoot>
									<tbody>
										<?php 
											$sqlven = "SELECT Vendorid, VendorName, VendorCat, ContactPerson, VendorAddress, TellNum FROM vendor ORDER BY Vendorname";
											$query = $dbh -> prepare($sqlven);
											$query->execute();
											$results=$query->fetchAll(PDO::FETCH_OBJ);
											$cnt=1;
											if($query->rowCount() > 0){
													foreach($results as $result)
												{?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><a href="ven-po-rec.php?venname=<?php echo trim($result->Vendorid);?>"><?php echo htmlentities($result->VendorName);?></a></td>
											<td><?php echo htmlentities($result->VendorCat);?></td>
											<td><?php echo htmlentities($result->ContactPerson);?></td>
                                            <td><?php echo htmlentities($result->VendorAddress);?></td>
                                            <td><?php echo htmlentities($result->TellNum);?></td>
                                            <td></td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>				
									</tbody>
								</table>
                            </form>
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
