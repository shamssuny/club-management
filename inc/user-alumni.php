<?php include 'user-head.php'; ?>

<?php
	//init
	$u_al = new db();
?>

<style type="text/css">
	.user-alumni{
		border:2px solid blue;
		border-radius: 10px;
		padding: 10px;
		overflow: auto;
		height: 450px;
	}

	.user-alumni-sh{
		border-bottom: 2px dotted black;
	}
	.user-alumni-data h4{
		margin-top: 25px;
	}
	.user-alumni-data a{
		margin-top: 20px;
	}
</style>

<div class="row">
	
	<div class="user-alumni-main col-md-12">
		
		<div class="user-alumni-up col-md-12">
			
			<h3>Alumni's List</h3>
			<hr style="border-color: black;">

		</div>



		<div class="user-alumni-src col-md-12 text-center">
			
			<form action="" method="POST" class="form-group form-inline">
				<input class="form-control" type="text" name="alumni_src" placeholder="Search Alumni">
				<input class="btn btn-success" type="submit" name="get_alumni">
				<a class="btn btn-info" href="">Show All</a>
			</form>
		</div>



		<div class="user-alumni col-md-12">

			<?php

				if(isset($_POST['get_alumni'])){
					$qr_data = $_POST['alumni_src'];
					$the_q = "select al_id,name,img from alumni where name like '%$qr_data%'";
					$qr = $u_al->custom_query($pdo,$the_q);
					$i=1;
					foreach ($qr as $value) {
				

				?>

				<div class="user-alumni-sh col-md-12 text-center">
				
					<div class="user-alumni-data col-md-4">
						<span><?php echo $i.". "; ?> </span>
						<img width="80px" height="80px" src="img/alumni/<?php echo $value['img']; ?>">
					</div>

					<div class="user-alumni-data col-md-4">
						<h4><?php echo $value['name']; ?></h4>
					</div>

					<div class="user-alumni-data col-md-4">
						<a href="user-alumni-show.php?id=<?php echo $value['al_id']; ?>" class="btn btn-primary">Show</a>
					</div>

				</div>


				<?php	
					}

				}else{

				//show the data
				$get_alumnis_q = "select al_id,name,img from alumni";
				$get_alumni = $u_al->custom_query($pdo,$get_alumnis_q);
				$i = 1;
				foreach ($get_alumni as $value) {
					
			
			?>
			
			<div class="user-alumni-sh col-md-12 text-center">
				
				<div class="user-alumni-data col-md-4">
					<span><?php echo $i.". "; ?> </span>
					<img width="80px" height="80px" src="img/alumni/<?php echo $value['img']; ?>">
				</div>

				<div class="user-alumni-data col-md-4">
					<h4><?php echo $value['name']; ?></h4>
				</div>

				<div class="user-alumni-data col-md-4">
					<a href="user-alumni-show.php?id=<?php echo $value['al_id']; ?>" class="btn btn-primary">Show</a>
				</div>

			</div>

			<?php 
				$i++;
				}
			}
			 ?>


		</div>


	</div>

</div>

<?php include 'user-footer.php'; ?>