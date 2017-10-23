<?php
//sessions
session_start();
//include db class
include 'db.php';
$make = new db();

//check is session is established
	if(!isset($_SESSION['name'])){
		header("location:admin-login.php");
	}else{
		$nam = $_SESSION['name'];
		$chek_u_q = "select username from admin where username='$nam'";
		$re = $make->custom_query($pdo,$chek_u_q);

		if(!$re->rowCount() == 1){
			session_unset();
			session_destroy();
			header("location:admin-login.php");
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Make an Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="css/admin-make.css">
</head>
<body>


<!-- main -->
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
									$data = $make->custom_query($pdo,$get_club);

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



			<!-- main body -->
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


						<!-- right body -->
						<div class="right-body col-md-9">
							<!-- make admin -->
							<div class="row">
								<div class="make-admin col-md-6 col-md-offset-3">
								<?php
									//make an admin
									if(isset($_POST['submit'])){
										$nam = $_POST['ad_name'];
										$pass = md5($_POST['ad_name']);

										//check if username exists
										$get_name = "select * from admin where username='$nam'";
										$result = $make->custom_query($pdo,$get_name);
										$chk = $result->rowCount();
										if($chk != 1 ){
											$in_admin = "insert into admin (username,password) values ('$nam','$pass')";
											$make->custom_query($pdo,$in_admin);
											echo "<p class='alert alert-success'>Admin Added Success. Logout and login to continue.</p>";
										}else{
											echo "<p class='alert alert-warning'>Username Already Exists!</p>";
										}
									}
								?>
									<h2><b>Make Another Admin</b></h2>
									<p class="alert alert-danger"><b>Remember The admin will get full access of the software.</b></p>

									<form class="form-group" action="" method="POST">
										<input class="form-control" type="text" name="ad_name" required="">
										<input class="form-control" type="password" name="ad_pass" required="">
										<input class="btn btn-success" type="submit" name="submit" value="Make Admin">
									</form>
								</div>
							</div>
							<!-- make admin endf -->



							<!-- delete an admin start -->
							<div class="row">
								
								<div class="del-admin col-md-12">
									<hr style="border-color: black;">
									<h2><b>Delete an Admin</b></h2>
									<hr style="border-color: black;">

									<?php
										//get the admin and delete
										if(isset($_GET['aid'])){

											//check if admin delete the logg on admin
											$ch = $_GET['ref'];

											if($_SESSION['name'] != $ch){

												$aaid = $_GET['aid'];
												$del_ad = "delete from admin where id=$aaid";
												$make->custom_query($pdo , $del_ad);

												echo "<p class='alert alert-danger'>An Admin Removed !</p>";
												header("refresh:1;url=admin-make.php");
											}else {
												echo "<p class='alert alert-warning'>You Can't Delete Yourself !</p>";
												//header("refresh:1;url=admin-make.php");
											}	
										}

										//get admin list
										$get_admin = $make->getalldata($pdo,"admin");

										foreach ($get_admin as $value) {
										
											$ad_id=$value['id'];
											$ad_u = $value['username'];
									?>
									<div class="man-del col-md-12">
										<h3><b>User Name: </b>
										<?php echo $value['username']; ?>
										</h3>

										<a class="btn btn-danger" href="<?php echo "?aid=$ad_id&ref=$ad_u" ?>">Delete</a>
									</div>
									<?php
										}
									?>
									

								</div>

							</div>
							<!-- delete admin end -->

						</div>
						<!-- right body end -->

					</div>

				</div>
			</div>
			<!-- main body end -->

		
	</div>
</div>
<!-- main end -->


</body>
</html>