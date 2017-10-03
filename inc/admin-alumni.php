<?php include 'header.php'; ?>

<?php
	//init
	$alum = new db();
?>

<style type="text/css">
	.alumni-up{
		display: inline-block;
		border-bottom: 2px solid black;
	}

	.alumni-up h2{
		display: inline-block;
	}

	.alumni-up a{
		float: right;
		margin-top: 15px;
	}

	.alumni-src{
		margin-top: 8px;
	}

	.alumni-det-main{
		border:2px solid blue;
		border-radius: 10px;
		padding: 10px;
		height: 450px;
		overflow: auto;
	}

	.alumni-det{
		padding: 5px;
		border-bottom: 1px dotted black;
	}

	.alumni-select a{
		margin-top: 15px;
	}

</style>

<div class="row">
	
	<div class="alumnni-main col-md-12">

		<?php

			//get delete success msg from alumni show
			if(isset($_GET['dsucc'])){
				echo "<p class='alert alert-danger text-center'>Alumni Deleted Successfully !</p>";
			}



			//get add new alumni data
			if(isset($_POST['al_save'])){
				$get_al_name = $_POST['al_name'];
				$get_al_mail = $_POST['al_mail'];
				$get_al_num = $_POST['al_num'];
				$get_al_add = $_POST['al_add'];
				$get_al_det = $_POST['al_det'];


				$file = $_FILES['image']['name'];
				$file = rand()."".rand().".jpg";
				$tmp = $_FILES['image']['tmp_name'];
				$size = $_FILES['image']['size'];

				if(!empty($file) && !empty($tmp)){

					if(empty($get_al_name) && empty($get_al_mail) && empty($get_al_num) && empty($get_al_add) && empty($get_al_det)){

					echo "<p class='alert alert-danger text-center'>Fields Cannot be Empty! Or image size should be jpg and under 1MB!!</p>";

					}else{
						if(exif_imagetype($tmp) != IMAGETYPE_JPEG || $size > 1485760 ){
							echo "<p class='alert alert-danger text-center'>Fields Cannot be Empty! Or image size should be jpg and under 1MB!!</p>";
						}
						else{
							move_uploaded_file($tmp,"img/alumni/".$file);
							//insert data into db
							$add_alum = "insert into alumni (name,email,number,address,details,img) values ('$get_al_name','$get_al_mail','$get_al_num','$get_al_add','$get_al_det','$file')";
							$alum->custom_query($pdo,$add_alum);
							echo "<p class='alert alert-success text-center'>Alumni Added Succesfull !</p>";
						}
						
					}

				}else{
					echo "<p class='alert alert-danger text-center'>Fields Cannot be Empty! Or image size should be jpg and under 1MB!!</p>";
				}

				

			}
			//end of alumni added code
		?>
		
		<div class="alumni-up col-md-12">
			
			<h2 style="text-align: center;">Manage Alumni</h2>
			<a class="btn btn-primary" data-toggle="modal" data-target="#myModal" href="">Add Alumni</a>

		</div>


		<div class="alumni-ex col-md-12 text-center">
			
			<div class="alumni-src col-md-12">
				
				<form class="form-inline form-group" action="" method="POST">
					<input class="form-control" type="text" name="alumni_name" placeholder="Alumni Name">
					<input class="btn btn-warning" type="submit" name="src_alumni" value="Search">
					<a class="btn btn-success" href="">Show All</a>
				</form>

			</div>

		</div>




		<div class="alumni-det-main col-md-12">
			
			<?php

				//show searched result
				if(isset($_POST['src_alumni'])){
					$qr = $_POST['alumni_name'];
					$get = "select * from alumni where name like '%$qr%'";
					$get_data = $alum->custom_query($pdo,$get);
					$i = 1;
					foreach ($get_data as $value) {
						$a_img = $value['img'];
						$a_id = $value['al_id'];
				
			?>



			<div class="alumni-det col-md-12">
				
				<div class="alumni-select col-md-4 text-center">
					<b><?php echo $i.". "; ?></b>
					<img src="img/alumni/<?php echo $a_img; ?>" width="80px" height="80px">
				</div>


				<div class="alumni-select col-md-4 text-center">
					<h3><?php echo $value['name']; ?></h3>
				</div>


				<div class="alumni-select col-md-4 text-center">
					<a href="<?php echo 'admin-alumni-show.php?id='.$a_id; ?>" class="btn btn-primary">Show Details</a>
				</div>

			</div>	




			<?php
					}

				}else{



				//show alumni
				$get_alum = $alum->getalldata($pdo,"alumni");
				$i = 1;
				foreach ($get_alum as $value) {
					$a_img = $value['img'];
					$a_id = $value['al_id'];
			?>
			<div class="alumni-det col-md-12">
				
				<div class="alumni-select col-md-4 text-center">
					<b><?php echo $i.". "; ?></b>
					<img src="img/alumni/<?php echo $a_img; ?>" width="80px" height="80px">
				</div>


				<div class="alumni-select col-md-4 text-center">
					<h3><?php echo $value['name']; ?></h3>
				</div>


				<div class="alumni-select col-md-4 text-center">
					<a href="<?php echo 'admin-alumni-show.php?id='.$a_id; ?>" class="btn btn-primary">Show Details</a>
				</div>

			</div>

			<?php 
				$i++;} 
				}

			?>

		</div>





	</div>

</div>







<!-- Modal for Make cost Curse-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add an Alumni</h4>
        </div>
        <div class="modal-body">
         
          	<form class="form-group" action="" method="POST" enctype="multipart/form-data">
				<input class="form-control" type="text" name="al_name" placeholder="Alumni Name"><br>
				<input class="form-control" type="email" name="al_mail" placeholder="Alumni Email"><br>
				<input class="form-control" type="number" name="al_num" placeholder="Mobile Number"><br>
				<textarea class="form-control" placeholder="Address" rows="4" name="al_add"></textarea><br>
				<textarea class="form-control" placeholder="Alumni Details" rows="4" name="al_det"></textarea><br>
				<input type="file" name="image" class="form-control">
				<span style="color: red;">Max image size 1mb & use jpg image only.</span><br>
				<input class="btn btn-success btn-block" type="submit" name="al_save" value="Add Alumni">
			</form>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 <!-- end of modal -->





<?php include 'footer.php'; ?>