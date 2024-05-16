<?php
session_start();
error_reporting();
include('includes/config.php');
include('includes/cconfig.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
//(SERVICEDATE, SERVICEVEHICLE, SERVICEODO, SERVICEGARAGE, GLOCATION, SERVICEDRIVER, SERVICEUSER, SERVICEDETAILS)
?>
 
 <?php
    if(isset($_POST["enter-service-record"]))
    {
		// the request method is fine
	
        $moduleuser = "". $_SESSION['alogin'];
        
		if (!empty($_POST['servicedate'])) 
		{
    		$servicedate = trim($_POST['servicedate']);
    	}

		if(!empty($_POST['txtveh']))
		{
    		$servicevehicle = trim($_POST['txtveh']);
    	}

		if(!empty($_POST['serviceodo']))
		{
    		$serviceodo = trim($_POST['serviceodo']);       
    	}

		if(!empty($_POST['garage']))
		{
    		$garage = trim($_POST['garage']);
   	 	}
    
		if(!empty($_POST['garagelocation']))
		{
			$garagelocation = ($_POST['garagelocation']);
    	}
        
        if(!empty($_POST['servicedriver']))
		{
			$servicedriver = ($_POST['servicedriver']);
    	}
    	

		if (!empty($_POST['servicedetail']))
		{
    		$servicedetail = trim($_POST['servicedetail']);
        }
    echo $moduleuser && $servicedate && $servicevehicle && $serviceodo && $garage ;
    }
 ?>