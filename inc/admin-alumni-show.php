<?php include 'header.php'; ?>

<?php
	//init db
	$alsh =  new db();
?>

<style type="text/css">
	.alumni-sh-up h2{
		display: inline-block;
	}

	.alumni-sh-up a{
		margin-top: 20px;
		float: right;
		margin-right: 10px;
	}

	.alumni-sh-data label{
		font-size: 20px;
	}
	.alumni-sh-data span{
		font-size: 18px;
	}
</style>


<div class="row">
	
	<div class="alumni-sh-main col-md-12">

		<?php

			//delete an alumni
			if(isset($_GET['del'])){
				$aid = $_GET['id'];
				$imu = $_GET['im'];
				unlink("img/alumni/".$imu);
				$del_q = "delete from alumni where al_id='$aid'";
				$alsh->custom_query($pdo,$del_q);
				header("location:admin-alumni.php?dsucc=1");
			}



			//update image
			if(isset($_POST['al_update'])){
				//get exist file name
				$auid = $_GET['id'];
				$get_img = "select img from alumni where al_id='$auid'";
				$get_i = $alsh->custom_query($pdo,$get_img);
				foreach ($get_i as $value) {
					$efile = $value['img'];
				}
				

				$file = $_FILES['image']['name'];
				$file = $efile;
				$tmp = $_FILES['image']['tmp_name'];
				$size = $_FILES['image']['size'];
				if(!empty($file) && !empty($tmp)){
					if(exif_imagetype($tmp) != IMAGETYPE_JPEG || $size > 1485760 ){
						echo "<p class='alert alert-danger text-center'>Fields Cannot be Empty! Or image size should be jpg and under 1MB!!</p>";
					}else{
						unlink("img/alumni/".$efile);
						move_uploaded_file($tmp,"img/alumni/".$file);
						
					}
				}
			}

			//update data without image
			if(isset($_POST['al_update'])){
				$up_al_name = $_POST['al_name'];
				$up_al_mail = $_POST['al_mail'];
				$up_al_num = $_POST['al_num'];
				$up_al_add = $_POST['al_add'];
				$up_al_det = $_POST['al_det'];
				$alu_id = $_GET['id'];

				$up_q = "update alumni set name='$up_al_name',email='$up_al_mail',number='$up_al_num',address='$up_al_add',details='$up_al_det' where al_id='$alu_id'";
				$alsh->custom_query($pdo,$up_q);
				echo "<p class='alert alert-success text-center'>Alumni Data Updated !</p>";

			}


			//get alumni data
			if(isset($_GET['id'])){
				$a_id = $_GET['id'];
				$get_alum_q = "select * from alumni where al_id='$a_id'";
				$get_dat = $alsh->custom_query($pdo,$get_alum_q);

				foreach ($get_dat as $value) {

			
		?>
		
		<div class="alumni-sh-up col-md-12">
			<h2>Alumni Details</h2>
			<a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Update</a>
			<a href="" class="btn btn-warning" data-toggle="modal" data-target="#myModal1">Delete</a>
			<hr style="border-color: black;">
		</div>


		<div class="alumni-sh col-md-12">
			
			<div class="alumni-sh-img col-md-3">
				<img style="width: 100%;" src="img/alumni/<?php echo $value['img']; ?>">
			</div>


			<div class="alumni-sh-data col-md-9">
				<label>Full Name: </label>
				<span><?php echo $value['name']; ?></span><br>
				<label>Email : </label>
				<span><?php echo $value['email']; ?></span><br>
				<label>Contact : </label>
				<span><?php echo $value['number']; ?></span><br>
				<label>Address : </label>
				<span><?php echo $value['address']; ?></span><br>
				<label>About : </label>
				<span><?php echo $value['details']; ?></span>

			</div>

		</div>

		<?php 
				}
			}
		?>



	</div>

</div>	





<!-- Modal for Make cost Curse-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Alumni Info</h4>
        </div>
        <div class="modal-body">
         	<?php
         		if(isset($_GET['id'])){
				$a_id = $_GET['id'];
				$get_alum_q = "select * from alumni where al_id='$a_id'";
				$get_dat = $alsh->custom_query($pdo,$get_alum_q);

				foreach ($get_dat as $value) {
         	?>

          	<form class="form-group" action="" method="POST" enctype="multipart/form-data">
				<input class="form-control" value="<?php echo $value['name']; ?>" type="text" name="al_name" placeholder="Alumni Name"><br>
				<input class="form-control" value="<?php echo $value['email']; ?>" type="email" name="al_mail" placeholder="Alumni Email"><br>
				<input class="form-control" value="<?php echo $value['number']; ?>" type="number" name="al_num" placeholder="Mobile Number"><br>
				<textarea class="form-control" placeholder="Address" rows="4" name="al_add"><?php echo $value['address']; ?></textarea><br>
				<textarea class="form-control" placeholder="Alumni Details" rows="4" name="al_det"><?php echo $value['details']; ?></textarea><br>
				<input type="file" name="image" class="form-control">
				<span style="color: red;">Max image size 1mb & use jpg image only.</span><br>
				<input class="btn btn-success btn-block" type="submit" name="al_update" value="Update Info">
			</form>

			<?php
					}
				}
			?>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 <!-- end of modal -->






 <!-- Modal for Make cost Curse-->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Alumni</h4>
        </div>
        <div class="modal-body">
         	<h2>Are You Sure? </h2>
         	<?php
         		$auiid = $_GET['id'];
				$get_imgi = "select img,al_id from alumni where al_id='$auiid'";
				$get_ii = $alsh->custom_query($pdo,$get_imgi);
				foreach ($get_ii as $value) {
					$ef = $value['img'];
					$fid = $value['al_id'];
				}
         	?>
         	<a href="?id=<?php echo $fid; ?>&del=1&im=<?php echo $ef; ?>" class="btn btn-danger">Delete</a>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 <!-- end of modal -->


<?php include 'footer.php'; ?>