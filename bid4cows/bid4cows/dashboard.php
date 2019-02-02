<!doctype html>
<html lang="en">

<?php 
include 'functions.php';

session_start();

if ( isset( $_SESSION['user'] ) ) {
    // Grab user data from the database using the user_id
display_head();

	echo "<body><div class='wrapper'>";
display_sidebar("Dashboard");  //display side bar navigaition from the functions library, depending on who the user is
	echo "<div class='main-panel'>";
display_mainpanel_topnav("Dashboard",$_SESSION['user']);
	echo "<div class='content'><div class='container-fluid'>";
	//this is the main panel where all the content will go
	//in this case, recent bids and activitis with notifications will be added here
				include 'dashboard_auction_and_bid.php';
				display_active_auctions($_SESSION['user']);
				display_active_bids($_SESSION['user']);
		
	echo "</div></div>";
	//close off the main content and display footer
display_footer();  //display footer on page  
    echo "</div></div>"; //close off main panel and wrapper
	
//include all modals
modal_active_auctions($_SESSION['user']);
modal_active_bids($_SESSION['user']);
  
echo"</body>";
display_includes();
echo"
</html>";
}
else {
    // Redirect them to the login page
    header("Location: loginpage.php");
}
?>
