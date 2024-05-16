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
			$sqlact = "SELECT id, resact from resacts order by id ";
			$query = $dbh -> prepare($sqlact);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($results as $row) {
			echo strtoupper('<option>'.$row['resact'].'</option>');
			}
		?>
