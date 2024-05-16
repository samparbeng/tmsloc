<?php
session_start();
error_reporting();
include('includes/config.php');
include('includes/cconfig.php');
if(strlen($_SESSION['alogin'])==0)
{	
	header('location:index.php');
}
else
{
	header('Location:reg-users.php');
}
?>

<?php
if(isset($_POST["buttonsub"]))
{
	$pwde = md5($_POST['password']);
	$sql="INSERT INTO administrator (UserFullName, UserName, password, UserDesignation, UserEmail)
	VALUES
	('$_POST[txtUserFullName]','$_POST[txtUserName]','$pwde','$_POST[txtUserDesignation]','$_POST[txtUserEmail]')";

	if (mysqli_query($conn,$sql)===false)
	{
 		die('Error: ' . mysqli_error($conn));
  	}
  	else
  	{
	  $msg = "New User Successfully Added...";
  	}
}

?> 

