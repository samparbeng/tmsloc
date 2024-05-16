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
	$ponumber=$_GET['ponumber'];
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
	endwhile;
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
  	<link rel="stylesheet" href="css/jquery-bootstrap-datepicker.css">
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

#mybox-x {
	width: 30%;
	max-width: 33.33%;
	background: #FAFAFA;
	float: left;
	padding: 0px;
	padding-bottom: 0px;
	margin: 15px auto;
	margin-left: 15px;
  	box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.35);
	border-radius: 10px;
	border: 1.5px solid #305A72;
	overflow: hidden;
}
#mybox-y {
	width: 30%;
	max-width: 33.33%;
	background: #FAFAFA;
	float: right;
	padding: 0px;
	padding-bottom: 0px;
	margin: 15px auto;
	margin-right: 15px;
  	box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.35);
	border-radius: 10px;
	border: 1.5px solid #305A72;
	overflow: hidden;
}
</style>

<script language="javascript">
    var gAutoPrint = true;

    function processPrint(){
    	if (document.getElementById != null){
    		var html = '<HTML>\n<HEAD>\n';
    		if (document.getElementsByTagName != null){
    			var headTags = document.getElementsByTagName("head");
    			if (headTags.length > 0) html += headTags[0].innerHTML;
    			}

  		html += '\n</HE' + 'AD>\n<BODY>\n';
    	var printReadyElem = document.getElementById("printMe");

   		if (printReadyElem != null) html += printReadyElem.innerHTML;
    	else{
    		alert("Error, no contents.");
    		return;
    		}

    html += '\n</BO' + 'DY>\n</HT' + 'ML>';
    var printWin = window.open("","processPrint");
    	printWin.document.open();
    	printWin.document.write(html);
    	printWin.document.close();
    	if (gAutoPrint) printWin.print();
   	 } else alert("Browser not supported.");
    }
	function printDiv(printName){
			var printContents = document.getElementById(printName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		}
</script>

</head>
<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
					<h2 class="page-title">Vendors</h2>
					<!-- Zero Configuration Table -->
						<div name="printMe" id ="printMe" class="panel panel-default">
							<div class="panel-heading" height="20px">Purchasing Order							
								<?php $sqlpo = "SELECT PONumber, PODate, VendorName, POQty, PODescription, POUnit, POUP, POTotal, POStatus, VIN, POUser, 
								GFNHIL, VAT, DeliverTo FROM po WHERE PONumber='".$ponumber."'";
										$query = $dbh -> prepare($sqlpo);
										$query->execute();
										$results=$query->fetchAll(PDO::FETCH_OBJ);
										$cnt=1;
										if($query->rowCount() > 0)
										{
											foreach($results as $result)
												{ ?>
							</div>
							<div class="panel-body">
								<div class="panel">
									<img src="img/lth.png">
								</div>									
								<div class="panel">	
									<div class="row">
										<div class="col-md-6">
											<div class="panel panel-body">
												<h3>PURCHASE ORDER # <?php echo htmlentities($result->PONumber);?></h3>
											</div>
										</div>
									</div>
								</div>								
								<div class ="panel">								
  									<div id="mybox-x" class="col-xs-5">
										<div class="panel panel-default">
											<div style="height: 30px;padding: 0px" class="panel-heading">SUPPLIER</div>
											<div class="panel panel-body">
												<?php echo htmlentities($result->VendorName);?>	
											</div>										
										</div>
									</div>

									<div id="mybox-y" class="col-xs-5">
										<div class="panel panel-default">
											<div style="height: 30px; padding:0px" class="panel-heading">DELIVER TO</div>
											<div class="panel panel-body">
												<?php echo htmlentities($result->DeliverTo);?>
											</div>										
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-3">
									<?php
									?>
									</div>
								</div>									
								<div class="panel">
									<div class="col-md-12">
										<table id="mytable" class="table table-striped" cellspacing="0" width="100%">
												<tr>
													<th id="myth">P.O DATE</th>
													<th id="myth">REQUISITIONER</th>
													<th id="myth">SHIPR</th>
													<th id="myth">FOB POINT</th>
													<th id="myth">TERMS</th>
												</tr>
												<tr>
													<td id="mytd"><?php echo date("d-m-Y", strtotime($result->PODate));?></td>
													<td id="mytd"><?php echo htmlentities($result->POUser);?></td>
													<td id="mytds"></td>
													<td id="mytds"></td>
													<td id="mytds"></td>
												</tr>
										</table>
										<table id="mytable" cellspacing="0" width="100%">
											<tr>
												<th id="myth">INV. #</th>
												<th id="myth">QTY</th>
												<th id="myth">UNIT</th>
												<th id="myth">DESCRIPTION</th>
												<th id="myth">UNIT PRICE</th>
												<th id="myth">TOTAL</th>
											</tr>
											<tr>
												<td id="mytd"><?php echo htmlentities($result->VIN);?></td>
												<td id="mytd"><?php echo htmlentities($result->POQty);?></td>
												<td id="mytd"><?php echo htmlentities($result->POUnit);?></td>
												<td id="mytd"><?php echo strtoupper($result->PODescription);?></td>
												<td id="mytdscur"><?php echo htmlentities($result->POUP);?></td>
												<td id="mytdscur"><?php echo htmlentities($result->POTotal);?></td>
											</tr>
											<tr>
												<td id="mytd"></td>
												<td id="mytd"></td>
												<td id="mytd"></td>
												<td id="mytd"></td>
												<td id="mytd">5% GF/NHIL</td>
												<td id="mytdscur"><?php echo htmlentities($result->GFNHIL);?></td>
											</tr>
											<tr>
												<td id="mytd"></td>
												<td id="mytd"></td>
												<td id="mytd"></td>
												<td id="mytd"></td>
												<td id="mytd">12.5% VAT</td>
												<td id="mytdscur"><?php echo htmlentities($result->VAT);?></td>
											</tr>
											<tr>
												<td id="mytd"></td>
												<td id="mytd"></td>
												<td id="mytd"></td>
												<td id="mytd"></td>
												<td id="mytd">TOTAL</td>
												<td id="mytdscur"><?php echo htmlentities($result->POTotal);?></td>
											</tr>
										</table>																						
									</div>
								</div>
							</div>
							<?php }}?>
						</div>
						<div id="off-use" class="panel panel-default">
							<div class="panel-heading">OFFICIAL US</div>
								<div class="panel-body">
									<table id="mytable" class="table table-striped table-hover">
										<tr>
											<th id="myth">P.O STATUS</th>
											<th id="myth">DATE</th>
											<th id="myth">PMT METHOD</th>
											<th id="myth">CHQ NO.</th>
										</tr>
										<tr>
											<td id="mytds"><?php echo htmlentities($result->POStatus);?></td>
											<td id="mytds"></td>
											<td id="mytds"></td>
											<td id="mytds"></td>													
										</tr>
									</table>
								</div>
							</div>								
						</div>
					</div>							
				</div>
				<div class="col-md-6">
				<table id="zttc" class="table table-bordered table-hover" cellspacing="0" width="50%">
					<tr>
						<td>
							<button type="button" id="btref" class="btn btn-md btn-danger" onClick="parent.location='#'">REFRESH PAGE</button>
							<button type="button" id="btclose" class="btn btn-md btn-danger" onClick="parent.location='view-po-records.php'">GO BACK</button>
							<button type="button" id="btprint" class="btn btn-md btn-success"  onclick="printDiv('printMe')">Print Purchase Order</button>
						</td>
					</tr>
				</table>
				<div>					
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
	<!--script src="js/jquery-ui-1.8.18.custom.min.js"></script-->
	<!--script src="js/jquery-1.7.1.min.js"></script-->														
</body>
</html>