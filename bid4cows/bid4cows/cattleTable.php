<?php

include 'conn.php';

function display_table($userID=20)
{
	$conn = $GLOBALS['conn'];
	$query=mysqli_query($conn,"select * from `cattle` where ownerID=".$userID);
	echo "

					<div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                

                            <td><a href='#addcow' data-toggle='modal' class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Add</a></td>


                            </div>
                            <div class='content table-responsive table-full-width'>
                                <table class='table table-striped'>
                                    <thead>
                                        <th>Name</th>
                                    	<th>Age</th>
                                    	<th>Description</th>
                                    	<th>Adress</th>
                                    	<th>Update</th>

                                    	<th>Image</th>
                                    </thead>
                                    <tbody>
                                    ";
                                    while($row=mysqli_fetch_array($query))
                                    {
                                    	echo "
                                        <tr>
                                        	<td>".$row['name']."</td>
                                        	<td>".$row['age']."</td>
                                        	<td>".$row['description']."</td>
                                        	<td>".$row['address']."</td>

                                        	
                                        	<td><a href='#editcow".$row['id']."'data-toggle='modal' class='btn btn-warning'><span class='glyphicon glyphicon-edit'></span> Edit</a></td>



                                        	<td> <a href='#delete".$row['id']."' data-toggle='modal' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span> Delete</a>
                                        	</td>";


                                        	


                                        	$querytemp = mysqli_query($conn,"select * from `auction` where cowID =".$row['id']);


                                        	if (mysqli_num_rows($querytemp)!=0)
                                        	{ 
                                        		echo"
                                        		<td>


												<span class='pull-left'><a href='#remove".$row['id']."' data-toggle='modal' class='btn btn-primary'>
												Remove<br>Auction</a></span>'</td>";


                                        		;



                                        	}

                                        	else
                                        	{
                                        		echo "
                                        		<td>

							<span class='pull-left'><a href='#auction".$row['id']."' data-toggle='modal' class='btn btn-primary'>
							<span class='glyphicon glyphicon-plus'></span>Make<br>Auction</a></span>'</td>


                                        		";

                                        	}






                                        	echo"
                                             
                                        	<td>
                                        	<img src=".$row['image1']." alt='Avatar' class='avatar'>
                                        	</td>
                                        </tr>
                                        ";
                                    }
                                     echo"
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

	";
}

function displayTableEditModal($userID=20)
{
	$conn = $GLOBALS['conn'];
	$query=mysqli_query($conn,"select * from `cattle` where ownerID=".$userID);

	while($row=mysqli_fetch_array($query))
    {
    	echo "

    <div class='modal fade' id='editcow".$row['id']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <center><h4 class='modal-title' id='myModalLabel'>Edit cow</h4></center>
                </div>
                <div class='modal-body'>
				<div class='container-fluid'>
				<form method='POST' action='crud.php' enctype='multipart/form-data'>
					<div class='row'>

						<div class='col-lg-2'>
							<label class='control-label' style='position:relative; top:7px;'>Name:</label>
						</div>
						<div class='col-lg-10'>
							<input type='text' class='form-control' name='name' value='".$row['name']."'>
						</div>
					</div>
					<div style='height:10px;'></div>
					<div class='row'>
						<div class='col-lg-2'>

							<label class='control-label' style='position:relative; top:7px;'>Age:</label>
						</div>
						<div class='col-lg-10'>
							<input type='text' class='form-control' name='age' value='".$row['age']."'>
						</div>
					</div>


										<div class='row'>
						<div class='col-lg-2'>

							<label class='control-label' style='position:relative; top:7px;'>food Type:</label>
						</div>
						<div class='col-lg-10'>
							<input type='text' class='form-control' name='foodType' required value='".$row['foodType']."'>
						</div>
					</div>

			




					<div style='height:10px;'></div>


					<div class='row'>
						<div class='col-lg-2'>

							<label class='control-label' style='position:relative; top:7px;'>previous Owner:</label>
						</div>
						<div class='col-lg-10'>
							<input type='text' class='form-control' name='previousOwner' required value='".$row['previousOwner']."'>
						</div>
					</div>




				<div style='height:10px;'></div>


					<div class='row'>
						<div class='col-lg-2'>

							<label class='control-label' style='position:relative; top:7px;'>uncestors:</label>
						</div>
						<div class='col-lg-10'>
							<input type='text' class='form-control' name='uncestors' required value='".$row['uncestors']."'>
						</div>
					</div>




				<div style='height:10px;'></div>


					<div class='row'>
						<div class='col-lg-2'>

							<label class='control-label' style='position:relative; top:7px;'>Type:</label>
						</div>
						<div class='col-lg-10'>
							<input type='text' class='form-control' name='time' required value='".$row['type']."'>
						</div>
					</div>















					<div style='height:10px;'></div>
					<div class='row'>
						<div class='col-lg-2'>
							<label class='control-label' style='position:relative; top:7px;'>Address:</label>
						</div>
						<div class='col-lg-10'>
							<input type='text' class='form-control' name='address' value='".$row['address']."''>
						</div>
					</div>

					<br>
					<div class='row'>
						<div class='col-lg-2'>
							<label style='position:relative; top:7px;'>Description:</label>
						</div>
						<div class='col-lg-10'>
							<input type='text' name='description' class='form-control' placeholder='uncestors,previous owner,speciatial skills' value='".$row['description']." '>
						</div>
					</div>





					<br>
					<div class='row'>
						<div class='col-lg-2'>
							<label style='position:relative; top:7px;'>Image:</label>
						</div>

						<div class='col-lg-10'>

						<input type='file' name='avatar' class='form-control' value='".$row['image']."'>

						<input type='hidden' value='update' name='crud'>
						<input type='hidden' name='ownerID' value='".$row['ownerID']."'>
						<input type='hidden' name='id' value='".$row['id']."'>





						</div>
					</div>



                </div> 
				</div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-default' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancel</button>
                    <button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-floppy-disk'></span> Save</a>
				</form>
                </div>
				
            </div>
        </div>
    </div>


    	";
    }
}







function displayTableAddModal($userID=20)
{

    echo "

    <div class='modal fade' id='addcow' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <center><h4 class='modal-title' id='myModalLabel'>Add cow</h4></center>
                </div>
                <div class='modal-body'>
				<div class='container-fluid'>


				<form method='POST' action='crud.php' enctype='multipart/form-data'>
					<div class='row'>
						<div class='col-lg-2'>
							<label class='control-label' style='position:relative; top:7px;'>Name:</label>
						</div>
						<div class='col-lg-10'>
							<input type='text' class='form-control' name='name' required >
						</div>
					</div>
					<div style='height:10px;'></div>
					<div class='row'>
						<div class='col-lg-2'>

							<label class='control-label' style='position:relative; top:7px;'>Age:</label>
						</div>
						<div class='col-lg-10'>
							<input type='text' class='form-control' name='age' required>
						</div>
					</div>

					<div class='row'>
						<div class='col-lg-2'>

							<label class='control-label' style='position:relative; top:7px;'>food Type:</label>
						</div>
						<div class='col-lg-10'>
							<input type='text' class='form-control' name='foodType' required>
						</div>
					</div>


					<div style='height:10px;'></div>


					<div class='row'>
						<div class='col-lg-2'>

							<label class='control-label' style='position:relative; top:7px;'>previous Owner:</label>
						</div>
						<div class='col-lg-10'>
							<input type='text' class='form-control' name='previousOwner' required>
						</div>
					</div>




				<div style='height:10px;'></div>


					<div class='row'>
						<div class='col-lg-2'>

							<label class='control-label' style='position:relative; top:7px;'>uncestors:</label>
						</div>
						<div class='col-lg-10'>
							<input type='text' class='form-control' name='uncestors' required>
						</div>
					</div>



					<div class='row'>
						<div class='col-lg-2'>

							<label class='control-label' style='position:relative; top:7px;'>Type:</label>
						</div>
						<div class='col-lg-10'>
							<input type='text' class='form-control' name='type' required value='nguni'>
						</div>
					</div>






					<div style='height:10px;'></div>
					<div class='row'>
						<div class='col-lg-2'>
							<label class='control-label' style='position:relative; top:7px;'>Address:</label>
						</div>
						<div class='col-lg-10'>
							<input type='text' class='form-control' name='address' required>
						</div>
					</div>

					<br>
					<div class='row'>
						<div class='col-lg-2'>
							<label style='position:relative; top:7px;'>Description:</label>
						</div>
						<div class='col-lg-10'>
							<input type='text' name='description' class='form-control' placeholder='uncestors,previous owner,speciatial skills' required>
						</div>
					</div>





					<br>
					<div class='row'>
						<div class='col-lg-2'>
							<label style='position:relative; top:7px;'>Image:</label>
						</div>

						<div class='col-lg-10'>

						<input type='file' name='avatar' accept='image/*' class='form-control' value='image1'>

						<input type='file' name='avatar2' accept='image/*' class='form-control' value='image2'>







						<input type='hidden' value='create' name='crud'>
						<input type='hidden' name='ownerID' value='".$userID."'>
						<input type='hidden' name='id' value='".$row['id']."'>





						</div>
					</div>



                </div> 
				</div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-default' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancel</button>
                    <button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-floppy-disk'></span> Save</a>
				</form>
                </div>
				
            </div>
        </div>
    </div>


    	";
}

//deleteModal



function displayTableDeleteModal($userID=20)
{
	$conn = $GLOBALS['conn'];
	$query=mysqli_query($conn,"select * from `cattle` where ownerID=".$userID);

	while($row=mysqli_fetch_array($query))
    {
    	echo "

    <div class='modal fade' id='delete".$row['id']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <center><h4 class='modal-title' id='myModalLabel'>Delete cow</h4></center>
                </div>
                <div class='modal-body'>
				<div class='container-fluid'>
				<form method='POST' action='crud.php'>
					
	
			





					<br>
					<div class='row'>
						<div class='col-lg-2'>
							<label style='position:relative; top:7px;'>Image:".$row['name']."</label>
						</div>

						<div class='col-lg-10'>


						<input type='hidden' value='delete' name='crud'>
						<input type='hidden' name='ownerID' value='".$row['ownerID']."'>
						<input type='hidden' name='id' value='".$row['id']."'>





						</div>
					</div>



                </div> 
				</div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-default' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancel</button>
                    <button type='submit' class='btn btn-danger'><span class='glyphicon glyphicon-floppy-disk'></span> Delete</a>
				</form>
                </div>
				
            </div>
        </div>
    </div>


    	";
    }
}







function displayTableAuctionModal($userID=20)
{
	$conn = $GLOBALS['conn'];
	$query=mysqli_query($conn,"select * from `cattle` where ownerID=".$userID);
	$querytemp = mysqli_query($conn,"select * from `auction`");


	while($row=mysqli_fetch_array($query))
    {
    	echo "

    <div class='modal fade' id='auction".$row['id']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <center><h4 class='modal-title' id='myModalLabel'>Make Auction</h4></center>
                </div>
                <div class='modal-body'>
				<div class='container-fluid'>
				<form method='POST' action='crud.php' enctype='multipart/form-data'>
					<div class='row'>

						<div class='col-lg-2'>
							<label class='control-label' style='position:relative; top:7px;'>Price</label>
						</div>
						<div class='col-lg-10'>
							<input type='text' class='form-control' name='price'>
						</div>
					</div>
					<div style='height:10px;'></div>
					<div class='row'>
						<div class='col-lg-2'>

							<label class='control-label' style='position:relative; top:7px;'>Minimum Bid:</label>
						</div>
						<div class='col-lg-10'>
							<input type='text' class='form-control' name='minimumBid'>
						</div>
					</div>
					<div style='height:10px;'></div>
					<div class='row'>
						<div class='col-lg-2'>
							<label class='control-label' style='position:relative; top:7px;'>End Date</label>
						</div>
						<div class='col-lg-10'>
							<input type='date' class='form-control' name='endDate'>
						</div>
					</div>

					<br>
					<div class='row'>
						<div class='col-lg-2'>
							<label style='position:relative; top:7px;'>Description:</label>
						</div>
						<div class='col-lg-10'>
							<input type='text' name='description' class='form-control' placeholder='uncestors,previous owner,speciatial skills' >
						</div>
					</div>





					<br>
					<div class='row'>
						<div class='col-lg-2'>
						</div>

						<div class='col-lg-10'>


						<input type='hidden' value='auction' name='crud'>
						<input type='hidden' name='ownerID' value='".$row['ownerID']."'>
						<input type='hidden' name='id' value='".$row['id']."'>
						<input type='hidden' name='location' value='".$row['address']."'>
						<input type='hidden' name='type' value='".$row['type']."'>

						<input type='hidden' name='image1' value='".$row['image']."'>
						<input type='hidden' name='image2' value='".$row['image1']."'>







						</div>
					</div>



					<div style='height:10px;'></div>






					<div class='row'>
						<div class='col-lg-10'>

							<label  style='position:center; top:7px; align:center'>Items To Display:</label>
							 <br>
							  <input type='checkbox' name='foodType' value='".$row['foodType']."'>Display foodType<br>
							  <br>
							  <input type='checkbox' name='previousOwner' value='".$row['previousOwner']."'>previous Owner<br>
							  <br>
							  <input type='checkbox' name='uncestors' value='".$row['uncestors']."'>Uncestors<br>


						</div>
						




					</div>





                </div> 
				</div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-default' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancel</button>
                    <button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-floppy-disk'></span> Save</a>
				</form>
                </div>
				
            </div>
        </div>
    </div>


    	";
    }
}



function displayTableRemoveAuctionModal($userID=20)
{
	$conn = $GLOBALS['conn'];
	$query=mysqli_query($conn,"select * from `cattle` where ownerID=".$userID);

	while($row=mysqli_fetch_array($query))
    {
    	echo "

    <div class='modal fade' id='remove".$row['id']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <center><h4 class='modal-title' id='myModalLabel'>Delete Auction</h4></center>
                </div>
                <div class='modal-body'>
				<div class='container-fluid'>
				<form method='POST' action='crud.php'>
					
	
			





					<br>
					<div class='row'>
						<div class='col-lg-2'>
							<label style='position:relative; top:7px;'>Are you sure?</label>
						</div>

						<div class='col-lg-10'>


						<input type='hidden' value='deleteAuction' name='crud'>
						<input type='hidden' name='ownerID' value='".$row['ownerID']."'>
						<input type='hidden' name='id' value='".$row['id']."'>

						</div>
					</div>



                </div> 
				</div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-default' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancel</button>
                    <button type='submit' class='btn btn-danger'><span class='glyphicon glyphicon-floppy-disk'></span> Delete</a>
				</form>
                </div>
				
            </div>
        </div>
    </div>


    	";
    }
}











?>