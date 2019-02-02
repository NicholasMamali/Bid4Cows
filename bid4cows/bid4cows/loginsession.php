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
	
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($conn,$_POST['email']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
      
      $sql = "SELECT id FROM users WHERE email = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
	  
	  if($result){
		  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		  //$active = $row['active'];
		  
		  $count = mysqli_num_rows($result);
		  
		  // If result matched $myusername and $mypassword, table row must be 1 row
			
		  if($count == 1) {
			  
			 $_SESSION['user'] = $row['id'];
			 header("location: dashboard.php");
			 
		  }else {
			 header("Location:loginpage.php");
		  }
	  }
	  else{
		  header("Location:loginpage.php");
	  }
   }
	exit();
?>