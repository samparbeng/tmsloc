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
if (isset($_GET['selpoid'])) {
    $selpoid = trim($_GET['selpoid']);
    $sql_del = "DELETE FROM po WHERE PONumber = '{$selpoid}'";
    mysqli_query($conn, $sql_del) or die(mysql_error());

    header("location: view-po-records.php");
    exit();
}

?>