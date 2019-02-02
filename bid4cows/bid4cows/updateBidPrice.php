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
	
	$sql = "UPDATE bids SET price =".$_REQUEST['priceInc']." WHERE bids.id =".$_REQUEST['bidID'];  //update on your bid
	$result = mysqli_query($conn, $sql);
	//update highest on all bids
	$sql = "UPDATE bids SET highestID =".$_REQUEST['bidderID']." WHERE auctionID =".$_REQUEST['auctionID'];  //update on your bid
	$result = mysqli_query($conn, $sql);
	
	//uppdate auction price and highest id
	$sql = "UPDATE auction SET price =".$_REQUEST['priceInc']." WHERE auction.id =".$_REQUEST['auctionID'];  //update on your price on auction
	$sql2 = "UPDATE auction SET highestID =".$_REQUEST['bidderID']." WHERE auction.id =".$_REQUEST['auctionID'];  //update on highest ID
	
	//increemnt bids
	//update bid count for auction
		$result  = mysqli_query($conn, "select * from auction where id =".$_REQUEST['auctionID']." ");
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$bids= 1 + $row['bidCount'];
		$result  = mysqli_query($conn,"update auction set bidCount=".$bids." where id=".$_REQUEST['auctionID']."");
	
	$result = mysqli_query($conn, $sql);
	$result = mysqli_query($conn, $sql2);
	
	header("Location: ".$_REQUEST['prevlink']);
	echo $_REQUEST['prevlink'];
	exit();
?>