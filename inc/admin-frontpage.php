<?php
	session_start();
//import db class
	include 'db.php';
	$front =  new db();

	//check is session is established
	if(!isset($_SESSION['name'])){
		header("location:admin-login.php");
	}else{
		$nam = $_SESSION['name'];
		$chek_u_q = "select username from admin where username='$nam'";
		$re = $front->custom_query($pdo,$chek_u_q);

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
	<title>Edit Front Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="css/admin-frontpage.css">
</head>
<body>

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
									$data = $front->custom_query($pdo,$get_club);

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
			<!-- main body start -->

			<div class="row">
				<div class="main-body col-md-12">

					<div class="row">
						<!-- left body start -->
						<div class="left-body col-md-3" style="text-align: left;">
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
						<div class="right-body col-md-9">

							<h2 style="text-align: center;">Change Site Contents</h2>
							<?php

								//update club name

									if(isset($_POST['club_name'])){
										$club_name = $_POST['cname'];
										$update_club_name_query = "update frontpage set club_name='$club_name' where id=1";
										$front->custom_query($pdo,$update_club_name_query);
										echo "<p class='alert alert-success'>Club Title Updated !</p>";
									}

								//update club name end



								//update slider title
									if(isset($_POST['title'])){
										$img_title = $_POST['slider_title'];
										$update_title = "update frontpage SET slider_title='$img_title' where id=1";
										$front->custom_query($pdo,$update_title);

										echo "<p class='alert alert-success'>Slider Title Updated !</p>";
									}
								//update slider title end




								//upload image for slider
										if(isset($_POST['slider_image'])){
											$file = $_FILES['image']['name'];
											$file = "clubbanner.jpg";
											$tmp = $_FILES['image']['tmp_name'];
											$size = $_FILES['image']['size'];
											//echo "$size";
											if(!empty($file) && !empty($tmp)){
												if(exif_imagetype($tmp) != IMAGETYPE_JPEG || $size > 1485760 ){
													echo "<p class='alert alert-danger'>Wrong type file or size . Size Should be under 1MB and file should be jpg.</p>";
												}else{
													unlink("img/".$file);
													move_uploaded_file($tmp,"img/".$file);
													echo "<p class='alert alert-success'>Slider Image Updated !</p>";


												}
											}else{
												echo "<p class='alert alert-danger'>Wrong type file or size . Size Should be under 1MB and file should be jpg.</p>";
											}
											
										}
								//upload image slider end



								//update about us
									if(isset($_POST['about_detail'])){
										$all_about = $_POST['about'];
										$update_about = "update frontpage set about='$all_about' where id=1";
										$front->custom_query($pdo , $update_about);

										echo "<p class='alert alert-success'>About Us Section Updated !</p>";
									}
								//update about us end


								//update teams 

									if(isset($_POST['t1_data'])){
										$t1_name = $_POST['t1name'];
										$t1_pos = $_POST['t1position'];
										$file = $_FILES['image']['name'];
										$file = "t1.jpg";
										$tmp = $_FILES['image']['tmp_name'];
										$size = $_FILES['image']['size'];
										//echo "$size";
										if(!empty($file) && !empty($tmp)){
											if(exif_imagetype($tmp) != IMAGETYPE_JPEG || $size > 1485760 ){
												echo "<p class='alert alert-danger'>Wrong type file or size . Size Should be under 1MB and file should be jpg.</p>";
											}else{
												unlink("img/".$file);
												move_uploaded_file($tmp,"img/".$file);
												$update_t1 = "update frontpage set team1_name='$t1_name',team1_title='$t1_pos' where id=1";
												$front->custom_query($pdo , $update_t1);
												echo "<p class='alert alert-success'> Team 1 Data Updated !</p>";


											}
										}else{
											"<p class='alert alert-danger'>Wrong type file or size . Size Should be under 1MB and file should be jpg.</p>";
										}
									}






									if(isset($_POST['t2_data'])){
										$t1_name = $_POST['t2name'];
										$t1_pos = $_POST['t2position'];
										$file = $_FILES['image']['name'];
										$file = "t2.jpg";
										$tmp = $_FILES['image']['tmp_name'];
										$size = $_FILES['image']['size'];
										//echo "$size";
										if(!empty($file) && !empty($tmp)){
											if(exif_imagetype($tmp) != IMAGETYPE_JPEG || $size > 1485760 ){
												echo "<p class='alert alert-danger'>Wrong type file or size . Size Should be under 1MB and file should be jpg.</p>";
											}else{
												unlink("img/".$file);
												move_uploaded_file($tmp,"img/".$file);
												$update_t1 = "update frontpage set team2_name='$t1_name',team2_title='$t1_pos' where id=1";
												$front->custom_query($pdo , $update_t1);
												echo "<p class='alert alert-success'> Team 2 Data Updated !</p>";


											}
										}else{
											echo "<p class='alert alert-danger'>Wrong type file or size . Size Should be under 1MB and file should be jpg.</p>";
										}
									}






									if(isset($_POST['t3_data'])){
										$t1_name = $_POST['t3name'];
										$t1_pos = $_POST['t3position'];
										$file = $_FILES['image']['name'];
										$file = "t3.jpg";
										$tmp = $_FILES['image']['tmp_name'];
										$size = $_FILES['image']['size'];
										//echo "$size";
										if(!empty($file) && !empty($tmp)){
											if(exif_imagetype($tmp) != IMAGETYPE_JPEG || $size > 1485760 ){
												echo "<p class='alert alert-danger'>Wrong type file or size . Size Should be under 1MB and file should be jpg.</p>";
											}else{
												unlink("img/".$file);
												move_uploaded_file($tmp,"img/".$file);
												$update_t1 = "update frontpage set team3_name='$t1_name',team3_title='$t1_pos' where id=1";
												$front->custom_query($pdo , $update_t1);
												echo "<p class='alert alert-success'> Team 3 Data Updated !</p>";


											}
										}else{
											echo "<p class='alert alert-danger'>Wrong type file or size . Size Should be under 1MB and file should be jpg.</p>";
										}	
									}





									if(isset($_POST['t4_data'])){
										$t1_name = $_POST['t4name'];
										$t1_pos = $_POST['t4position'];
										$file = $_FILES['image']['name'];
										$file = "t4.jpg";
										$tmp = $_FILES['image']['tmp_name'];
										$size = $_FILES['image']['size'];
										//echo "$size";
										if(!empty($file) && !empty($tmp)){
											if(exif_imagetype($tmp) != IMAGETYPE_JPEG || $size > 1485760 ){
												echo "<p class='alert alert-danger'>Wrong type file or size . Size Should be under 1MB and file should be jpg.</p>";
											}else{
												unlink("img/".$file);
												move_uploaded_file($tmp,"img/".$file);
												$update_t1 = "update frontpage set team4_name='$t1_name',team4_title='$t1_pos' where id=1";
												$front->custom_query($pdo , $update_t1);
												echo "<p class='alert alert-success'> Team 4 Data Updated !</p>";


											}
										}else{
											echo "<p class='alert alert-danger'>Wrong type file or size . Size Should be under 1MB and file should be jpg.</p>";
										}
									}

								//update team end


								//update club mail
									if(isset($_POST['club_mail'])){
										$mail = $_POST['cemail'];
										$m_q = "update frontpage set email='$mail' where id=1";
										$front->custom_query($pdo,$m_q);
										echo "<p class='alert alert-success'>Destination Mail Updated !</p>";
									}

								//update end
							?>
							
							<!-- content row start -->
							<div class="row">
								<div class="header-content col-md-3">
									<h3>Header Club Name</h3>
									<form class="form-group" action="" method="POST">
										<input class="form-control" type="text" name="cname" placeholder="CLub Name">
										<input class="btn btn-success" type="submit" name="club_name" value="Save">
									</form>
								</div>

								<div class="slider-title col-md-3">
									<h3>Slider Title</h3>
									<form class="form-group" action="" method="POST">
										<input class="form-control" type="text" name="slider_title" placeholder="Input Title">
										<input class="btn btn-warning" type="submit" name="title" value="Save">
									</form>
								</div>

								<div class="slider-image col-md-3">
									<h3>Slider Image</h3>
									
									<form class="form-group" action="" method="POST" enctype="multipart/form-data">
										<input class="form-control" type="file" name="image">
										<input class="btn btn-success" type="submit" name="slider_image" value="Save">
									</form>
								</div>


								<div class="about-detail col-md-3">
									<h3>About</h3>
									<form class="form-group" action="" method="POST">
										<textarea class="form-control" name="about" placeholder="about details" rows="2"></textarea>
										<input class="btn btn-primary" type="submit" name="about_detail" value="Save">
									</form>
								</div>
								

								<div class="team1 col-md-3">
									<h3>Team 1</h3>
									<form class="form-group" action="" method="POST" enctype="multipart/form-data">
										<input class="form-control" type="file" name="image" required="">
										<input class="form-control" type="text" name="t1name" placeholder="Member Name" required="">
										<input class="form-control" type="text" name="t1position" placeholder="Member Position" required="">
										<input class="btn btn-danger" type="submit" name="t1_data" value="Save">
									</form>
								</div>


								<div class="team2 col-md-3">
									<h3>Team 2</h3>
									<form class="form-group" action="" method="POST" enctype="multipart/form-data">
										<input class="form-control" type="file" name="image" required="">
										<input class="form-control" type="text" name="t2name" placeholder="Member Name" required="">
										<input class="form-control" type="text" name="t2position" placeholder="Member Position" required="">
										<input class="btn btn-success" type="submit" name="t2_data" value="Save">
									</form>
								</div>


								<div class="team3 col-md-3">
									<h3>Team 3</h3>
									<form class="form-group" action="" method="POST" enctype="multipart/form-data">
										<input class="form-control" type="file" name="image" required="">
										<input class="form-control" type="text" name="t3name" placeholder="Member Name" required="">
										<input class="form-control" type="text" name="t3position" placeholder="Member Position" required="">
										<input class="btn btn-primary" type="submit" name="t3_data" value="Save">
									</form>
								</div>


								<div class="team4 col-md-3">
									<h3>Team 4</h3>
									<form class="form-group" action="" method="POST" enctype="multipart/form-data">
										<input class="form-control" type="file" name="image" required="">
										<input class="form-control" type="text" name="t4name" placeholder="Member Name" required="">
										<input class="form-control" type="text" name="t4position" placeholder="Member Position" required="">
										<input class="btn btn-warning" type="submit" name="t4_data" value="Save">
									</form>
								</div>


								<div class="mail col-md-3">
									<h3>Mail Setup</h3>
									<form class="form-group" action="" method="POST" enctype="">
										<input class="form-control" type="email" name="cemail" required="" placeholder="Input Destination Mail">
										
										<input class="btn btn-warning" type="submit" name="club_mail" value="Save">
									</form>
								</div>
							</div>
							<!-- content row end	 -->
							

						</div>
						<!-- right body end -->
					</div>

					


				</div>
			</div>

			<!-- main body end -->
			<!-- main body end -->

		</div>

	</div>

</div>

</body>
</html>