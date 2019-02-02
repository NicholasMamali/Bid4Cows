<?php

	
	function display_head($header_name="Bid4cows")
	{
		echo "
			<head>
				<meta charset='utf-8' />
				<link rel='apple-touch-icon' sizes='76x76' href='assets/img/apple-icon.png'>
				<link rel='icon' type='image/png' sizes='96x96' href='assets/img/favicon.png'>
				<link rel='stylesheet' type='text/css' href='images/imageStyle.css'>
				<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />

				<title>Bid4Cows</title>

				<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
				<meta name='viewport' content='width=device-width' />


				<!-- Bootstrap core CSS     -->
				<link href='assets/css/bootstrap.min.css' rel='stylesheet' />

				<!-- Animation library for notifications   -->
				<link href='assets/css/animate.min.css' rel='stylesheet'/>

				<!--  Paper Dashboard core CSS    -->
				<link href='assets/css/paper-dashboard.css' rel='stylesheet'/>


				<!--  Fonts and icons     -->
				<link href='http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' rel='stylesheet'>
				<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
				<link href='assets/css/themify-icons.css' rel='stylesheet'>

			</head>
		";
	}
		
	function display_sidebar($page_name="Default", $login=1)
	{
			echo "
				<div class='sidebar' data-background-color='white' data-active-color='danger'>
					<div class='sidebar-wrapper'>
						<div class='logo'>
							<a href='' class='simple-text'>
								Bid4Cows
							</a>
						</div>
						
						<ul class='nav'>
							";
							if($page_name=="Login")
							{
								if($login==1)
								{
									echo "<li class='active'>
									";
								}else{
								echo "<li>
								";
								}
								echo "
									<a href='loginpage.php'>
										<i class='ti-user'></i>
										<p>Login</p>
									</a>
								</li>
								";
								
								if($login=="no")
								{
									echo "<li class='active'>
									";
								}else{
								echo "<li>
								";
								}
								echo "
									<a href='registerpage.php'>
										<i class='ti-link'></i>
										<p>Register</p>
									</a>
								</li>
								";
							}
							else{
								if ($page_name=="Dashboard")
								{
									echo "<li class='active'>";
								}
								else
								{
									echo "<li>";
								}
								echo "
									<a href='dashboard.php'>
										<i class='ti-home'></i>
										<p>Dashboard</p>
									</a>
								</li>
								";
								if ($page_name=="User")
								{
									echo "<li class='active'>";
								}
								else
								{
									echo "<li>";
								}
								echo "
									<a href='user.php'>
										<i class='ti-user'></i>
										<p>User Profile</p>
									</a>
								</li>
								";
								if ($page_name=="Cattle")
								{
									echo "<li class='active'>";
								}
								else
								{
									echo "<li>";
								}
								echo "
									<a href='cattle.php'>
										<i class='ti-package'></i>
										<p>Cattle</p>
									</a>
								</li>
								";
								if ($page_name=="Explore")
								{
									echo "<li class='active'>";
								}
								else
								{
									echo "<li>";
								}
								echo "
									<a href='explore.php'>
										<i class='ti-world'></i>
										<p>Explore</p>
									</a>
								</li>";
							}
							echo "
							
						</ul>
					</div>
				</div>
			";
	}
		
	function display_mainpanel_topnav($page_name="Default", $id)
	{
		echo "
		
			<nav class='navbar navbar-default'>
				<div class='container-fluid'>
					<div class='navbar-header'>
						<button type='button' class='navbar-toggle'>
							<span class='sr-only'>Toggle navigation</span>
							<span class='icon-bar bar1'></span>
							<span class='icon-bar bar2'></span>
							<span class='icon-bar bar3'></span>
						</button>
						<a class='navbar-brand' href='#'>".$page_name."</a>
					</div>
					<div class='collapse navbar-collapse'>
						<ul class='nav navbar-nav navbar-right'>
						";
						if($id!=0){
							echo "
							<li>
									<a href='logout.php'>
										<i class='ti-hand-point-right'></i>
										<p>Logout</p>
									</a>
								</li>
							";
						}
						/*
							<li class='dropdown'>
								  <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
										<i class='ti-bell'></i>
										<p class='notification'>5</p>
										<p>Notifications</p>
										<b class='caret'></b>
								  </a>
								  <ul class='dropdown-menu'>
									<li><a href='#'>Notification 1</a></li>
									<li><a href='#'>Notification 2</a></li>
									<li><a href='#'>Notification 3</a></li>
									<li><a href='#'>Notification 4</a></li>
									<li><a href='#'>Another notification</a></li>
								  </ul>
							</li>
							 */
							echo"
						</ul>

					</div>
				</div>
			</nav>
		
		";
	}
	
	function display_includes()
	{
		echo "
			
			<!--   Core JS Files   -->
			<script src='assets/js/jquery-1.10.2.js' type='text/javascript'></script>
			<script src='assets/js/bootstrap.min.js' type='text/javascript'></script>

			<!--  Checkbox, Radio & Switch Plugins -->
			<script src='assets/js/bootstrap-checkbox-radio.js'></script>

			<!--  Charts Plugin -->
			<script src='assets/js/chartist.min.js'></script>
			
			<script src='assets/data/jquery/jquery.min.js'></script>
			
			<script src='assets/data/raphael/raphael.min.js'></script>
			<script src='assets/data/morrisjs/morris.min.js'></script>
			<script src='assets/data/morris-data.js'></script>

			<!--  Notifications Plugin    -->
			<script src='assets/js/bootstrap-notify.js'></script>

			<!--  Google Maps Plugin    -->
			<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js'></script>
			
			<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
			<script src='assets/js/paper-dashboard.js'></script>
			
			<script src='assets/js/demo.js'></script>
		
		";
		
	}
	
	function display_footer()
	{
		echo "
			
			<footer class='footer'>
				<div class='container-fluid'>
					<nav class='pull-left'>
						<ul>

							<li>
								<a href=''>
									Created by Thembiso Ragimana
								</a>
							</li>
							<li>
								<a href=''>
								   Fhulufhelo Mamali
								</a>
							</li>
							<li>
								<a href=''>
									Ndou Given
								</a>
							</li>
						</ul>
					</nav>
					<div class='copyright pull-right'>
					Copyright Bid4cows capstone project
					</div>
				</div>
			</footer>
		
		";
		
	}
	
?>