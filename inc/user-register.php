<?php
	//starting session
	session_start();
	//import db class
	include 'db.php';
	$ur = new db();

	//check is session is established
	if(isset($_SESSION['name'])){
		header("location:user-dashboard.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<style type="text/css">
		.main-area{
			height: 100vh;
			background-image: url('img/banner1.jpg');
		}
		.register-area{
			padding: 30px;
			width: 70%;
			margin:100px auto;
			border-radius: 30px;
			border:5px solid #009688;
			background-color: #D3D3D3;
		}
	</style>

</head>
<body>


<div class="container-fluid">
	
	<div class="row">
		
		<div class="main-area col-md-12 text-center">

			<div class="register-area text-center">
				<?php 
					if(isset($_POST['submit'])){

						$urname = $_POST['rname'];
						$uname = $_POST['username'];
						$umail = $_POST['mail'];
						$upass = md5($_POST['password']);
						$ublood = $_POST['blood'];
						$umbl = $_POST['mbl'];

						if( !empty($urname) && !empty($uname) && !empty($umail) && !empty($upass) && !empty($ublood) && !empty($umbl)){
							//check exixst user
							$chk_q = "select * from users where username='$uname'";
							$chk_r = $ur->custom_query($pdo,$chk_q);
							if($chk_r->rowCount() == 1){
								echo "<p class='alert alert-danger text-center'>Username Already Exists!</p>";
							}
							else{
								$insert_user = "insert into users (username,email,password,name,blood,contact) values ('$uname','$umail','$upass','$urname','$ublood','$umbl')";
								$ur->custom_query($pdo,$insert_user);
								echo "<p class='alert alert-success text-center'>Register Successfull! <a href='user-login.php'>LOGIN to continue!</a></p>";
							}
						}
						else{
							echo "<p class='alert alert-danger text-center'>Fields Must Not Be Empty</p>";
						}
					}
				 ?>
				<form class="form-group" method="POST" action="">
					<h2>User Registration Area</h2>
					<input class="form-control" type="text" name="rname" placeholder="Your Full Name"><br>
					<input class="form-control" type="text" name="username" placeholder="Your User Name"><br>
					<input class="form-control" type="email" name="mail" placeholder="Your Email"><br>
					<input class="form-control" type="password" name="password" placeholder="Password"><br>
					<label>Select Blood Group:</label>
					<select class="form-control" name="blood">
						<option value="A+">A+</option>
						<option value="A-">A-</option>
						<option value="B+">B+</option>
						<option value="B-">B-</option>
						<option value="AB+">AB+</option>
						<option value="AB-">AB-</option>
						<option value="O+">O+</option>
						<option value="O-">O-</option>
					</select><br>
					<label>Valid Mobile Number:</label>
					<input class="form-control" type="number" name="mbl"><br>
					<input class="btn btn-success" type="submit" name="submit" value="Register"><br>
					
					<p>Go Back to <a href="index.php">Site</a></p>
				</form>	
			</div>
			
		</div>

	</div>

</div>


</body>
</html>