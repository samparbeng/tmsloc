<?php 
session_start();
include('includes/config.php');
include('includes/cconfig.php');
include('header.php');
include('Invoice.php');
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_POST['companyName']) && $_POST['companyName']) {	
	$invoice->saveInvoice($_POST);
	header("Location:invoice_list.php");	
}
?>
<title>INVOICING AND PURCHASE ORDER SYSTEM</title>
<script src="jus/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
<div class="container content-invoice">
	<form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate=""> 
		<div class="load-animate animated fadeInUp">
			<div class="row">
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<h2 class="title">TransPro Invoice System</h2>
					<?php include('menu.php');?>	
				</div>		    		
			</div>
			<input id="currency" type="hidden" value="$">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<h3>From,</h3>
					<?php echo $_SESSION['user']; ?><br>	
					<?php echo $_SESSION['address']; ?><br>	
					<?php echo $_SESSION['mobile']; ?><br>
					<?php echo $_SESSION['email']; ?><br>	
				</div>      		
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
					<h3>To,</h3>
					<div class="form-group">
						<input type="text" class="form-control" name="companyName" id="companyName" placeholder="Company Name" autocomplete="off">
					</div>
					<div class="form-group">
						<textarea class="form-control" rows="3" name="address" id="address" placeholder="Your Address"></textarea>
					</div>
					
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<table class="table table-bordered table-hover" id="invoiceItem">	
						<tr>
							<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>							
							<th width="10%">Quantity</th>
							<th width="49%">Item Name</th>
							<th width="15%">Duration</th>													
							<th width="12%">Price</th>								
							<th width="12%">Total</th>
						</tr>							
						<tr>
							<td><input class="itemRow" type="checkbox"></td>																												
							<td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
							<td><select type="text" name="productName[]" id="productName_1" class="form-control">
								<?php echo strtoupper('<option value="" disabled selected>SELECT INVOICE ITEM</option>');																							
									$sql = "SELECT * FROM vehiclerate ORDER BY id";
									$result = mysqli_query($conn, $sql);
									while ($row = mysqli_fetch_array($result)) {
									echo '<option>'.$row['narrate'].'</option>';
									}									
									echo '</select>';
								?>																
							</td>
							<!--<td><input type="number" name="duration[]" id="duration_1" class="form-control duration" autocomplete="off"></td>-->										
							<td><input type="number" name="duration[]" id="duration_1" class="form-control duration" autocomplete="off"></td>
							<td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off"></td>
							<td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
						</tr>						
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5 col-lg-5">
					<button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button>
					<button class="btn btn-success" id="addRows" type="button">+ Add More</button>
					<button class="btn btn-primary" id="addDiscount" type="button">+ Add Discount</button>
				</div>
			</div>
			<div class="row">	
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					<h3>Notes: </h3>
					<div class="form-group">
						<textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Your Notes"></textarea>
					</div>
					<br>
					<div class="form-group">
						<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
						<input data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" value="Save Invoice" class="btn btn-success submit_btn invoice-save-btm">						
					</div>
					
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<span class="form-inline">
						<div class="form-group">
							<label>Subtotal: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal">
							</div>
						</div>
						<div class="form-group">
							<label>GFund/NHIL %: &nbsp;</label>
							<div class="input-group">
								<input value="" type="number" class="form-control" name="taxRate" id="taxRate" placeholder="GF/NHIL Rate">
								<div class="input-group-addon">%</div>
							</div>
						</div>
						<div class="form-group">
							<label>GETFund/NHIL $: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input type="number" value="" class="form-control" name="taxAmount" id="taxAmount" placeholder="Tax Amount">
							</div>
						</div>
						<div class="form-group">
							<label>Sub VAT Basis: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
							</div>
						</div>						
						<div class="form-group">
							<label>VAT Rate: &nbsp;</label>
							<div class="input-group">
								<input value="" type="number" class="form-control" name="vatRate" id="vatRate" placeholder="VAT Rate">
								<div class="input-group-addon">%</div>
							</div>
						</div>						
						<div class="form-group">
							<label>VAT Amount: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="vatAmount" id="vatAmount" placeholder="VAT Amount">
							</div>
						</div>				
						<div class="form-group">
							<label>After Taxes: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="totalAftertaxes" id="totalAftertaxes" placeholder="Total after Taxes">
							</div>
						</div>
						<div class="form-group">
							<label>GTL Rate: &nbsp;</label>
							<div class="input-group">
								<input value="" type="number" class="form-control" name="gtlRate" id="gtlRate" placeholder="GTL Rate">
								<div class="input-group-addon">%</div>
							</div>
						</div>						
						<div class="form-group">
							<label>GTL Amount: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="gtlAmount" id="gtlAmount" placeholder="GTL Amount">
							</div>
						</div>
						<div class="form-group">
							<label>Total AfGTL: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="totalAfterGTL" id="totalAfterGTL" placeholder="Total After GTL">
							</div>
						</div>
						<div class="form-group">
							<label>Drivers All.: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="driverAllowance" id="driverAllowance" placeholder="Driver's Allowance">
							</div>
						</div>
						<div class="form-group">
							<label>T-W/O-F: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="totalWOF" id="totalWOF" placeholder="Total Without Fuel">
							</div>
						</div>
						<div class="form-group">
							<label>Fuel Amount: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="fuelAmount" id="fuelAmount" placeholder="Fuel Total">
							</div>
						</div>
						<div class="form-group">
							<label>Amount Paid: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Amount Paid">
							</div>
						</div>
						<div class="form-group">
							<label>Amount Due: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Amount Due">
							</div>
						</div>
					</span>
				</div>
			</div>
			<div class="clearfix"></div>		      	
		</div>
	</form>			
</div>
</div>	
<?php include('footer.php');?>