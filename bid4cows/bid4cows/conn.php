<?php
 
//MySQLi Procedural
$conn = mysqli_connect("localhost","root","","bid4cows");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
 
?>