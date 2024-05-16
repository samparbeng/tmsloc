
<table>
	<tr>
	<td>
		<label>SELECT ACTION</label>
	</td>
	<td>
	<select>														
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
	<td><button id="setact" type="button" class="btn  btn-md btn-success active">UPDATE DETAILS</button></td>
	</tr>
</table>