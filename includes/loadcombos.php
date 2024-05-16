<?php
   error_reporting();
   include('includes/config.php');
   include('includes/cconfig.php');
?>

<form name="resAssign" class="form-style-9" method="post" action="set-det.php" enctype="multipart/form-data"">
    <table id="zttd" class="display table table-striped table-bordered table-hover" cellspacing="0" width="50%">                            
<tr>
	<td width="19%">SELECT DRIVER</td>
    <td><select type="text" class="field-style align-right" name="drsel">
	    <?php
			$sqldr = "SELECT id, fullname from drivers order by fullname ";
			$query = $dbh -> prepare($sqldr);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($results as $row) {
		    echo strtoupper('<option>'.$row['fullname'].'</option>');
			}
		?>
	</select>
	</td>
</tr>
<tr>
	<td>SELECT VEHICLE</td>
	<td><select type="text" class="field-style align-right" name="vehsel">
		    <?php
		        $sqlveh = "SELECT idid, regnumber from vehicle order by regnumber ";
			    $query = $dbh -> prepare($sqlveh);
			    $query->execute();
			    $results = $query->fetchAll(PDO::FETCH_ASSOC);
			    foreach ($results as $row) {
			    echo strtoupper('<option>'.$row['regnumber'].'</option>');
			    }
            ?>
	    </select>
	</td>
</tr>
<tr>
	<td>SELECT TRIP CODE</td>
	<td><select type="text" class="field-style align-right" name="tpsel">
			<?php
				$sqltp = "SELECT id, tripcode from dvrt order by id ";
				$query = $dbh -> prepare($sqltp);
				$query->execute();
				$results = $query->fetchAll(PDO::FETCH_ASSOC);
				foreach ($results as $row) {
				echo strtoupper('<option>'.$row['tripcode'].'</option>');
				}
				?>
		</select>
	</td>
</tr>
</table>
<input type="hidden" id="settingid" name="settingid" value=<?php echo intval($acqid);?>>
<input type="text" name="testid" id="testid" value=<?php echo ($acqid);?>>
<input type="submit" id="btn_setdet" name="btn_setdet" value=<?php echo intval($acqid);?>>
</form>
