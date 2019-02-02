<!doctype html>
<html lang="en">

<?php 
include 'functions.php';
display_head();

	echo "<body><div class='wrapper'>";
display_sidebar("Login",0);  //display side bar navigaition from the functions library, depending on who the user is
	echo "<div class='main-panel'>";
display_mainpanel_topnav("Login","no");
	echo "<div class='content'><div class='container-fluid'>";
	//this is the main panel where all the content will go
	//in this case, recent bids and activitis with notifications will be added here
	echo "<div class='row'>";

				include 'registration_elements.php';
				RegistrationDiv();

				
		
	echo "</div></div></div>";
	//close off the main content and display footer
display_footer();  //display footer on page  
    echo "</div></div>"; //close off main panel and wrapper
	
//include all modals
  
echo"</body>";
display_includes();
echo"
</html>";

?>