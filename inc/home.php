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
						<div class="left-body col-md-3">
							<h3 style="color:white;text-align: center;"><a href="home.php">Admin Dashboard</a></h3>
							<hr>
							<a href="admin-make.php"><h4>Manage Admin</h4></a>
							<hr style="">
							<a href="admin-password.php"><h4>Change Password</h4></a>
							<hr>
							<a href="admin-logout.php"><h4>Logout</h4></a>
							<hr>
						</div>
						<!-- left body end -->


						<!-- right body start -->
						<div class="right-body col-md-9">
							
							<!-- right body content start -->

							<!-- first row start -->
							<div class="row">
								<a href="admin-noticeboard.php">
								<div class="notice col-md-3 col-md-offset-1">
									<h1 class="glyphicon glyphicon-th-list"></h1>
									<h3>NOTICE BOARD</h3>
								</div>
								</a>

								
								<a href="admin-frontpage.php">
								<div class="front-site col-md-3">
									<h1 class="glyphicon glyphicon-credit-card"></h1>
									<h3>FRONT SITE</h3>
								</div>
								</a>

								<a href="admin-usermanage.php">
								<div class="users col-md-3">
									<h1 class="glyphicon glyphicon-user"></h1>
									<h3>USER MANAGE</h3>
								</div>
								</a>
								
							</div>
							<!-- first row end -->



							<!-- second row start -->
							<div class="row">
								<a href="admin-blood.php">
								<div class="blood col-md-3 col-md-offset-1">
									<h1 class="glyphicon glyphicon-tint"></h1>
									<h3>BLOOD BANK</h3>
								</div>
								</a>


								<a href="admin-event.php">
								<div class="event col-md-3">
									<h1 class="glyphicon glyphicon-bullhorn"></h1>
									<h3>EVENT MANAGER</h3>
								</div>
								</a>

								<a href="admin-cost.php">
								<div class="cost col-md-3">
									<h1 class="glyphicon glyphicon-usd"></h1>
									<h3>COST MANAGER</h3>
								</div>
								</a>


								<a href="admin-blog.php">
								<div class="blog col-md-3">
									<h1 class="glyphicon glyphicon-edit col-md-offset-1"></h1>
									<h3>NEWS/BLOG</h3>
								</div>
								</a>
							</div>
							<!-- second row end -->


							


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