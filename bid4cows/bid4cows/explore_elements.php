<?php
    include 'conn.php';

	// Create connection
	
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	function filter_data($location='all', $price='lowtohigh' , $type='any' ,$foodType='any')
	{
		$conn = $GLOBALS['conn'];   //accsess global connection to database
		
		
		echo "
		<div class='col-lg-12 col-sm-6'>
			<div class='card'>
				<div class='content'>
					<form method='post' action='explore.php'>
					  <select class='btn btn-primary' name='locations'>
						<option value=''>Location</option>
						<option value='Cape Town'>Cape Town</option>
						<option value='Kwazulu Natal'>Kwazulu Natal</option>
						<option value='Free State'>Free State</option>
						<option value='Gauteng'>Gauteng</option>
						<option value='Limpopo'>Limpopo</option>
						<option value='Mpumalanga'>Mpumalanga</option>
					  </select>
					  <select class='btn btn-primary' name='types'>
						<option value=''>Type</option>
						<option value='Nguni'>Nguni</option>
						<option value='Angus'>Angus</option>
						<option value='Jersey'>Jersey</option>
						<option value='Belgian Blue'>Belgian Blue</option>
						<option value='Highland'>Highland</option>
						<option value='Short Horn'>Short Horn</option>
					  </select>
					  <select class='btn btn-primary' name='prices'>
						<option value=''>Price</option>
						<option value='high'>Low to High</option>
						<option value='low to Low'>High to Low</option>
					  </select>
					  <select class='btn btn-primary' name='ages'>
						<option value=''>Age</option>
						<option value='0-5'>0-5</option>
						<option value='6'>6</option>
						<option value='7'>7</option>
						<option value='8'>8</option>
						<option value='9+'>9+</option>
					  </select>
					  
					  <input type='submit' class='btn btn-info btn-fill btn-wd' value='Filter'/>
					</form>
				</div>
			</div>
		</div>
		<br>
		";
		
	}
	
	function display_explore($header_name="all",$id=0,$locations="all",$types="all", $age="all", $price="all", $limit=4 ,$fil=0)
	{
		$userID = $id;
		$todayDate = date("Y-m-d h:i:sa");
		if($fil ==0 )
		{
			if($header_name=="latest")
			{
				$sql = "SELECT * FROM auction WHERE (ownerID !=".$userID." AND endDate > '$todayDate') ORDER BY id ASC LIMIT 4";  //SHOW auctions only for the current owner
				
			}elseif($header_name=="highest") //show with highest price
			{
				$sql = "SELECT * FROM auction WHERE (ownerID !=".$userID." AND endDate > '$todayDate') ORDER BY price DESC LIMIT 4"; 
				
			}elseif($header_name=="lowest") //show lowest price
			{
				$sql = "SELECT * FROM auction WHERE (ownerID !=".$userID." AND endDate > '$todayDate') ORDER BY price ASC LIMIT 4"; 
				
			}elseif($header_name=="lessTime") //show almost closing bids
			{
				$sql = "SELECT * FROM auction WHERE (ownerID !=".$userID." AND endDate > '$todayDate') ORDER BY endDate ASC LIMIT 4"; 
				
			}else
			{
				$sql = "SELECT * FROM auction WHERE (ownerID !=".$userID." AND endDate > '$todayDate') ORDER BY id ASC"; 
			}
		}else
		{
				//filter data
				$locsql="";
				$typesql="";
				$agesql="";
				$pricesql="";
				
				if($locations!=""){
					$locsql = " AND location ='".$locations."'";
				}
				if($types!=""){
					$typesql = " AND type='".$types."'";
				}
				if($age!=""){
					$agesql = " AND age='".$ages."'";
				}
				if($price!="all"){
					if($price=="high"){
						$pricesql = "DESC";
					}else{
						$pricesql = "ASC";
					}
				}
				$sql = "SELECT * FROM auction WHERE ( `ownerID`!=".$userID." AND endDate > '".$todayDate."' ".$locsql." ".$typesql." ".$agesql.") ORDER BY price ".$pricesql.""; 
				//(ownerID !=".$userID." AND endDate > ".$todayDate."".$locsql."".$typesql."".$agesql.")
				//echo $sql;
		}
		$conn = $GLOBALS['conn'];   //accsess global connection to database
		$result = mysqli_query($conn, $sql);
		
		
		echo "
		<p>".$header_name."</p>
				<br>
					<div class='row'>
					";
					if (mysqli_num_rows($result) > 0) 
					{
						// output data of each row
						while($row = mysqli_fetch_assoc($result)) 
						{
							$endDate = strtotime($row['endDate']. " 00:00:0.0");
							//<p id='date".$row['id']."' style='display:none;'>".row['endDate']."</p>
							$ai = $row['id'];
							$sql2 = "SELECT id FROM bids WHERE auctionID = '$ai' and userID = '$userID'";
							$result2 = mysqli_query($conn,$sql2);
	  
					if($result2){

					if(mysqli_num_rows($result2) == 0){
							
							echo "
								
								<div class='col-lg-3 col-sm-6'>
								
								    <div class='card'>
										<div class='content'>
											<a href='' data-toggle='modal' data-target='#expauction".$header_name."Modal". $row["id"]."'>
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
													<a href='#' data-toggle='collapse' class='text-center'>
														<i class='ti-money'></i>
													</a>
												</div>
											</div>
											<div>
												
												<form action='makeBid.php' method='post'>
													<div class='row'>	
														<div class='form-group' class='text-center' style='margin-left:20%;margin-right:20%;'>
															<input type='hidden' value='".$_SERVER['REQUEST_URI']."' name='prevlink'/>
															<input type='hidden' value='".$row['id']."' name='auctionID'/>
															<input type='hidden' value='".$row['cowID']."' name='cowID'/>
															<input type='hidden' value='".$userID."' name='bidderID'/>
															<input type='hidden' value='".$row['endDate']."' name='endDate'/>
															<p>Min increment</p>
															<input type='text' id='inputpricemodal2".$row['id']."' name='priceInc' class='form-control border-input' placeholder='".$row['minimum']."' value=''>
														</div>
														<div class='text-center'>
															<btn onclick='tooLow2(".$row['minimum'].",".$row['price'].",".$row['id'].")' class='btn btn-info btn-fill btn-wd'>Bid</btn>
															<button type='submit' id='increasebidmodalhidden2".$row['id']."' style='display:none;'>
														</div>
														<div class='clearfix'></div>
													</div>
												</form>
												 
											</div>
										</div>
									</div>
								</div>
								";
					}
					}
						}
					}else
					{
							echo "
								<div class='typo-line'>
                                    <p class='category'>OPPSY</p>
                                    <blockquote>
                                     <p>
									 No results found.
                                     </p>
                                     <small>
                                     No cattle on auction
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
	
	function modal_explore_auctions($header_name="all", $id=0, $para=0)
	{
		$userID=$id;
		$inc = $para;
		$sql = "SELECT * FROM auction WHERE ownerID !=".$userID;
		$countx =0;
		
		$conn = $GLOBALS['conn'];   //accsess global connection to database
		$result = mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($result) > 0) 
		{
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) 
			{
				$endDate = strtotime($row['endDate']);
				
				$ai = $row['id'];
				$sql2 = "SELECT id FROM bids WHERE auctionID = '$ai' and userID = '$userID'";
				$result2 = mysqli_query($conn,$sql2);
	  
if($result2){

					if(mysqli_num_rows($result2) == 0){
						$countx = $countx +1;
						$para = $para +1;
						echo "
					
								<!-- Modal -->
								<div class='modal fade' id='expauction".$header_name."Modal". $row["id"]."' role='dialog' >
								<div class='modal-dialog modal-md-10'>   
								  <!-- Modal content-->
								  <div class='modal-content'>
									<div class='modal-header'>
									  <button type='button' class='close' data-dismiss='modal'>&times;</button>
									  <!--<h4 class='modal-title'>R20'000</h4>-->
									  <img class='card-img-top' src='".$row['image1']."' alt='cow image' style='width:10%;height:10%;'>
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
																			<p>Price on</p>
																			<p>Auction</p>
																			<br>
																			R". $row["price"]."
																		</div>
																	</div>
																</div>
																<div class='footer'>
																	<hr />
																	<div class='stats'>
																		<a href='#' data-toggle='collapse' data-target='#morePriceHourBid". $row["id"]."'>
																			
																		</a>
																	</div>
																</div>
																<div id='morePriceHourBid". $row["id"]."' class='collapse'>
																	
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
																			<i class='ti-money'></i>
																		</div>
																	</div>
																	<div class='col-xs-7'>
																		<div class='numbers'>
																			<p>BID</p>
																		</div>
																	</div>
																</div>
																<div class='footer'>
																	<hr />
																</div>
																<div>
																	<form action='makeBid.php' method='post'>
																		<div class='row'>	
																			<div class='form-group' class='text-center' style='margin-left:20%;margin-right:20%;'>
																				<input type='hidden' value='".$_SERVER['REQUEST_URI']."' name='prevlink'/>
																				<input type='hidden' value='".$row['id']."' name='auctionID'/>
																				<input type='hidden' value='".$row['cowID']."' name='cowID'/>
																				<input type='hidden' value='".$userID."' name='bidderID'/>
																				<input type='hidden' value='".$row['endDate']."' name='endDate'/>
																				<p>Min Increment</p>
																				<input type='text' id='inputpricemodal".$row['id']."' name='priceInc' class='form-control border-input' placeholder='".$row['minimum']."' value=''>
																			</div>
																			<div class='text-center'>
																				<btn onclick='tooLow(".$row['minimum'].",".$row['price'].",".$row['id'].")' class='btn btn-info btn-fill btn-wd'>Bid</btn>
																				<button type='submit' id='increasebidmodalhidden".$row['id']."' style='display:none;'>
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
																		<p>End Date</p>
																		<p>dd:hh:mm:ss</p>
																		<!--<p id='endDate".$para."' class='countdown' style='display:none;'>".$row['endDate']."</p>
																		<h4 id='demo".$para."' class='countdown' style='font-size=14px;'></h4>-->
																		<h4 class='countdown' style='font-size=14px;'>".$row['endDate']."</h4>
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
																			";


																			$resultxx  = mysqli_query($conn, "select * from details where cowID =".$row['cowID']." ");
																			$rowxx = mysqli_fetch_array($resultxx,MYSQLI_ASSOC);
																			

																			echo"

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
																	
																	food type :".$rowxx['foodType']." <br>
																	Previous Owner :".$rowxx['previousOwner']." <br>
																	Ancestor :".$rowxx['uncestors']." <br> 
																	<imge src=".$rowxx['image']."><br>

																	


															<div class='slideshow-container'>

															<div class='mySlides '>
															  <img src=".$rowxx['image1']." style='width:100%'>
															  <div class='text'>Image One</div>
															</div>

															<div class='mySlides '>
															  <img src=".$rowxx['image']." style='width:100%'>
															  <div class='text'>Image Two</div>
															</div>

															</div>
															<br>

															<div style='text-align:center'>
															  <span class='dot' onclick='currentSlide(1)'></span> 
															  <span class='dot' onclick='currentSlide(2)'></span> 
															  <span class='dot' onclick='currentSlide(3)'></span> 
															</div>





																</div>
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
					echo "<p id='countvalue' style='display:none'>".$countx."</p>";
				}
			}
		}
		
		return $para;
			
	}
	
	
?>

<script>

	function tooLow(x, y,z)
	{
		var price = document.getElementById("inputpricemodal"+z).value;
		
		if(price > (x+y))
		{
			document.getElementById("increasebidmodalhidden"+z).click();
		}else
		{
			alert("Bid must be greater than "+(x+y)+" you input "+price);
		}
	}
	function tooLow2(x, y,z)
	{
		var price = document.getElementById("inputpricemodal2"+z).value;
		
		if(price > (x+y))
		{
			document.getElementById("increasebidmodalhidden2"+z).click();
		}else
		{
			alert("Bid must be greater than "+(x+y)+" you input "+price);
		}
	}
</script>

<script>
// Set the date we're counting down to
  //get from p date(id) and size of row
  var countDownDate = new Date("Jan 5, 2019 15:37:25").getTime();

	
// Update te count down every 1 second
var x2 = setInterval(function() {

  // Get todays date and time
  for (i = 1; i < 10; i++) {
	  var now = new Date().getTime();
	  var name = "endDate"+i;
	  var name2 = "demo"+i;
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
		clearInterval(x2);
		document.getElementById(name2).innerHTML = "EXPIRED";
	  }
  }
}, 1000);
</script>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 1; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>