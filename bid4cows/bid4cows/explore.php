<!doctype html>
<html lang="en">

<?php 
include 'functions.php';
$user=0;


session_start();
if ( isset( $_SESSION['user'] ) ) {
	$user=$_SESSION['user'];
}
display_head();

	echo "<body><div class='wrapper'>";
display_sidebar("Explore");  //display side bar navigaition from the functions library, depending on who the user is
	echo "<div class='main-panel'>";
display_mainpanel_topnav("Explore",$user);
	echo "<div class='content'><div class='container-fluid'>";
	//this is the main panel where all the content will go
	//in this case, recent bids and activitis with notifications will be added here
				include 'explore_elements.php';
				filter_data();
				
				if($_SERVER["REQUEST_METHOD"] == "POST") {
      
				$locations = mysqli_real_escape_string($conn,$_POST['locations']);
				$types = mysqli_real_escape_string($conn,$_POST['types']); 
				$age = mysqli_real_escape_string($conn,$_POST['ages']); 
				$price = mysqli_real_escape_string($conn,$_POST['prices']);  
				
				display_explore("all",$user,$locations, $types, $age, $price,40,1);
				
				}
				else{
				display_explore("latest",$user,"all", "all", "all", "all",4,0);
				display_explore("highest",$user,"all", "all", "all", "all",4,0);
				display_explore("lowest",$user,"all", "all", "all", "all",4,0);
				display_explore("lessTime",$user,"all", "all", "all", "all",4,0);
				
				}
		
	echo "</div></div>";
	//close off the main content and display footer
display_footer();  //display footer on page  
    echo "</div></div>"; //close off main panel and wrapper
	
//include all modals

$para= modal_explore_auctions("latest",$user);
$para= modal_explore_auctions("highest",$user,$para);
$para= modal_explore_auctions("lowest",$user,$para);
$para= modal_explore_auctions("lessTime",$user,$para);
$para= modal_explore_auctions("all",$user);

  
echo"</body>";
display_includes();
echo"
</html>";

?>
