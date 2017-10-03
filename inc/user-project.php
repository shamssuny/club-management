<?php include 'user-head.php'; ?>

<?php
	//init
	$ad_pr = new db();
?>

<style type="text/css">
	.project-up{
		display: inline-block;
	}
	.project-up h3{
		display: inline-block;
	}
	.project-up a{
		margin-top: 20px;
		float: right;
	}

	.project{
		border: 2px solid black;
		border-radius: 10px;
		padding: 10px;
		overflow: auto;
		height: 450px;
	}
	.project-list{
		border-bottom: 1px solid grey;
		padding-bottom: 8px;
	}

	.project-show p{
		margin-top: 10px;
	}

	.project-show a{
		margin-top: 5px;
	}
</style>

<div class="row">
	

	<div class="project-main col-md-12">
		
		<div class="project-up col-md-12">

			<?php
			?>
			
			<h3>All Projects</h3>
			<hr style="border-color: black;">

		</div>



		<div class="project-mid col-md-12 text-center">
			
			<form class="form-group form-inline" method="POST" action="">
				<input class="form-control" type="text" name="pro_src" placeholder="Search Project">
				<input class="btn btn-success" type="submit" name="src" value="Search">
				<a href="" class="btn btn-primary">Show All</a>
			</form>


		</div>




		<div class="project col-md-12">

			<?php
				//search project
				if(isset($_POST['src'])){
					$sr_q = $_POST['pro_src'];
					$sr = "select * from projects where name like '%$sr_q%'";
					$sr_res = $ad_pr->custom_query($pdo,$sr);
					$i = 1;
					foreach ($sr_res as $value) {
						
				?>

				<div class="project-list col-md-12 ">
				

					<div class="project-show col-md-4">
						<p><b><?php echo $i." |"; ?></b></p>
					</div>


					<div class="project-show col-md-4">
						<p><?php echo $value['name']; ?></p>
					</div>


					<div class="project-show col-md-4 text-center">
						<a href="user-project-show.php?id=<?php echo $value['id']; ?>" class="btn btn-info">Show Project</a>
					</div>


				</div>

				<?php
					}
				}else{

				//show all projects
				$all_project = $ad_pr->getalldatadesc($pdo , "projects", "id");
				$i = 1;
				foreach ($all_project as $value) {
					
			?>
			
			<div class="project-list col-md-12 ">
				

				<div class="project-show col-md-4">
					<p><b><?php echo $i." |"; ?></b></p>
				</div>


				<div class="project-show col-md-4">
					<p><?php echo $value['name']; ?></p>
				</div>


				<div class="project-show col-md-4 text-center">
					<a href="user-project-show.php?id=<?php echo $value['id']; ?>" class="btn btn-info">Show Project</a>
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