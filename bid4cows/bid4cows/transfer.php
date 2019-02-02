<?php
	$servername = "localhost";
	$username = "root";
	$password = null;
	$dbname = "bid4cows";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	$sql = "UPDATE cattle SET ownerID = ".$_REQUEST['newOwner']." WHERE cattle.id =".$_REQUEST['cowID']; 
	$result = mysqli_query($conn, $sql);  //Change ownership of cow to new ownerID
	
	//remove auction from auctions and all bids related to it.
	$sql = "DELETE FROM auction WHERE auction.id =".$_REQUEST['auctionID'];
	$result = mysqli_query($conn, $sql);
	$sql = "DELETE FROM bids WHERE bids.auctionID =".$_REQUEST['auctionID'];
	$result = mysqli_query($conn, $sql);
	
	header("Location: ".$_REQUEST['prevlink']);
	echo $_REQUEST['prevlink'];
	exit();
?>