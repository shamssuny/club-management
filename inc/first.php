<?php
	include 'db.php';
	//initialize db class , and call method to get all data from admin table. Then check if there data in there , then it will redirect to main index page, otherwise stay here and complete admin registration.

	$first = new db;
	$res = $first->getalldata($pdo,"admin");
	
	if($res->rowCount() != 0 ){
		header("location:index.php");
	}
	//end
?>
<!DOCTYPE html>
<html>
<head>
	<title>Regsiter for Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/first.css">
	
</head>
<body>

<div class="container-fluid">
	<div class="row">
		<div class="main col-md-12">
			<div class="row">
				<div class="register-area ">
				<?php	
					//register for admin code here
					if(isset($_POST['submit'])){

					//get the values
					$admin_user_name = $_POST['username'];
					$admin_pass = md5($_POST['pass']);

					//check if empty, then register admin
					if(!empty($admin_user_name) && !empty($admin_pass)){

						$admin_register = "insert into admin (username,password) values ('$admin_user_name' , '$admin_pass')";
						//call to db class method custom_query
						$first->custom_query($pdo , $admin_register);

						echo "<p class='alert alert-success'>Register Successfull. You will be redirected. . .</p>";
						header("refresh:3;url=index.php");
					}else{
						echo "<p class='alert alert-danger'>Invalid Input</p>";
					}
				}
				?>
					<h2><b>Register For Admin First</b></h2>
					<p class="alert alert-warning">Please Register With Care ! This Page won't show anymore after your register once!!</p>
					<form class="form-group" method="POST" action="">
						<input class="form-control input-lg" type="text" name="username" placeholder="Input Username">
						<input class="form-control input-lg" type="password" name="pass" placeholder="Input Password">
						<input class="btn btn-success btn-lg" type="submit" name="submit" value="Register For Admin">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>