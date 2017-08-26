<?php
//sessions
session_start();
//include db class
include 'db.php';
$pass = new db();

//check is session is established
	if(!isset($_SESSION['name'])){
		header("location:admin-login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="css/admin-password.css">
</head>
<body>

<!-- main -->

<div class="container-fluid">
	
	<div class="row">
		
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
									$data = $pass->custom_query($pdo,$get_club);

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



			<!-- main body strat -->
			<div class="row">
				
				<div class="main-body col-md-12">
					
					<div class="row">
						<!-- left body start -->
						<div class="left-body col-md-3">
							<h3 style="color:white;text-align: center;"><a href="home.php">Admin Dashboard</a></h3>
							<hr>
							<a href="admin-make.php"><h4>Manage Admin</h4></a>
							<hr style="">
							<a href=""><h4>Change Password</h4></a>
							<hr>
							<a href="admin-logout.php"><h4>Logout</h4></a>
							<hr>
						</div>
						<!-- left body end -->



						<!-- right body start -->
						<div class="right-body col-md-9">
							
							<div class="row">
								
								<div class="change-pass col-md-6 col-md-offset-3">
								<?php
									//check the old pass and make new one
									if(isset($_POST['change_pass'])){
										//get user old password
										$u_name = $_SESSION['name'];
										$get = "select * from admin where username='$u_name'";
										$g_res = $pass->custom_query($pdo,$get);
										foreach ($g_res as $value) {
											$get_old = $value['password'];
										}
										//match old password
										$given_old_pass = md5($_POST['old_pass']);
										$given_new_pass = md5($_POST['new_pass']);

										if($get_old == $given_old_pass){
											$update_pass_q = "update admin set password='$given_new_pass'";
											$pass->custom_query($pdo,$update_pass_q);
											echo "<p class='alert alert-success'>Password Updated Successfully.</p>";
										}else{
											echo "<p class='alert alert-danger'>Old Password Won't Match! .</p>";
										}
									}
								?>
									
									<h2>Change Password</h2>

									<form class="form-group" action="" method="POST">
										<input class="form-control" type="password" name="old_pass" placeholder="Old Password">
										<input class="form-control" type="password" name="new_pass" placeholder="New Password">
										<input class="btn btn-success" type="submit" name="change_pass" value="Change Password">
									</form>

								</div>

							</div>

						</div>
						<!-- right body end -->


					</div>

				</div>

			</div>
			<!-- main body end -->


		</div>

	</div>

</div>

<!-- man end -->
</body>
</html>