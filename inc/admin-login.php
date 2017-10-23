<?php
	//include db class
	include 'db.php';
	$admin = new db();

	//start session and check if session already there
	session_start();
	if(isset($_SESSION['name'])){
		$nam = $_SESSION['name'];
		$chek_u_q = "select username from admin where username='$nam'";
		$re = $admin->custom_query($pdo,$chek_u_q);

		if($re->rowCount() == 1){
			header("location:home.php");
		}

		session_unset();
		session_destroy();
		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="css/admin-login.css">

	<script src="js/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="main col-md-12">
			<div class="row">
				<div class="login-area ">
					<h2><b>Admin Login</b></h2>
					<?php

						//check for button press
						if(isset($_POST['submit'])){
							//get the values
							$username = $_POST['username'];
							$password = md5($_POST['pass']);

							if(!empty($username) && !empty($password)){
								//query data
								$login = "select * from admin where username='$username' and password = '$password'";
								
								$admin_result = $admin->custom_query($pdo , $login);
								//check if find only one data
								if($admin_result->rowCount() == 1){
									echo "<p class='alert alert-success'>Login Success Redirecting . . .</p>";
									//progress bar bootstrap
									echo "<div class='progress progress-striped active'><div class='progress-bar progress-bar-success' role='progressbar' style='width:100%'></div></div>";
									//starting session for admin and redirect to dashboard
									foreach ($admin_result as $value) {
										
										$_SESSION['name'] = $value['username'];
										header("refresh:3;url=home.php");
									}
								}else{
									echo "<p class='alert alert-danger'>Username Or Password aren't match!</p>";
								}

							}else{
								echo "<p class='alert alert-danger'>Invalid Input</p>";
							}
 						}
					?>
					<form class="form-group" method="POST" action="">
						<input class="form-control input-lg" type="text" name="username" placeholder="Input Username">
						<input class="form-control input-lg" type="password" name="pass" placeholder="Input Password">
						<input class="btn btn-success btn-lg" type="submit" name="submit" value="Log Into Portal">
					</form>
					<a href="index.php">Go to Site</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>