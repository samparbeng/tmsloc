<nav class="ts-sidebar">
	<ul class="ts-sidebar-menu">
		<li class="ts-label">Main</li>
			<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="#"><i class="fa fa-files-o"></i> Reservations</a>
				<ul>
					<li><a href="addreservation.php">Add Reservation</a></li>
					<li><a href="view-reservations.php">View All Reservations</a></li>
					<li><a href="view-pending-reservations.php">View Pending Reservations</a></li>
					<li><a href="view-ongoing-reservations.php">View On-Going Reservations</a></li>
					<li><a href="view-closed-reservations.php">View Closed Reservations</a></li>					
					<li><a href="view-cancelled-reservations.php">View Cancelled Reservations</a></li>
				</ul>
			</li>
			<li><a href="#"><i class="fa fa-files-o"></i> Drivers</a>
				<ul>
					<li><a href="add-driver.php">Create Driver</a></li>
					<li><a href="view-drivers.php">View Drivers</a></li>
					<li><a href="view-all-drivers.php">View All Drivers</a></li>
				</ul>
			</li>
			<li><a href="#"><i class="fa fa-files-o"></i> Vehicles</a>
				<ul>
					<li><a href="add-vehicle.php">Add Vehicle</a></li>
					<li><a href="manage-vehicles.php">Manage Vehicle</a></li>
					<li><a href="view-fleet-det.php">View Full Fleet</a></li>
				</ul>
			</li>
			<li><a href="#"><i class="fa fa-files-o"></i> Vendors</a>
				<ul>
					<li><a href="addvendor.php">Add Vendor</a></li>
					<li><a href="view-vendor-det.php">View Vendors</a></li>
					<li><a href="add-po-record.php">Create PO</a></li>
					<li><a href="view-po-records.php">View PO Records</a></li>
				</ul>
			</li>
			<li><a href="#"><i class="fa fa-files-o"></i> Service/Maintenance</a>				
				<ul>
					<li><a href="bookservice.php">Book Service</a></li>
					<li><a href="add-service-record.php">Enter Service Record</a></li>
					<li><a href="view-all-service-records.php">View Service Record</a></li>
				</ul>
			</li>
			<li><a href="#"><i class="fa fa-files-o"></i>Invoicing</a>
				<ul>
					<li><a href="#">Prepare Pro-forma</a></li>
					<li><a href="#">Multi RPF</a></li>
				</ul>
			</li>
			<li><a href="#"><i class="fa fa-dashboard"></i> Reports</a></li>
			<li><a href="#"><i class="fa fa-files-o"></i>Users</a>
				<ul>
					<li><a href="addadmin.php">Create New User</a></li>
					<li><a href="#">Manage Users</a></li>
				</ul>
			</li>
			<?php 
			if($_SESSION['userdesignation'] == "SYSTEM ADMINISTRATOR" )
			{ 
				echo '<li><a href="#"><i class="fa fa-files-o"></i>'.$_SESSION['userdesignation']; echo '</a>';
					echo '<ul>';
						echo '<li><a href="set-ex-rate.php">Set Exchange Rate</a></li>';
						echo '<li><a href="#">Exchange Rate Sources</a></li>';						
					echo '</ul>';	
				echo '</li>';
			}
			?>
	</ul>
</nav>