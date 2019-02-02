<?php
	include 'conn.php';
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$userID=0;
	function setUserId($userid=0)
	{
		$userID=$userid;
	}
	
	function picture_profile($id=0)
	{
		
		$userID=$id;
		
		$sql = "SELECT * FROM users WHERE id=".$userID;  //SHOW auctions only for the current owner
		$conn = $GLOBALS['conn'];   //accsess global connection to database
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) 
		{
			$row = mysqli_fetch_assoc($result);
			echo"
				<div class='col-lg-4 col-md-5'>
					<div class='card card-user'>
						<div class='image'>
							<img src='assets/img/background.jpg' alt='...'/>
						</div>
						<div class='content'>
							<div class='author'>
							  <a href='#updateImage' data-toggle='modal'> <img class='avatar border-white' src='".$row['avatar']."' alt='...'/></a>
							  <br>
							  <br>
							  <br>
							  <h4 class='title'>".$row['name']."<br />
								 <a href='#'><small>".$row['email']."</small></a>
							  </h4>
							</div>
							<p class='description text-center'>
								".$row['description']."
							</p>
						</div>
						<hr>
						<div class='text-center'>
							<div class='row'>
								<div class='col-md-3 col-md-offset-1'>
									<h5>".$row['cattleNo']."<br /><small>Cattle</small></h5>
								</div>
								<div class='col-md-4'>
									<h5>".$row['bidsNo']."<br /><small>Bids</small></h5>
								</div>
								<div class='col-md-3'>
									<h5>".$row['auctionNo']."<br /><small>Auctions</small></h5>
								</div>
							</div>
						</div>
					</div>
				</div>
				";
		}else
		{
				echo " error fetching user details";
		}
		
	}
	
	function updateImage($userID){
	

	//$conn = $GLOBALS['conn'];
	//$query=mysqli_query($conn,"select * from `users` where id=".$userID);
    echo "
    <div class='modal fade' id='updateImage' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <center><h4 class='modal-title' id='myModalLabel'>Delete cow</h4></center>
                </div>
                <div class='modal-body'>
				<div class='container-fluid'>
				<form method='POST' action='updateImage.php' enctype='multipart/form-data'>
				
					<br>
					<div class='row'>
						<div class='col-lg-2'>
						</div>

						<div class='col-lg-10'>
						<input type='hidden' name='userID' value='".$userID."'>
						</div>

						<input type='file' name='avatar'>


					</div>



                </div> 
				</div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-default' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancel</button>
                    <button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-floppy-disk'></span>Save</a>
				</form>
                </div>
				
            </div>
        </div>
    </div>


    	";
    
}

	
	function personal_details($id=0)
	{
		$userID=$id;
		
		$sql = "SELECT * FROM users WHERE id=".$userID;  //SHOW auctions only for the current owner
		$conn = $GLOBALS['conn'];   //accsess global connection to database
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) 
		{
			$row = mysqli_fetch_assoc($result);
		
				echo "
				
					 <div class='col-lg-8 col-md-7'>
								<div class='card'>
									<div class='header'>
										<h4 class='title'>Edit Profile</h4>
									</div>
									<div class='content'>
										<form  action='updateUserProfile.php' method='post'>
											<input type='hidden' value='".$_SERVER['REQUEST_URI']."' name='prevlink'/>
											<div class='row'>
												<div class='col-md-5'>
													<div class='form-group'>
														<label>User Id</label>
														<input type='text' class='form-control border-input' disabled placeholder='id' name='userId' value='".$row['id']."'>
														<input type='hidden' name='myId' value=".$userID.">
													</div>
												</div>
												<div class='col-md-3'>
													<div class='form-group'>
														<label>Name</label>
														<input id='input1' type='text' class='form-control border-input' placeholder='username' name='username' value='".$row['username']."'>
													</div>
												</div>
												<div class='col-md-4'>
													<div class='form-group'>
														<label for='exampleInputEmail1'>Email address</label>
														<input type='email' class='form-control border-input' placeholder='Email' name='email' value='".$row['email']."'>
													</div>
												</div>
											</div>

											<div class='row'>
												<div class='col-md-12'>
													<div class='form-group'>
														<label>First Name</label>
														<input type='text' class='form-control border-input' placeholder='name' name='name' value='".$row['name']."'>
													</div>
												</div>
											</div>

											<div class='row'>
												<div class='col-md-12'>
													<div class='form-group'>
														<label>Address</label>
														<input type='text' class='form-control border-input' placeholder='Home Address' name='address' value='".$row['address']."'>
													</div>
												</div>
											</div>

											<div class='row'>
												<div class='col-md-4'>
													<div class='form-group'>
														<label>City</label>
														<input type='text' class='form-control border-input' placeholder='City' name='city' value='".$row['city']."'>
													</div>
												</div>
												<div class='col-md-4'>
													<div class='form-group'>
														<label>Country</label>
														<input type='text' class='form-control border-input' placeholder='Country' name='country' value='".$row['country']."'>
													</div>
												</div>
												<div class='col-md-4'>
													<div class='form-group'>
														<label>Postal Code</label>
														<input type='number' class='form-control border-input' placeholder='ZIP Code' name='zipcode' value='".$row['zipcode']."'>
													</div>
												</div>
											</div>

											<div class='row'>
												<div class='col-md-12'>
													<div class='form-group'>
														<label>About Me</label>
														<textarea rows='5' class='form-control border-input' placeholder='Here can be your description' name='aboutme'>".$row['description']."</textarea>
													</div>
												</div>
											</div>
											<div class='text-center'>
												<button onclick='editprofile()'  class='btn btn-info btn-fill btn-wd'>edit</button>
												<button type='submit' class='btn btn-info btn-fill btn-wd'>Update Profile</button>
											</div>
											<div class='clearfix'></div>
										</form>
										
									</div>
								</div>
							</div>
				
				";
		}
		else{
				echo " errror loading personal details";
		}
	}
	
?>

<script>
function editprofile() {
    var x = document.getElementsByClassName("input1").disabled =false;
	
}
</script>