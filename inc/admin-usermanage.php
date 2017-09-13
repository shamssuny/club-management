<?php include 'header.php'; ?>

<?php
	//init
	$um = new db();
?>

<style type="text/css">
	.manage-center-data span{
		font-size: 15px;
		font-weight: bold;
	}

	.manage-bottom {
		overflow: auto;
		padding: 10px;
		border: 2px solid black;
		border-radius: 10px;
		height: 400px;
		margin-top: 10px;
	}

	.manage-bottom-main{
		border-bottom: 1.5px solid black;
		margin:5px;
	}

	.manage-bottom-main a{
		margin-top: -8px;
	}

</style>

<div class="row">
	
	<div class="manage-main col-md-12">
		
		<div class="manage-up col-md-12">
			<?php
				//get user delete status
				if(isset($_GET['del'])){
					$user_id = $_GET['user'];
					$user_del_from_event = "delete from event_reg_users where uid='$user_id'";
					$user_del_from_user = "delete from users where uid='$user_id'";
					$um->custom_query($pdo,$user_del_from_event);
					$um->custom_query($pdo,$user_del_from_user);
					echo "<p class='alert alert-success'><b>User Deleted Successfully!</b></p>";
				}
			?>
			<h2>Manage User</h2>
			<hr style="border-color: black;">
		</div>

		<div class="manage-center col-md-12 text-center">
			<form class="form-inline" action="" method="POST">
				<div class="manage-center-data form-group">
					<span>Search User By:</span>
					<select class="form-control" name="tp">
						<option value="name">Name</option>
						<option value="email">Email</option>
						<option value="contact">Phone</option>
					</select>
					<span>Search Query:</span>
					<input class="form-control" type="text" name="src" placeholder="Search Value">
					<input class="btn btn-success" type="submit" name="search" value="Search">
					<a href="admin-usermanage.php" class="btn btn-primary">Show All</a>
				</div>
			</form>

		</div>



		<div class="manage-bottom col-md-12">
			<?php
				if(isset($_POST['search'])){
					//get search
					$col = $_POST['tp'];
					$qu = $_POST['src'];
					$srch_q = "select * from users where $col LIKE '%$qu%'";
					$srch = $um->custom_query($pdo , $srch_q);
					$i=1;
					foreach ($srch as $value) {
						$uud = $value['uid'];
			?>

			<div class="manage-bottom-main col-md-12 ">
				<div class="manage-data col-md-3">
					<p><b><?php echo $i.". ".$value['name']; ?></b></p>
				</div>

				<div class="manage-data col-md-3 text-center">
					<p><?php echo $value['email']; ?></p>
				</div>

				<div class="manage-data col-md-3 text-center">
					<p><?php echo $value['contact']; ?></p>
				</div>

				<div class="manage-data col-md-3">
					<a href="<?php echo '?del=1&user='.$uud; ?>" class="btn btn-danger">Delete</a>
				</div>

			</div>

			<?php
					$i++;}
				}
				else{
					//if not set the search
					$get_u = $um->getalldata($pdo,"users");
					$i = 1;
					foreach ($get_u as $value) {
						$uud = $value['uid'];
			?>

			<div class="manage-bottom-main col-md-12 ">
				<div class="manage-data col-md-3">
					<p><b><?php echo $i.". ".$value['name']; ?></b></p>
				</div>

				<div class="manage-data col-md-3 text-center">
					<p><?php echo $value['email']; ?></p>
				</div>

				<div class="manage-data col-md-3 text-center">
					<p><?php echo $value['contact']; ?></p>
				</div>

				<div class="manage-data col-md-3">
					<a href="<?php echo '?del=1&user='.$uud; ?>" class="btn btn-danger">Delete</a>
				</div>

			</div>


			<?php			
					$i++;}
				}
			?>

		</div>

	</div>

</div>

<?php include 'footer.php'; ?>