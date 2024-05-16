        <?php
        if (!empty($_POST['txtCompName'])) {
            $compname = trim(htmlspecialchars($_POST['txtCompName']));
        }

         if(!empty($_POST['txtContPer'])){
            $contper = trim(htmlspecialchars($_POST['txtContPer']));
         }  
            
         if(!empty($_POST['txtPhoneNum'])) {
            $phonenum = trim(htmlspecialchars($_POST['txtPhoneNum']));       
        } 
        if (!empty($_POST['txtVehCat'])){
            $vehcat = trim(htmlspecialchars($_POST['txtVehCat']));
		}
		if(!empty($_POST['stadate'])){
			$stadate = trim(htmlspecialchars($_POST['stadate']));
		}

		if(!empty($_POST['enddate'])){
			$stadate = trim(htmlspecialchars($_POST['enddate']));
		}

        if (!empty($_POST['txtDur'])) {
            $duration = $_POST['txtDur'];
            $duration = filter_var($duration, FILTER_VALIDATE_INT);
            if ($duration === false) {
                exit('Invalid Number of Days');
            }
		}
		
		if (!empty($_POST['txtRemarks'])){
            $remarks = trim(htmlspecialchars($_POST['txtRemarks']));
		}

        if (!empty($_POST['txtDestination'])){
            $destination = trim(htmlspecialchars($_POST['txtDestination']));
		}
        ?>