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
  <link rel="stylesheet" href="css/styleX.css">
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
							<div class="panel-heading">Edit <?php echo $ponumber; ?>
							</div>
								<div class="panel-body">
								<div class="table-responsive">    
                                <div class="row row-no-gutters">
									<div class="col-sm-10">	
									<?php
										$sqlpoedit = "SELECT PONumber, PODate, VendorName, POQty, PODescription, POUnit, POUP, POTotal, POUser, DeliverTo FROM po WHERE PONumber='".$ponumber."'";
										$result = mysqli_query ($conn, $sqlpoedit) or die (mysqli_error ());                                      
                                        while ($row2 = mysqli_fetch_array ($result)){
                                    ?>                                   
                    					<form name="porecord" class="form-style-9" method="post" action="procpoedit.php" enctype="multipart/form-data">
											<ul>
                                                <li>
						  							<label class="label-style label-split align-left">PO Date</label>
                                					<input style="text-transform: uppercase;" id="orderdate" width="208px" name="orderdate" type="text" class="field-style field-split align-right" value=<?php echo date("m/d/Y", strtotime($row2['PODate']));?> required="true"/>   
						  						</li>  
                                                <li>
													<label class="label-style label-split align-left">Vendor Name</label>
													<select type="text" class="field-style align-right" name="ordervendorname" width="208">
                                    					<?php
															//$sqldr = "SELECT id, VENDORNAME from vendor order by VENDORNAME ";
															//$query = $dbh -> prepare($sqldr);
															//$query->execute();
															//$results = $query->fetchAll(PDO::FETCH_ASSOC);
                                                            //echo strtoupper('<option value="" disabled selected>SELECT VENDOR</option>');
                                                            //foreach ($results as $row) {
                                                                //echo strtoupper('<option>'.$row['VENDORNAME'].'</option>');
															//}
														?>
														<?php
															$sqldr = "SELECT id, VENDORNAME from vendor order by VENDORNAME ";
															$query = $dbh -> prepare($sqldr);
															$query->execute();
															$results = $query->fetchAll(PDO::FETCH_ASSOC);
																echo strtoupper('<option>'.$row2['VendorName'].'</option>');
															foreach ($results as $row) 
                                                            {
		   					 								    echo strtoupper('<option>'.$row['VENDORNAME'].'</option>');
															}
														?>

                                    				</select>
						  						</li>                                         
                                                <li>
													<label class="label-style label-split align-left">Quantity</label>
													<input style="text-transform: uppercase;" type="text" name="orderquantity" id="orderquantity" class="field-style field-split align-right" placeholder="Order Quantity" value=<?php echo $row2['POQty'];?> required="true" />													
												</li>
												<li>
													<label class="label-style label-split align-left">Unit</label>
													<select type="text" class="field-style align-right" name="orderunit" id="orderunit" width="208">
                                    					<?php
															$sqlservedr = "SELECT DISTINCT Units from vendormatch order by Units ";
															$query = $dbh -> prepare($sqlservedr);
															$query->execute();
                                                            $results = $query->fetchAll(PDO::FETCH_ASSOC);
                                                            echo strtoupper('<option>'.$row2['POUnit'].'</option>');
															foreach ($results as $row) {
		   					 								echo strtoupper('<option>'.$row['Units'].'</option>');
															}
														?>
                                    				</select>
						  						</li>
						  						
											</ul>
											<ul>
						  						<li>
						  							<label class="label-style label-split align-left">Order Details</label>
                              						<textarea style="text-transform: uppercase;" name="orderdetails" id="orderdetails" class="field-style field-split align-right" value=<?php echo $row2['PODescription'];?> rows="6" cols="40"><?php echo $row2['PODescription']?></textarea>
                          						</li>
												<li>
													<label class="label-style label-split align-left">Unit Price</label>
													<input type="number" name="orderunitpx" id="orderunitpx"class="field-style field-split align-right" value=<?php echo $row2['POUP'];?> placeholder="Order Unit Px" required="true"/>
												</li>
												<li>
													<label class="label-style label-split align-left">Total Amount</label>
													<input type="number" name="ordertotalpx" id="ordertotalpx" class="field-style field-split align-right" value=<?php echo $row2['POTotal'];?> placeholder="Total Amount" required="true"/>
													<input type="hidden" name="eponumber" id="eponumber" value=<?php echo $row2['PONumber'];?>>
												</li>

											</ul>
											<ul>
						  						<li>
													<table id="zttc" class="table table-bordered table-hover" cellspacing="0" width="50%">
														<tr>
															<td>
																<button type="submit" name="updateporec" id="updateporec" class="btn btn-md btn-primary active">UPDATE PO RECORD</button>
																<button type="reset" id="setact"  class="btn  btn-md btn-success active">RESET FORM</button>
																<button type="button" id="btclose"  class="btn btn-md btn-danger" onClick="parent.location='dashboard.php'">GO BACK</button>
															</td>
														</tr>
													</table>
						  						</li>
											</ul>
										</form>
										<?php }?>
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
    $( "#orderdate" ).datepicker();
  } );
  </script>

  <script>
    function populateDropdown(data) {
    if (data != 'error') {
        var obj=JSON.parse(data);
        $('#slcCatListWrapper').html(obj.vendor);
        $('#authorNameWrapper').html(obj.units);
    }
}
  </script>

  <script>
 $(document).ready(function(){
	//On Blur procedures		

	$(document).on('blur', "#orderquantity", function(){
		calculateTotal();
	});

	$(document).on('blur', "#orderunitpx", function(){				
		calculateTotal();		
	});

	$(document).on('blur', "#ordertotalpx", function(){		
		calculateTotal();
	});	
	$(document).on('click', '.deleteInvoice', function(){
		var id = $(this).attr("id");
		if(confirm("Are you sure you want to remove this?")){
			$.ajax({
				url:"action.php",
				method:"POST",
				dataType: "json",
				data:{id:id, action:'delete_invoice'},				
				success:function(response) {
					if(response.status == 1) {
						$('#'+id).closest("tr").remove();
					}
				}
			});
		} else {
			return false;
		}
	});
});	

function calculateTotal(){
	$(document).on('blur', "#orderquantity", function(){
		var orderquantity = $('#orderquantity').val();
		if(!orderquantiti){
			orderquantity = 1
		}
		var orderunitpx = $('#orderunitpx').val();			
		if(orderquantity && orderunitpx) {
			ordertotalpx = orderquantity*orderunitpx;			
			$('#ordertotalpx').val(ordertotalpx);
			} 
		});
}
 
</script>
</body>
</html>
