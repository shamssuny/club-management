<?php include 'header.php'; ?>

<?php
	//init
	$vol = new db();
?>

<style type="text/css">
	.admin-vol{
		border:2px solid green;
		border-radius: 10px;
		padding: 10px;
		height: 300px;
		overflow: auto;
	}

	.admin-vol-sh{
		border-bottom: 1px dotted grey;
		margin-top: 5px;
	}

	.admin-vol-sh p{
		margin-top: 5px;
	}
	.admin-vol-sh a{
		margin-bottom: 5px;
	}
</style>

<div class="row">
	
	<div class="admin-vol-main col-md-12">

		<?php
			//make a volunteer
			if(isset($_GET['make'])){
				$uud = $_GET['uid'];
				$uuname = $_GET['name'];
				if(!empty($uud)&&!empty($uuname)){
					$make_vol_q = "insert into event_vol (uid,username) values ('$uud','$uuname')";
					$vol->custom_query($pdo,$make_vol_q);

					echo "<p class='alert alert-success text-center'>Volunteer Added Successfully!</p>";
				}
			}

			//delete from volunteer
			if(isset($_GET['del'])){
				$uud = $_GET['uid'];
				
				if(!empty($uud)){
					$make_vol_q = "delete from event_vol where uid='$uud'";
					$vol->custom_query($pdo,$make_vol_q);

					echo "<p class='alert alert-warning text-center'>Volunteer Removed Successfully!</p>";
				}
			}
		?>
		
		<h2>Make Volunteer</h2>
		<hr style="border-color: black;">

		<div class="admin-vol-src col-md-12">
			
			<form class="form-group form-inline text-center" action="" method="POST">
				<input type="text" name="sr" class="form-control" placeholder="Search User">
				<input type="submit" name="src_vol" value="Search" class="btn btn-success">
				<a href="" class="btn btn-primary">Show All</a>
			</form>

		</div>


		<div class="admin-vol col-md-12 text-center">

			<?php
				if(!isset($_POST['src_vol'])){
				//show all users
				$sh_u = $vol->getalldatadesc($pdo,"users","uid");
				
				foreach ($sh_u as $value) {
					
			?>
			
			<div class="admin-vol-sh col-md-12">
				
				<div class="admin-vol-det col-md-4">
					<p>
						<?php echo $value['name']; ?>
					</p>
				</div>


				<div class="admin-vol-det col-md-4">
					<p>
						<?php echo $value['email']; ?>
					</p>
				</div>


				<div class="admin-vol-det col-md-4">

					<?php
						$get_uid = $value['uid'];
						$chk_vol = "select uid from event_vol where uid='$get_uid'";
						$chk_v = $vol->custom_query($pdo,$chk_vol);
						if($chk_v->rowCount() == 0){
					?>
					<a href="?make=1&uid=<?php echo $value['uid']; ?>&name=<?php echo $value['username']; ?>" class="btn btn-success">Make Volunteer</a>

					<?php
						}else{

					?>
					<a href="?del=1&uid=<?php echo $value['uid']; ?>" class="btn btn-danger">Delete Volunteer</a>
					<?php
						}
					?>
					
				</div>

			</div>

			<?php
				
				}
			}else{
				//show all users
				$ss = $_POST['sr'];
				$sh_u_q = "select * from users where name like '%$ss%'";
				$sh_u = $vol->custom_query($pdo,$sh_u_q);
				
				foreach ($sh_u as $value) {
			?>


			<div class="admin-vol-sh col-md-12">
				
				<div class="admin-vol-det col-md-4">
					<p>
						<?php echo $value['name']; ?>
					</p>
				</div>


				<div class="admin-vol-det col-md-4">
					<p>
						<?php echo $value['email']; ?>
					</p>
				</div>


				<div class="admin-vol-det col-md-4">

					<?php
						$get_uid = $value['uid'];
						$chk_vol = "select uid from event_vol where uid='$get_uid'";
						$chk_v = $vol->custom_query($pdo,$chk_vol);
						if($chk_v->rowCount() == 0){
					?>
					<a href="?make=1&uid=<?php echo $value['uid']; ?>&name=<?php echo $value['username']; ?>" class="btn btn-success">Make Volunteer</a>

					<?php
						}else{

					?>
					<a href="?del=1&uid=<?php echo $value['uid']; ?>" class="btn btn-danger">Delete Volunteer</a>
					<?php

						}
					?>
					
				</div>

			</div>

			<?php 
				}
				}
			 ?>



		</div>

	</div>

</div>

<?php include 'footer.php'; ?>