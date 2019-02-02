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
	
	//$sql = "UPDATE users SET name =".$_REQUEST['name']." ,email =".$_REQUEST['email']." ,description=".$_REQUEST['description'].", username=".$_REQUEST['username'].", address=".$_REQUEST['address'].", zipcode=".$_REQUEST['zipcode'].", city=".$_REQUEST['city'].", country =".$_REQUEST['country']." WHERE users.id =".$_REQUEST['myId'];  //update on your bid
	//$sql = "UPDATE `users` SET `name` = '".$_REQUEST['name']."',`email` =`".$_REQUEST['email']."`,`description` =`".$_REQUEST['description']."`,`username` =`".$_REQUEST['username']."`,`address` =`".$_REQUEST['address']."`,`zipcode` =`".$_REQUEST['zipcode']."`,`city` =`".$_REQUEST['city']."`,`country` =`".$_REQUEST['country']."` WHERE `users`.`id` = ".$_REQUEST['myId']."";
	
	
	$result = mysqli_query($conn, "UPDATE `users` SET `name` = '".$_REQUEST['name']."',`email` = '".$_REQUEST['email']."',`description` = '".$_REQUEST['aboutme']."',`username` = '".$_REQUEST['username']."',`address` = '".$_REQUEST['address']."',`zipcode` = '".$_REQUEST['zipcode']."',`city` = '".$_REQUEST['city']."',`country` = '".$_REQUEST['country']."' WHERE `users`.`id` = ".$_REQUEST['myId']."");
	
	header("Location: ".$_REQUEST['prevlink']);
	//echo $_REQUEST['prevlink'];
	exit();
?>