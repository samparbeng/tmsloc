<?php
   error_reporting();
   include('includes/config.php');
   include('includes/cconfig.php');
?>
<form id="appendactions" action="loadres.php">
 <table id="zttX" class="display table table-striped table-bordered table-hover" cellspacing="0" width="50%">
	<tr>
	<td>
		<label>SELECT ACTION</label>
	</td>
	<td>
	<select name="actsel" id="actsel">														
		<?php
			$sqlact = "SELECT id, resact from resacts order by id ";
			$query = $dbh -> prepare($sqlact);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($results as $row) {
			echo strtoupper('<option>'.$row['resact'].'</option>');
			}
		?>
	</select>
	</td>
	<td>
		<input type="submit" id="setact" name="setact" class="btn  btn-md btn-success active" value="UPDATE DETAILS">
	</td>
	</tr>
</table>
</form>