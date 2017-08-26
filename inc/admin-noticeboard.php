<?php
	//sessions
	session_start();
	//include db class
	include 'db.php';
	$notice = new db();

	//check is session is established
	if(!isset($_SESSION['name'])){
		header("location:admin-login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Notice Board</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="css/admin-noticeboard.css">
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
									$data = $notice->custom_query($pdo,$get_club);

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
							
							<h2 style="text-align: center;"><b>NOTICE BOARD</b></h2>
							<?php
								//make  a notice
								if(isset($_POST['notice'])){
									$not_title = $_POST['title'];
									$not_det = $_POST['n_detail'];

									$give_post = "insert into noticeboard (notice_title,notice_details,mark) values ('$not_title','$not_det','no')";
									$notice->custom_query($pdo,$give_post);

									echo "<p class='alert alert-success'>Notice Has Been Posted !</p>";
								}
								//make notice end

								//update to the new post
								if(isset($_GET['n_id'])){
									$get_id = $_GET['n_id'];
									$up_not = "update noticeboard set mark='yes' where id='$get_id'";
									$notice->custom_query($pdo,$up_not);

									echo "<p class='alert alert-success'>Added to New and Will show on main webpage!</p>";
									header("refresh:1;url=admin-noticeboard.php");
								}



								//update to old post notice
								if(isset($_GET['y_id'])){
									$get_id = $_GET['y_id'];
									$up_not = "update noticeboard set mark='no' where id='$get_id'";
									$notice->custom_query($pdo,$up_not);

									echo "<p class='alert alert-warning'>Removed From New !</p>";
									header("refresh:1;url=admin-noticeboard.php");
								}


								//delete the notice
								if(isset($_GET['d_id'])){
									$get_id = $_GET['d_id'];
									$up_not = "delete from noticeboard where id='$get_id'";
									$notice->custom_query($pdo,$up_not);

									echo "<p class='alert alert-danger'>Notice Deleted !</p>";
									header("refresh:1;url=admin-noticeboard.php");
								}
							?>
							<div class="row">
								<div class="give-notice col-md-8 col-md-offset-2">

									<?php
										//set update notice
										if(isset($_POST['notice_up'])){
											$up_t = $_POST['title'];
											$up_d = $_POST['n_detail'];
											$up_id = $_POST['update_id'];
											$final_up = "update noticeboard set notice_title='$up_t',notice_details='$up_d' where id=$up_id";
											$notice->custom_query($pdo , $final_up);
											echo "<p class='alert alert-success'>Notice Updated !</p>";
											header("refresh:1;url=admin-noticeboard.php");
										}
										//get update a notice
										if(isset($_GET['u_id'])){
											$up_id = $_GET['u_id'];
											//get data of the selected notice
											$get_s_data = "select * from noticeboard where id='$up_id'";
											$s_data = $notice->custom_query($pdo,$get_s_data);
											foreach ($s_data as $value) {
												$no_t = $value['notice_title'];
												$no_d = $value['notice_details'];
											
									?>


									<form class="form-group" action="" method="POST">
										<input class="form-control" type="text" name="title" value="<?php echo $no_t; ?>" required="">
										<textarea class="form-control" rows="4" name="n_detail" value="" required=""><?php echo $no_d; ?></textarea>
										<input type="hidden" name="update_id" value="<?php echo $value['id']; ?>">
										<input class="btn btn-success" type="submit" name="notice_up" value="Update Notice">
									</form>


									<?php 
											}
										}else{
									 ?>


									<form class="form-group" action="" method="POST">
										<input class="form-control" type="text" name="title" placeholder="Notice Title" required="">
										<textarea class="form-control" rows="4" name="n_detail" placeholder="Notice Details" required=""></textarea>
										<input class="btn btn-success" type="submit" name="notice" value="Give A Notice">
									</form>

									<?php }//end of update ?>
								</div>
							</div>



							<div class="row">
								<div class="all-notice col-md-12">
									<hr>
									<h2 style="text-align: center;"><b>All Notices</b></h2>


									<div class="row">

										<?php
											$get_all = $notice->getalldata($pdo , "noticeboard");

											foreach ($get_all as $value) {
												
										?>
										<div class="notice-detail col-md-12">
											<h3>
												<?php echo $value['notice_title']; ?>
											</h3>
											<p>
												<?php echo $value['notice_details']; ?>
											</p>
											<?php 
												//check if mark as new
												$mark = $value['mark'];
												$notice_id = $value['id'];
												if($mark == "no"){
													echo "<a class='btn btn-success' href='?n_id=$notice_id'>Show</a>";
												}else{
													echo "<a class='btn btn-danger' href='?y_id=$notice_id'>Hide</a>";
												}
												//delete button
												echo "<a class='btn btn-warning' href='?d_id=$notice_id'>Delete</a>";
												//update button
												echo "<a class='btn btn-primary' href='?u_id=$notice_id'>Edit</a>";
											 ?>
											<!-- <a class="btn btn-success" href="">Mark As New</a>
											<a class="btn btn-danger" href="">Unmark</a> -->
										</div>

										<?php
											}
										?>
									</div>


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

</body>
</html>