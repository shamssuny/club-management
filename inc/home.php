<?php
	//starting session
	session_start();
	//import db class
	include 'db.php';
	$home = new db();

	//check is session is established
	if(!isset($_SESSION['name'])){
		header("location:admin-login.php");
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Main Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<!-- font awesome -->
	<link rel="stylesheet" type="text/css" href="css/fa/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="css/mainpage.css">
</head>
<body>

<!-- main container -->

<div class="container-fluid">
	
	<div class="row">
		
		<!-- main class start -->
		<div class="main col-md-12">
			
			<!-- header start -->
			<div class="row">
				<div class="header col-md-12">
					<div class="row">
						<div class="left-header col-md-6">
							<h3>
								<?php 
									//get club name from frontpage table
									$get_club = "select club_name from frontpage where id=1";
									$data = $home->custom_query($pdo,$get_club);

									foreach ($data as $value) {
										echo $value['club_name'];
									}
								 ?>
							</h3>
						</div>

						<div class="right-header col-md-6">
							<h3>Welcome <?php echo $_SESSION['name']; ?></h3>
							<a class="" href="admin-logout.php"><span class="glyphicon glyphicon-off"></span></a>
						</div>
					</div>
				</div>
			</div>
			<!-- header end -->


			<!-- main body start -->

			<div class="row">
				<div class="main-body col-md-12">

					<div class="row">
						<!-- left body start -->
						<div class="left-body col-md-2" style="text-align: left;">
							<h3 style="color:white;text-align: center;"><a href="home.php">Admin Dashboard</a></h3>
							<hr>
							<a href="admin-make.php"><h4>Manage Admin</h4></a>
							<hr style="">
							<a href="admin-password.php"><h4>Change Password</h4></a>
							<hr>
							<a href="admin-help.php"><h4>Help Center</h4></a>
							<hr>
							<a href="admin-logout.php"><h4>Logout</h4></a>
							<hr>
						</div>
						<!-- left body end -->


						<!-- right body start -->
						<div class="right-body col-md-10">

							<div class="back-vid col-md-12">
								<p></p>
								<video autoplay="true" loop="" >
									<source src="img/vid.mp4" type="video/mp4">
								</video>
							</div>
							
							<!-- right body content start -->

							<div class="all-menus col-md-12">
							<!-- first row start -->
							<div class="row">
								<a href="admin-noticeboard.php">
								<div class="notice col-md-3 col-md-offset-1">
									<h1 style="font-size: 45px;" class=""><i class="fa fa-flag-checkered" aria-hidden="true"></i></h1>
									<h3><b>NOTICE BOARD</b></h3>
								</div>
								</a>

								
								<a href="admin-frontpage.php">
								<div class="front-site col-md-3">
									<h1 class=""><i class="fa fa-area-chart" aria-hidden="true"></i></h1>
									<h3><b>FRONT SITE</b></h3>
								</div>
								</a>

								<a href="admin-usermanage.php">
								<div class="users col-md-3">
									<h1 class=""><i class="fa fa-user-circle-o" aria-hidden="true"></i></h1>
									<h3><b>USER MANAGE</b></h3>
								</div>
								</a>
								
							</div>
							<!-- first row end -->



							<!-- second row start -->
							<div class="row">
								<a href="admin-blood.php">
								<div class="blood col-md-3 col-md-offset-1">
									<h1 class=""><i class="fa fa-tint" aria-hidden="true"></i></h1>
									<h3><b>BLOOD BANK</b></h3>
								</div>
								</a>


								<a href="admin-event.php">
								<div class="event col-md-3">
									<h1 class=""><i class="fa fa-calendar-check-o" aria-hidden="true"></i></h1>
									<h3><b>EVENT MANAGER</b></h3>
								</div>
								</a>

								<a href="admin-cost.php">
								<div class="cost col-md-3">
									<h1 class=""><i class="fa fa-usd" aria-hidden="true"></i></h1>
									<h3><b>COST MANAGER</b></h3>
								</div>
								</a>

							</div>
							<!-- second row end -->


							<!-- third row start -->
							<div class="row">
								
								<a href="admin-blog.php">
								<div class="blog col-md-3 col-md-offset-1">
									<h1 style="margin-left: 0;" class=""><i class="fa fa-newspaper-o" aria-hidden="true"></i></h1>
									<h3><b>NEWS/BLOG</b></h3>
								</div>
								</a>




								<a href="admin-alumni.php">
								<div class="alumni col-md-3 ">
									<h1 class=""><i class="fa fa-users" aria-hidden="true"></i></h1>
									<h3><b>ALUMNI</b></h3>
								</div>
								</a>



								<a href="admin-projects.php">
								<div class="projects col-md-3 ">
									<h1 class=""><i class="fa fa-graduation-cap" aria-hidden="true"></i></h1>
									<h3><b>Club Projects</b></h3>
								</div>
								</a>

								

							</div>
							<!-- third row end -->

							</div>


							<!-- right body content end -->

						</div>
						<!-- right body end -->
					</div>

					


				</div>
			</div>

			<!-- main body end -->

		</div>
		<!-- main class end -->

	</div>

</div>

<!-- container end -->

</body>
</html>