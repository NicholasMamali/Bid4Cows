<?php
	include 'conn.php';
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	
	function display_active_auctions($id=0)
	{
		$userID=$id;
		
		$sql = "SELECT * FROM auction WHERE ownerID=".$userID;  //SHOW auctions only for the current owner
		$conn = $GLOBALS['conn'];   //accsess global connection to database
		$result = mysqli_query($conn, $sql);
		
		echo "
		<p>Your Active Auctions</p>
				<br>
					<div class='row'>
					";
					if (mysqli_num_rows($result) > 0) 
					{
						// output data of each row
						while($row = mysqli_fetch_assoc($result)) 
						{
							$endDate = strtotime($row['endDate']);
							//<p id='date".$row['id']."' style='display:none;'>".row['endDate']."</p>
							echo "
								
								<div class='col-lg-3 col-sm-6'>
								";if (time() > $endDate)
								{
								  echo "<div class='card' style='background-color:#FADA5E;'>";
								}
								else{
								  echo "<div class='card'>";
								}
								echo "
										<div class='content'>
											<a href='' data-toggle='modal' data-target='#auctionModal". $row["id"]."'>
											<div class='row'>
												<div class='col-xs-5'>
													<div class='icon-big icon-warning text-center'>
														<img class='card-img-top' src='assets/img/cow2.jpg' alt='cow image' style='width:100%'>
													</div>
												</div>
												<div class='col-xs-7'>
													<div class='numbers'>
														<p>Current price</p>
														R". $row["price"]."
													</div>
												</div>
											</div>
											</a>
											<div class='footer'>
												<hr />
												<div class='stats'>
													<a href='#' data-toggle='collapse' data-target='#moreAuction". $row["id"]."'>
														<i class='ti-reload'></i> click for more
													</a>
												</div>
											</div>
											<div id='moreAuction". $row["id"]."' class='collapse'>
												<h3>Description</h3>
												". $row["description"]."
												<br>
												 
											</div>
										</div>
									</div>
								</div>
								";
						}
					}else
					{
							echo "
								<div class='typo-line'>
                                    <p class='category'>OPPSY</p>
                                    <blockquote>
                                     <p>
									 No results found. You can go to your <a href='cattle.php'>cattle in dashboard</a> and put your cattle on auction to our community.
                                     </p>
                                     <small>
                                     None of your cattle are on auction
                                     </small>
                                    </blockquote>
                                </div>
							";
					}
					echo "
					</div>
					
				<br>
				";
	}
	
	function display_active_bids($id=0)
	{
		$userID=$id;
		$todayDate = date("Y-m-d h:i:sa");
		
		$sql = "SELECT * FROM bids WHERE (userID=".$userID." AND (endDate > '$todayDate' OR highestID=".$userID.") )";
		//echo $sql;
		$conn = $GLOBALS['conn'];   //accsess global connection to database
		$result = mysqli_query($conn, $sql);
		
		echo "
				<p>Your active bids</p>
				<br>
				<div class='row'>
				";
				if (mysqli_num_rows($result) > 0) 
					{
						// output data of each row
						while($row = mysqli_fetch_assoc($result)) 
						{
							
							$res_auction = mysqli_query($conn, "SELECT * FROM auction WHERE id=".$row['auctionID']);
							$row2 = mysqli_fetch_assoc($res_auction);
							echo "
								<div class='col-lg-3 col-sm-6'>";
								if (strtotime($row['endDate'])<time())  //this bid has expired
								{
								   echo "<div class='card' style='background-color:#FADA5E;'>";
								}
								
								elseif($row["price"] >= $row2["price"])
								{
									 echo "<div class='card' style='background-color:#3F704D;'>";
								}
								else{
								  echo "<div class='card' style='background-color:#7E191B;'>";
								}
								echo "
									
										<div class='content'>
											<a href='' data-toggle='modal' data-target='#bidModal". $row["id"]."'>
											<div class='row'>
												<div class='col-xs-5'>
													<div class='icon-big icon-warning text-center'>
														<img class='card-img-top' src='assets/img/cow2.jpg' alt='cow image' style='width:100%'>
													</div>
												</div>
												<div class='col-xs-7'>
													<div class='numbers'>
														<p>Current price</p>
														R". $row2["price"]."
													</div>
												</div>
											</div>
											</a>
											<div class='footer'>
												<hr />
												<div class='stats'>
													<a href='#' data-toggle='collapse' data-target='#moreBid". $row["id"]."'>
														<i class='ti-reload'></i> click for more
													</a>
												</div>
											</div>
											<div id='moreBid". $row["id"]."' class='collapse'>
												<h3>Description</h3>
												<br>
												 ". $row2["description"]."
											</div>
										</div>
									</div>
								</div>
								";
						}
					}else{
						echo " 
						
							<div class='typo-line'>
								<p class='category'>OPPSY</p>
								<blockquote>
								 <p>
								 No results found. You can go to your <a href='explore.php'>explore page in dashboard</a> and make bids.
								 </p>
								 <small>
								 You dont have any bids.
								 </small>
								</blockquote>
							</div>
						
						";
					}
					echo "
					</div>
		";
		
	}
	
	function modal_active_auctions($id=0)
	{
		
		$userID=$id;
		$countx = 0;
		
		$sql = "SELECT * FROM auction WHERE ownerID =".$userID;
		$conn = $GLOBALS['conn'];   //accsess global connection to database
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) 
		{
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) 
			{
				$endDate = strtotime($row['endDate']);
				$countx = $countx +1;

				echo "
				  <div class='modal fade' id='auctionModal". $row["id"]."' role='dialog' >
					<div class='modal-dialog modal-md-10'>   
					  <!-- Modal content-->
					  <div class='modal-content'>
					  ";
					if(time() > $endDate)
					{
						echo "<div class='modal-header' style='background-color:#FADA5E;'>";
					}
					else
					{
						echo "<div class='modal-header'>";
					}
					echo "
						  <button type='button' class='close' data-dismiss='modal'>&times;</button>
						  <!--<h4 class='modal-title'>R20'000</h4>-->
						  <img class='card-img-top' src='assets/img/cow2.jpg' alt='cow image' style='width:10%;height:10%;'>
						</div>
						<div class='modal-body'>
						
							<div class='container-fluid'>
								<div class='row'>
									<div class='col-lg-12 col-sm-6'>
										<div class='col-md-6 col-sm-6'>
											<div class='card'>
												<div class='content'>
													<div class='row'>
														<div class='col-xs-5'>
															<div class='icon-big icon-danger text-center'>
																<i class='ti-wallet'></i>
															</div>
														</div>
														<div class='col-xs-7'>
															<div class='numbers'>
																<p>Current</p>
																<p>Price</p>
																R". $row["price"]."
															</div>
														</div>
													</div>
													<div class='footer'>
														<hr />
														<div class='stats'>
															<a href='#' data-toggle='collapse' data-target='#morePriceHour". $row["id"]."'>
																<i class='ti-timer'></i> click for more
															</a>
														</div>
													</div>
													<div id='morePriceHour". $row["id"]."' class='collapse'>
														prev prices
														<br>
														<br>
														";
														$resultxx  = mysqli_query($conn, "select * from price where auctionID =".$row['id']." ");
														$rowxx = mysqli_fetch_array($resultxx,MYSQLI_ASSOC);
														echo "
														R ".$rowxx['one']."
														<br>
														R ".$rowxx['two']."
														<br>
														R ".$rowxx['three']."
														<br>
														R ".$rowxx['four']."
														
													</div>
												</div>
											</div>
										</div>
										<div class='col-md-6 col-sm-6'>
											<div class='card'>
												<div class='content'>
													<div class='row'>
														<div class='col-xs-5'>
															<div class='icon-big icon-danger text-center'>
																<i class='ti-pulse'></i>
															</div>
														</div>
														<div class='col-xs-7'>
															<div class='numbers'>
																<p>Bids</p>
																<p>Count</p>
																". $row["bidCount"]."
															</div>
														</div>
													</div>
													<div class='footer'>
														<hr />
														<div class='stats'>
															<a href='#' data-toggle='collapse' data-target='#moreBidsInHour". $row["id"]."'>
																<i class='ti-timer'></i> click for more
															</a>
														</div>
													</div>
													<div id='moreBidsInHour". $row["id"]."' class='collapse'>
														This is the number of bids people have placed on the auction
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class='col-lg-12 col-sm-6'> 
										<div class='col-md-6 col-sm-6'>
											<div class='card'>
												<div class='content'>
													<div class='row'>
														<div class='col-xs-5'>
															<div class='icon-big icon-danger text-center'>
																<i class='ti-eye'></i>
															</div>
														</div>
														<div class='col-xs-7'>
															<div class='numbers'>
																<p>Minimum</p>
																<p>Increment</p>
																". $row["minimum"]."
																<br>
																<br>
																<br>
															</div>
														</div>
													</div>
													<div class='footer'>
														<hr />
														<div class='stats'>
															<a href='#' data-toggle='collapse' data-target='#moreViewsBid". $row["id"]."'>
																<i class='ti-timer'></i> click for more
															</a>
														</div>
													</div>
													<div id='moreViewsBid". $row["id"]."' class='collapse'>
														This is the minimum bid increment you are allowed to place on the auction.
													</div>
												</div>
											</div>
										</div>
										<div class='col-md-6 col-sm-6'>
											<div class='card'>
												<div class='content'>
													<div class='row'>
														
														<div class='col-xs-7'>
															<div class='numbers'>
																<p>Time</p>
																<p>Remaining</p>
																<p>dd:hh:mm:ss</p>
																<p id='endDate1".$countx."' class='countdown' style='display:none;'>".$row['endDate']."</p>
																<h4 id='demo1".$countx."' class='countdown' style='font-size=14px;'></h4>
															</div>
														</div>
													</div>
													<div class='footer'>
														<hr />
														<div class='stats'>
															<i class='ti-timer'></i>
														</div>
													</div>
												</div>
											</div>
										</div>
										
									</div>
									<div class='col-lg-12 col-sm-6'>
										
										
											<div class='card'>
												<div class='content'>
													<div class='row'>
														<div class='col-xs-5'>
															<div class='icon-big icon-danger text-center'>
																<i class='ti-gallery'></i>
															</div>
														</div>
														<div class='col-xs-7'>
															<div class='numbers'>
																<p>Details</p>
										
																<p>Showing</p>
																". $row["details"]."
															</div>
														</div>
													</div>
													<div class='footer'>
														<hr />
														<div class='stats'>
															<a href='#' data-toggle='collapse' data-target='#moreDetailsBid". $row["id"]."'>
																<i class='ti-timer'></i> click to change
															</a>
														</div>
													</div>
													<div id='moreDetailsBid". $row["id"]."' class='collapse'>
														
													</div>
												</div>
											</div>
										
									</div>
									
									<div class='col-lg-12 col-sm-4'>
										<div class='card'>
											<div class='header'>
												<h4 class='title'>Highest bidder</h4>
											</div>
											<div class='content'>
												<ul class='list-unstyled team-members'>
													<li>
														<div class='row'>
															<div class='col-xs-3'>
																<div class='avatar'>
																	<img src='assets/img/faces/face-0.jpg' alt='Circle Image' class='img-circle img-no-padding img-responsive'>
																</div>
															</div>
															<div class='col-xs-6'>
																";
																$res_user_highest = mysqli_query($conn, "SELECT * FROM users WHERE id=".$row['highestID']);
																$row2 = mysqli_fetch_assoc($res_user_highest);
																echo "
																".$row2['name']."
																<br />
																<span class='text-muted'><small>".$row2['email']."</small></span>
															</div>

															<div class='col-xs-3 text-right'>
																													
															";
																if(time() > $endDate) //show button to transfer cow to highest bidder
																{
																	echo "
																	
																	<form action='transfer.php' method='post'>
																		<div class='row'>	
																			<div class='form-group' class='text-center' style='margin-left:20%;margin-right:20%;'>
																				<input type='hidden' value='".$_SERVER['REQUEST_URI']."' name='prevlink'/>
																				<input type='hidden' value='".$row2['id']."' name='newOwner'/>
																				<input type='hidden' value='".$row['cowID']."' name='cowID'/>
																				<input type='hidden' value='".$row['id']."' name='auctionID'/>
																			</div>
																			<div class='text-center'>
																				<btn onclick='trasnfer()' class='btn btn-sm btn-success btn-icon'><i class='fa fa-send'></i></btn>
																				<button type='submit' id='trasnferbutton' style='display:none;'>
																			</div>
																			<div class='clearfix'></div>
																		</div>
																	</form>
																	
																	";
																}
																
																echo "
																</div>
														</div>
													</li>
												</ul>
											</div>
										</div>
									</div>
								  
								</div>
							</div>
							
					
						</div>
						<div class='modal-footer'>
							<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
							<!--<button type='button' class='btn btn-primary'>Save changes</button>-->
						</div>
					  </div>
					</div>
				  </div>";
			}
		}
			
	}
	
	
	
	
	function modal_active_bids($id)
	{
		
		$userID=$id;
		$countx =0;
		
		$sql = "SELECT * FROM bids WHERE userID=".$userID;
		$conn = $GLOBALS['conn'];   //accsess global connection to database
		$result = mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($result) > 0) 
		{
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) 
			{
				
				$res_auction = mysqli_query($conn, "SELECT * FROM auction WHERE id=".$row['auctionID']);
				$row2 = mysqli_fetch_assoc($res_auction);
				$countx = $countx +1;
				
				echo "
			
						<!-- Modal -->
						<div class='modal fade' id='bidModal". $row["id"]."' role='dialog' >
						<div class='modal-dialog modal-md-10'>   
						  <!-- Modal content-->
						  <div class='modal-content'>";
						  if (strtotime($row['endDate'])<time())  //this bid has expired
							{
							   echo "<div class='modal-header' style='background-color:#FADA5E;'>";
							}
							
							elseif ($row["price"] >= $row2["price"])
							{
							  echo "<div class='modal-header' style='background-color:#3F704D;'>";
							}
						  else{
							  echo "<div class='modal-header' style='background-color:#7E191B;'>";
						  }
						  echo "
							  <button type='button' class='close' data-dismiss='modal'>&times;</button>
							  <!--<h4 class='modal-title'>R20'000</h4>-->
							  <img class='card-img-top' src='assets/img/cow2.jpg' alt='cow image' style='width:10%;height:10%;'>
							</div>
							<div class='modal-body'>
							
								<div class='container-fluid'>
									<div class='row'>
										<div class='col-lg-12 col-sm-6'>
											<div class='col-md-6 col-sm-6'>
												<div class='card'>
													<div class='content'>
														<div class='row'>
															<div class='col-xs-5'>
																<div class='icon-big icon-danger text-center'>
																	<i class='ti-wallet'></i>
																</div>
															</div>
															<div class='col-xs-7'>
																<div class='numbers'>
																	<p>Current</p>
																	<p>Price</p>
																	R". $row2["price"]."
																</div>
															</div>
														</div>
														<div class='footer'>
															<hr />
															<div class='stats'>
																<a href='#' data-toggle='collapse' data-target='#morePriceHourBid". $row["id"]."'>
																	<i class='ti-timer'></i> click for more
																</a>
															</div>
														</div>
														<div id='morePriceHourBid". $row["id"]."' class='collapse'>
															";
																$resultxx  = mysqli_query($conn, "select * from price where auctionID =".$row['auctionID']." ");
																$rowxx = mysqli_fetch_array($resultxx,MYSQLI_ASSOC);
																echo "
																R ".$rowxx['one']."
																<br>
																R ".$rowxx['two']."
																<br>
																R ".$rowxx['three']."
																<br>
																R ".$rowxx['four']."
														</div>
													</div>
												</div>
											</div>
											<div class='col-md-6 col-sm-6'>
												<div class='card'>
													<div class='content'>
														<div class='row'>
															<div class='col-xs-5'>
																<div class='icon-big icon-danger text-center'>
																	<i class='ti-pulse'></i>
																</div>
															</div>
															<div class='col-xs-7'>
																<div class='numbers'>
																	<p>Your</p>
																	<p>bid</p>
																	R". $row["price"]."
																</div>
															</div>
														</div>
														<div class='footer'>
															<hr />
															<div class='stats'>
															";
															if (strtotime($row['endDate'])<time())  //this bid has expired
															{
																echo"
																<a href='#'>
																	<i class='ti-money'></i> You won
																</a>";
															}
															else{
																echo "
																<a href='#' data-toggle='collapse' data-target='#increaseBidDrop". $row["id"]."'>
																	<i class='ti-money'></i> Increse Bid
																</a>
															";
															}
															echo"
															</div>
														</div>
														<div id='increaseBidDrop". $row["id"]."' class='collapse'>
															<form action='updateBidPrice.php' method='post'>
																<div class='row'>	
																	<div class='form-group' class='text-center' style='margin-left:20%;margin-right:20%;'>
																		<input type='hidden' value='".$_SERVER['REQUEST_URI']."' name='prevlink'/>
																		<input type='hidden' value='".$row['auctionID']."' name='auctionID'/>
																		<input type='hidden' value='".$row['id']."' name='bidID'/>
																		<input type='hidden' value='".$userID."' name='bidderID'/>
																		<input type='number' id='inputpricemodal".$row2['id']."' name='priceInc' class='form-control border-input' placeholder='".$row2['minimum']."' value=''>
																	</div>
																	
																	<div class='text-center'>
																		<btn onclick='tooLow(".$row2['minimum'].",".$row2['price'].",".$row2['id'].")' class='btn btn-info btn-fill btn-wd'>Increase Bid</btn>
																		<button type='submit' id='increasebidmodalhidden".$row2['id']."' style='display:none;'>
																	</div>
																	<div class='clearfix'></div>
																</div>
															</form>
														</div>
														
													</div>
												</div>
											</div>
										</div>
										
											<div class='col-lg-12 col-sm-6'>
												<div class='card'>
													<div class='content'>
														<div class='row'>
															<div class='col-xs-5'>
																<div class='icon-big icon-danger text-center'>
																	<i class='ti-timer'></i>
																</div>
															</div>
															<div class='col-xs-7'>
																<div class='numbers'>
																	<p>Time</p>
																	<p>Remaining</p>
																	<p>dd:hh:mm:ss</p>
																	<br>
															
																	<p id='endDatex".$countx."' class='countdown' style='display:none;'>".$row['endDate']."</p>
																	<h4 id='demox".$countx."' class='countdown' style='font-size=14px;'></h4>
																</div>
															</div>
														</div>
														<div class='footer'>
															<hr />
															<div class='stats'>
																<i class='ti-timer'></i>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class='col-lg-12 col-sm-6'>
												<div class='card'>
													<div class='content'>
														<div class='row'>
															<div class='col-xs-5'>
																<div class='icon-big icon-danger text-center'>
																	<i class='ti-gallery'></i>
																</div>
															</div>
															<div class='col-xs-7'>
																<div class='numbers'>
																	<p>Details</p>
																	<p>of cow</p>
																	<p>Showing</p>
																	". $row2["details"]."
																</div>
															</div>
														</div>
														<div class='footer'>
															<hr />
															<div class='stats'>
																<a href='#' data-toggle='collapse' data-target='#viewBidDetails". $row["id"]."'>
																	<i class='ti-timer'></i> view
																</a>
															</div>
														</div>
														<div id='viewBidDetails". $row["id"]."' class='collapse'>
															". $row2["description"]."
														</div>
													</div>
												</div>
											</div>
										
										
										
										<div class='col-lg-12 col-sm-4'>
										<div class='card'>
											<div class='header'>
												<h4 class='title'>Owner</h4>
											</div>
											<div class='content'>
												<ul class='list-unstyled team-members'>
													<li>
														<div class='row'>
															<div class='col-xs-3'>
																<div class='avatar'>
																	<img src='assets/img/faces/face-0.jpg' alt='Circle Image' class='img-circle img-no-padding img-responsive'>
																</div>
															</div>
															<div class='col-xs-6'>
																";
																$res_user_highest = mysqli_query($conn, "SELECT * FROM users WHERE id=".$row2['ownerID']);
																$row2 = mysqli_fetch_assoc($res_user_highest);
																echo "
																".$row2['name']."
																<br />
																<span class='text-muted'><small>".$row2['email']."</small></span>
															</div>

															
														</div>
													</li>
												</ul>
											</div>
										</div>
									</div>
										
										
									  
									</div>
								</div>
								

							</div>
							<div class='modal-footer'>
								<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
								<!--<button type='button' class='btn btn-primary'>Save changes</button>-->
							</div>
						  </div>
						</div>
						</div>
					";
			}
		}
		
	}

?>
<script>
	function trasnfer() {
		var r = confirm("Are you sure you want to transfer ownership ?!");
		if (r == true) {
			document.getElementById("trasnferbutton").click();
		}
	}
	function tooLow(x, y,z)
	{
		var price = document.getElementById("inputpricemodal"+z).value;
		
		if(price > (x+y))
		{
			document.getElementById("increasebidmodalhidden"+z).click();
		}else
		{
			alert("Bid must be greater than "+(x+y));
		}
	}
</script>


<script>
// Set the date we're counting down to
  //get from p date(id) and size of row
  var countDownDate = new Date("Jan 5, 2019 15:37:25").getTime();
	var mm=0;
	
// Update te count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  for (i = 1; i < 20; i++) {
	  var now = new Date().getTime();
	  var name = "endDatex"+i;
	  var name2 = "demox"+i;
		countDownDate = new Date(""+document.getElementById(name).textContent).getTime(); 
	  // Find the distance between now and the count down date
	  var distance = countDownDate - now;

	  // Time calculations for days, hours, minutes and seconds
	  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
	  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

	  // Display the result in the element with id="demo"
	  document.getElementById(name2).innerHTML = days + ":" + hours + ":"
	  + minutes + ":" + seconds;

	  // document.getElementById("demo").innerHTML = ""+ document.getElementById("endDate").textContent;
	  // If the count down is finished, write some text 
	  if (distance < 0) {
		clearInterval(x);
		document.getElementById(name2).innerHTML = "EXPIRED";
	  }
  }
}, 1000);
</script>

<script>
// Set the date we're counting down to
  //get from p date(id) and size of row
  var countDownDate1 = new Date("Jan 5, 2019 15:37:25").getTime();
	var mm1=0;
	
// Update te count down every 1 second
var x1 = setInterval(function() {

  // Get todays date and time
  for (i = 1; i < 20; i++) {
	  var now = new Date().getTime();
	  var name = "endDate1"+i;
	  var name2 = "demo1"+i;
		countDownDate1 = new Date(""+document.getElementById(name).textContent).getTime(); 
	  // Find the distance between now and the count down date
	  var distance = countDownDate1 - now;

	  // Time calculations for days, hours, minutes and seconds
	  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
	  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

	  // Display the result in the element with id="demo"
	  document.getElementById(name2).innerHTML = days + ":" + hours + ":"
	  + minutes + ":" + seconds;

	  // document.getElementById("demo").innerHTML = ""+ document.getElementById("endDate").textContent;
	  // If the count down is finished, write some text 
	  if (distance < 0) {
		clearInterval(x1);
		document.getElementById(name2).innerHTML = "EXPIRED";
	  }
  }
}, 1000);
</script>