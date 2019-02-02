<!doctype html>
<html lang="en">

<?php 
include 'functions.php';

session_start();
if ( isset( $_SESSION['user'] ) ) {

display_head();

	echo "<body><div class='wrapper'>";
display_sidebar("Cattle");  //display side bar navigaition from the functions library, depending on who the user is
	echo "<div class='main-panel'>";
display_mainpanel_topnav("Cattle",$_SESSION['user']);
	echo "<div class='content'><div class='container-fluid'>";
	//this is the main panel where all the content will go
	//in this case, recent bids and activitis with notifications will be added here
	echo "<div class='row'>";
				include 'cattleTable.php';
				display_table($_SESSION['user']);
				
		
	echo "</div></div></div>";
	//close off the main content and display footer
display_footer();  //display footer on page  
    echo "</div></div>"; //close off main panel and wrapper
	
//include all modals
displayTableEditModal($_SESSION['user']);
displayTableAddModal($_SESSION['user']);
displayTableDeleteModal($_SESSION['user']);
displayTableAuctionModal($_SESSION['user']);
displayTableRemoveAuctionModal($_SESSION['user']);

  
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