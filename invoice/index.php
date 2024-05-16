<?php 
session_start();
include('header.php');
$loginError = '';
if (!empty($_POST['username']) && !empty($_POST['pwd'])) {
	include('Invoice.php');
	$invoice = new Invoice();
	$user = $invoice->loginUsers($_POST['username'], md5($_POST['pwd'])); 
	if(!empty($user)) {
		$_SESSION['user'] = $user[0]['FirstName'] ." ". $user[0]['LastName'];
		$_SESSION['userid'] = $user[0]['id'];
		$_SESSION['email'] = $user[0]['UserEmail'];		
		$_SESSION['address'] = $user[0]['Address'];
		$_SESSION['mobile'] = $user[0]['Mobile'];
		header("Location:invoice_list.php");
	} else {
		$loginError = "Invalid Username or password!";
	}
}
?>
<title>INVOICING AND PURCHASE ORDER SYSTEM</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
<div class="row">	
	<div class="demo-heading">
		<h2>Invoicing and Purchase Order System</h2>
	</div>
	<div class="login-form">		
		<h4>Invoice User Login:</h4>		
		<form method="post" action="">
			<div class="form-group">
			<?php if ($loginError ) { ?>
				<div class="alert alert-warning"><?php echo $loginError; ?></div>
			<?php } ?>
			</div>
			<div class="form-group">
				<input name="username" id="username" type="text" class="form-control" placeholder="User Name" autofocus="" required>
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="pwd" placeholder="Password" required>
			</div>  
			<div class="form-group">
				<button type="submit" name="login" class="btn btn-info">Login</button>
			</div>
		</form>
	</div>		
</div>		
</div>
<?php include('footer.php');?>