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

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Car Rental Portal |Add New User</title>

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
						<h2 class="page-title">Administrator View</h2>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">User Audit</div>
							<div class="panel-body">
							<div class="row">
						<div class="col-md-6">			
                  <form name="resEntry" class="form-style-9" method="post" action="procuser.php" enctype="multipart/form-data"">
                        <ul>
							<li>
						  		<label class="label-style label-split align-left">USER FULLNAME</label>
						  		<input type="text" name="txtUserFullName" id="txtUserFullName" class="field-style field-split align-right" required="true"/>
						  	</li>
                          	<li>
						  		<label class="label-style label-split align-left">USER ID</label>
						  		<input type="text" name="txtUserName" id="txtUserName" class="field-style field-split align-right" required="true"/>
						  	</li>

						  	<li>
						  		<label class="label-style label-split align-left">PASSWORD</label>
						  		<input type="password" name="password" id="password" class="field-style field-split align-right" required="true"/>
						  	</li>
						  	<li>
						  		<label class="label-style label-split align-left">CONFIRM PASSWORD</label>
						  		<input type="password" name="cpassword" id="cpassword" class="field-style field-split align-right validate[required,equals[password]] text-input"/>
						  	</li>
						  	<li>
						  		<label class="label-style label-split align-left">USER DESIGNATION</label>
						  		<input type="text" name="txtUserDesignation" id="txtUserDesignation" class="field-style field-split align-right" required="true"/>
						  </li>
						  <li>
						  		<label class="label-style label-split align-left">USER EMAIL</label>
						  		<input type="text" name="txtUserEmail" id="txtUserEmail" class="field-style field-split align-right" required="true"/>
						  </li>
						</ul>
						<p>
                        	<input type="submit" class="btn btn-success" name="buttonsub" id="buttonsub" value="Submit">
                        	<input type="submit" class="btn btn-info" name="btnreset" id="Reset" value="Reset">
                            <input type="submit" class="btn btn-danger" value="Close" name="btnclose" onClick="parent.location='dashboard.php'" /></p>
                          	                   
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
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <!--script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );

  </script-->
</body>
</html>