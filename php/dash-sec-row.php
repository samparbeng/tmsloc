<div id="second-row" class="row">						
					aaaaaaaaaaaaa
					<div id="allreservations" class="col-sm-3">
						<div class="panel panel-default">
							<div class="panel-body bk-primary text-light">
								<div class="stat-panel text-center">
									<?php 
										$sql5 ="SELECT resid from reservations ";
										$query5= $dbh -> prepare($sql5);
										$query5->execute();
										$results5=$query5->fetchAll(PDO::FETCH_OBJ);
										$totalreservations=$query5->rowCount();
									?>
										<div class="stat-panel-number h1 "><?php echo htmlentities($totalreservations);?></div>
										<div class="stat-panel-title text-uppercase">Total Reservations</div>
								</div>
							</div>
								<a href="view-reservations.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
						</div>
					
					
					</div>					
					bbbbbbbbbbbbb
					<div id="vendors" class="col-sm-3">
						<div class="panel panel-default">
							<div class="panel-body bk-success text-light">
								<div class="stat-panel text-center">
									<?php 
										$sqlvendor ="SELECT id from vendor ";
										$query6= $dbh -> prepare($sqlvendor);
										$query6->execute();
										$results6=$query6->fetchAll(PDO::FETCH_OBJ);
										$totalreservations=$query6->rowCount();
									?>
										<div class="stat-panel-number h1 "><?php echo htmlentities($totalreservations);?></div>
										<div class="stat-panel-title text-uppercase">Vendors</div>
								</div>
							</div>
								<a href="view-vendor-det.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
						</div>
					</div>										
					cccccccccccc
					<div id="alerts-ins" class="col-sm-3">
						<div class="panel panel-default">
							<div class="panel-body bk-danger text-light">
								<div class="stat-panel text-center">
									<?php 													
										$dtoday = new datetime();
										echo $dtoday->format('Y-m-d H:i:s');
										$sqlinsurance ="SELECT * FROM fleetmain WHERE insurance >= $dtoday";
										$query6= $dbh -> prepare($sqlinsurance);
										$query6->execute() or die(print_r($query6->errorInfo(), true));													
										$results6=$query6->fetchAll(PDO::FETCH_OBJ);
										if($query6->rowCount > 0)
										{
											$totalinsurance=$query6->rowCount();
										}else
										{
											$totalinsurance=0;
										}
									?>
										<div class="stat-panel-number h1 "><?php echo $totalinsurance;?></div>
										<div class="stat-panel-title text-uppercase">Upcoming Insurance Renewals</div>
								</div>
							</div>
								<a href="view-vendor-det.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
						</div>
					</div>					
					dddddddddddd
					<div id="alerts-road" class="col-md-3">
						<div class="panel panel-default">
							AAAAAAAAAAAAAAAAA
							<div class="panel-body bk-warning text-light">
								<div class="stat-panel text-center">
									<?php 													
										$dtoday1 = new datetime();
										$today2 = $dtoday->format('Y-m-d');
										$sqlinsurance2 ="SELECT * FROM ExchangeRate WHERE RateDate = $dtoday2 ";
										$query6= $dbh -> prepare($sqlinsurance2);
										$query6->execute() or die(print_r($query6->errorInfo(), true));													
										$results7=$query7->fetchAll(PDO::FETCH_OBJ);
										if($results7->rowCount > 0)
										{
											$exrate=$query6->DollarToCeddi;
										}else
										{
											$exrate = "Forex Rates Not Set for Today";
										}
									?>
										<div class="stat-panel-number h1 "><?php echo "GHC" && $exrate;?></div>
										<div class="stat-panel-title text-uppercase">Today's Exchange Rates</div>
								</div>
							</div>
								<a href="view-vendor-det.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
						</div>
					</div>				
				WWWWWWWWWWWWWW
				</div>


											<?php 	
											$stmt = $dbh->query("SELECT * FROM exchangerate WHERE");
											$allRows = $stmt->rowCount();
											$i = 1;
											while($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
											{
												if ($allRows == $i) 
												{
													/* Do Something Here*/
													// echo $allRows;
														
												} else 
												{
													/* Do Another Thing Here*/
												}
    											$i++;
											}
											?>

											$sqler="SELECT * FROM exchangerate WHERE ratedate = $dt";
												$query = $dbh -> prepare($sqler);
												$query->execute() or die(print_r($query->errorInfo(), true));
												$results=$query->fetchAll(PDO::FETCH_OBJ);												
												if($query->rowCount() > 0)
												{													
													foreach($results as $result)
													{
														$exrate = $dollartocedi;
													}
												}
												else
												{
													$exrate = "5.50";
												}