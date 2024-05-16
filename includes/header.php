<div class="brand clearfix">
	<a href="dashboard.php" style="font-size: 20px;">TransPro Suite | Admin Panel</a>  
		<span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">
			
			<li class="ts-account">
				<a href="#"><img src="img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""><?php echo "". $_SESSION['alogin'];?> <i class="fa fa-angle-down hidden-side"></i></a>
				<ul>
					<li><a href="changepwd.php">Change Password</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
