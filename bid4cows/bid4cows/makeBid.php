<?php
	include 'conn.php';
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	
	$result = mysqli_query($conn, "select * from bids where bids.userID =".$_REQUEST['bidderID']." and bids.auctionID=".$_REQUEST['auctionID']." ");
	
	if( mysqli_num_rows($result) == 0 )
	{
		$sql = "INSERT INTO bids (id, auctionID, userID,cattleID, price,highestID) VALUES (NULL, ".$_REQUEST['auctionID'].", ".$_REQUEST['bidderID'].",".$_REQUEST['cowID']." , ".$_REQUEST['priceInc'].", ".$_REQUEST['bidderID'].")";  //create new bid object
		$result = mysqli_query($conn, $sql);
		
		$result = mysqli_query($conn, "UPDATE `bids` SET `endDate` = '".$_REQUEST['endDate']."', `highestID`=".$_REQUEST['bidderID']." WHERE (`bids`.`auctionID` = ".$_REQUEST['auctionID'].")");

		//uppdate auction price and highest id
		$sql = "UPDATE auction SET price =".$_REQUEST['priceInc']." WHERE auction.id =".$_REQUEST['auctionID'];  //update on your price on auction
		$sql2 = "UPDATE auction SET highestID =".$_REQUEST['bidderID']." WHERE auction.id =".$_REQUEST['auctionID'];  //update on highest ID
		
		$result = mysqli_query($conn, $sql);
		$result = mysqli_query($conn, $sql2);
		
		//update user bids
		$result  = mysqli_query($conn, "select * from users where id =".$_REQUEST['bidderID']." ");
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$bids= 1 + $row['bidsNo'];
		$result  = mysqli_query($conn,"update users set bidsNo=".$bids." where id=".$_REQUEST['bidderID']."");
		
		//update bid count for auction
		$result  = mysqli_query($conn, "select * from auction where id =".$_REQUEST['auctionID']." ");
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$bids= 1 + $row['bidCount'];
		$result  = mysqli_query($conn,"update auction set bidCount=".$bids." where id=".$_REQUEST['auctionID']."");
		
		//update bid price for auction
		//$result  = mysqli_query($conn, "select * from price where auctionID =".$row['auctionID']." ");
		//$row = mysqli_fetch_array($resultxx,MYSQLI_ASSOC);
	}
	
	///header("Location: ".$_REQUEST['prevlink']);
	header("Location:dashboard.php");
	echo $_REQUEST['prevlink'];
	exit();
?>