<?php
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
    if(isset($_POST["saveporec"])){
		if(!empty($_POST['orderdate'])){
			$orderdate = $_POST['orderdate'];
			$orderdate = date('Y-m-d',(strtotime($orderdate)));
		}
		if(!empty($_POST['ordervendorname'])){
    		$ordervendorname = trim($_POST['ordervendorname']);
		}
		if(!empty($_POST['vin'])){
			$vin = trim($_POST['vin']);
		}
		if(!empty($_POST['orderunit'])){
			$orderunit = trim($_POST['orderunit']);
		}

		if(!empty($_POST['orderquantity'])){
    		$orderquantity = trim($_POST['orderquantity']);       
    	}

		if(!empty($_POST['orderdetails'])){
    		$orderdetails = trim($_POST['orderdetails']);
   	 	}
    
		if(!empty($_POST['orderunitpx'])){
			$orderunitpx = ($_POST['orderunitpx']);
    	}
        
        if(!empty($_POST['ordertotalpx'])){
			$ordertotalpx = ($_POST['ordertotalpx']);
			$pouser = "". $_SESSION['alogin'];
			$ufullname = $_SESSION['userfullname'];
			$uaddress = $_SESSION['uaddress'];
			$sydate = date('Y-m-d');
			$postatus = "Pending";
    	}

    $sqlporec="INSERT INTO po(SystemDate, PODate, VendorName, VIN, POQty, PODescription, POUnit, POUP, POTotal, POUser, POStatus)
    VALUES(:sydate,:orderdate,:ordervendorname,:vin,:orderquantity,:orderdetails,:orderunit,:orderunitpx,:ordertotalpx,:ufullname,:postatus)";
	$query = $dbh->prepare($sqlporec);
	$query->bindParam(':sydate',$sydate,PDO::PARAM_STR);
	$query->bindParam(':orderdate',$orderdate,PDO::PARAM_STR);
	$query->bindParam(':ordervendorname',$ordervendorname,PDO::PARAM_STR);
	$query->bindParam(':vin', $vin,PDO::PARAM_STR);
	$query->bindParam(':orderquantity',$orderquantity,PDO::PARAM_STR);
	$query->bindParam(':orderdetails',$orderdetails,PDO::PARAM_STR);
	$query->bindParam(':orderunit',$orderunit,PDO::PARAM_STR);
	$query->bindParam(':orderunitpx',$orderunitpx,PDO::PARAM_STR);
	$query->bindParam(':ordertotalpx',$ordertotalpx,PDO::PARAM_STR);
	$query->bindParam(':ufullname',$ufullname,PDO::PARAM_STR);
	$query->bindParam(':postatus',$postatus,PDO::PARAM_STR);
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();
	 	if($lastInsertId){
    		$msg="New PO successfully created";
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
	
	<title>Car Rental Portal| Process PO </title>

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
						<h2 class="page-title">Purchase Orders</h2>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">View Purchase Orders</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-12">
										<table id="zctb" class="display table table-responsive table-striped table-bordered table-hover" cellspacing="0" width=100%">
											<thead>
												<tr>
													<th>#</th>
													<th width=7%>P.O ID</th>
													<th width=12%>P.O DATE</th>
                                                    <th width=18%>VENDOR NAME</th>													
													<th>ORDER UNIT</th>
                                                    <th>ORDER DETAILS</th>
													<th>ORDER TOTAL</th>
													<th>USER</th>
                                                    <th>PRINT</th>
                                                    <th>EDIT</th>
                                                    <th>DELETE</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
                                                    <th>#</th>
													<th>P.O ID</th>
													<th>P.O DATE</th>
                                                    <th>VENDOR NAME</th>													
													<th>ORDER UNIT</th>
                                                    <th>ORDER DETAILS</th>
													<th>ORDER TOTAL</th>
													<th>USER</th>
                                                    <th>PRINT</th>
                                                    <th>EDIT</th>
                                                    <th>DELETE</th>
												</tr>
											</tfoot>
											<tbody>
												<?php $sql = "SELECT PONumber, PODate, VendorName, POQty, PODescription, POUnit, POUP, POTotal, POUser FROM po ORDER BY PONumber";
													$query = $dbh -> prepare($sql);
													$query->execute();
													$results=$query->fetchAll(PDO::FETCH_OBJ);
													$cnt=1;
													if($query->rowCount() > 0){
														foreach($results as $result)
												{
												?>	
												<tr>
													<td><?php echo htmlentities($cnt);?></td>
													<td><?php echo htmlentities($result->PONumber);?>
                                                    <td><?php echo date("d-m-Y", strtotime($result->PODate));?></td>							
													<td><?php echo htmlentities($result->VendorName);?></td>
                                                    <td><?php echo htmlentities($result->POUnit);?></td>
													<td><?php echo htmlentities($result->PODescription);?></td>																										
													<td><?php echo htmlentities($result->POTotal);?></td>
                                                    <td><?php echo htmlentities($result->POUser);?></td>
                                                    <td><a href=generate_pdf.php?ponumber=<?php echo htmlentities($result->PONumber);?> title="PRINT P.O"><span class="glyphicon glyphicon-print"></span></a></td>
                                                    <td><a href="edit_po.php?ponumber=<?php echo htmlentities($result->PONumber);?> title="EDIT P.O"><span class="glyphicon glyphicon-edit"></span></a></td>
                                                    <td><a href="#" id="'.$invoiceDetails["order_id"].'" class="deleteInvoice"  title="DELETE P.O"><span class="glyphicon glyphicon-remove"></span></a></td>
												</tr>
													<?php $cnt=$cnt+1; }} ?>										
											</tbody>
											<table id="zttc" class="table table-bordered table-hover" cellspacing="0" width="50%">
												<tr>
													<td>
														<button type="button" id="btref" class="btn btn-md btn-danger" onClick="parent.location='view-po-records.php'">REFRESH PAGE</button>
														<button type="button" id="btclose"  class="btn btn-md btn-danger" onClick="parent.location='add-po-record.php'">GO BACK</button>
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
