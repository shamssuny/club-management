<?php
	//starting session
	session_start();
	//import db class
	include 'db.php';
	$home = new db();

	//check is session is established
	if(!isset($_SESSION['name'])){
		header("location:user-login.php");
	}else{
		$nam = $_SESSION['name'];
		$chek_u_q = "select username from users where username='$nam'";
		$re = $home->custom_query($pdo,$chek_u_q);

		if(!$re->rowCount() == 1){
			session_unset();
			session_destroy();
			header("location:user-login.php");
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Users Area</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>

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
							<a class="" href="user-logout.php"><span class="glyphicon glyphicon-off"></span></a>
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
							<h3 style="color:white;text-align: center;"><a href="user-dashboard.php">Users Dashboard</a></h3>
							<hr>
							<a href="user-update.php"><h4>Update Profile</h4></a>
							<hr>
							<a href="user-password.php"><h4>Change Password</h4></a>
							<hr>
							<?php
								//check user if he is a event admin
								$uuu = $_SESSION['name'];
 								$ch_uu_q = "select username from event_vol where username='$uuu'";
 								$ch_uu = $home->custom_query($pdo,$ch_uu_q);
 								if($ch_uu->rowCount() == 1){
 									echo "<a href='admin-event.php'><h4>Event Manager</h4></a>";
 									echo "<hr>";
 								}
							?>
							<a href="user-logout.php"><h4>Logout</h4></a>
							<hr>
						</div>
						<!-- left body end -->


						<!-- right body start -->
						<div class="right-body col-md-10">