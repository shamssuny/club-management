<?php include 'user-head.php'; ?>

<?php
	//init
	$u_al_sh = new db();
?>

<style type="text/css">
	.user-alum-right label{
		font-size: 20px;
		font-weight: bolder;
	}

	.user-alum-right span{
		font-size: 18px;
	}

</style>

<div class="row">
	
	<div class="user-alum-v main col-md-12">
		
		<div class="user-alum-up col-md-12">
			<h3>Alumni Details</h3>
			<hr style="border-color: black;">
		</div>


		<div class="user-alum col-md-12">

			<?php  
				//get alumni data
				if(isset($_GET['id'])){
					$a_id = $_GET['id'];
					$get_alum_q = "select * from alumni where al_id='$a_id'";
					$get_dat = $u_al_sh->custom_query($pdo,$get_alum_q);

					foreach ($get_dat as $value) {

				?>

			<div class="user-alum-left col-md-3">
				<img src="img/alumni/<?php echo $value['img']; ?>" width="100%;">
			</div>


			<div class="user-alum-right col-md-9">
				
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

			<?php 
				}
			}
			 ?>
			
		</div>

	</div>

</div>	

<?php include 'user-footer.php'; ?>