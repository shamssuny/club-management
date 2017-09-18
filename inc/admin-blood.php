<?php include 'header.php'; ?>

<?php
	//init
	$bl = new db();
?>

<style type="text/css">
	.blood-main input{
		margin-top: 10px;
	}

	.blood-res {
		overflow: auto;
		border:2px solid #434c27;
		border-radius: 5px;
		height: 400px;
	}
	.bl-det{
		margin-top: 5px;
	}
	.bl-det-main{
		border-bottom: 2px solid black;
	}
</style>

<div class="row">
	
	<div class="blood-main col-md-12">
		
		<h2 class="text-center">Search Blood</h2>

		<form class="form-group form-inline text-center" action="" method="POST">
			<label>Blood Group:</label>
			<select class="form-control" name="blood">
				<option>A+</option>
				<option>A-</option>
				<option>B+</option>
				<option>B-</option>
				<option>AB+</option>
				<option>AB-</option>
				<option>O+</option>
				<option>O-</option>
			</select>
			<label>Search Location:</label>
			<input style="margin: 0;" class="form-control" type="text" name="location" placeholder="Search Location"><br>
			<input class="btn btn-primary btn-block" type="submit" name="submit" value="Search">
			<hr style="border-color: black;">
		</form>


		<div class="blood-res col-md-12">
			
			<div class="row">
				
				<?php
					//search for the blood
					if(isset($_POST['submit'])){
						$grp = $_POST['blood'];
						$loc = $_POST['location'];
						$find_b_q = "select * from users where blood='$grp' and location LIKE '%$loc%'";
						$find_b = $bl->custom_query($pdo,$find_b_q);

						$i = 1;
						foreach ($find_b as $value) {
				?>


				<div class="bl-det-main col-md-12">
					<div class="bl-det col-md-3">
						<b><?php echo $i.". ".$value['name']; ?></b>
					</div>


					<div class="bl-det col-md-3 text-center">
						<p><?php echo $value['contact']; ?></p>
						
					</div>


					<div class="bl-det col-md-3 text-center">
						<p><?php echo $value['blood'];  ?></p>
						
					</div>


					<div class="bl-det col-md-3 text-center">
						<p><?php echo $value['location'];  ?></p>
						
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

</div>

<?php include 'footer.php'; ?>