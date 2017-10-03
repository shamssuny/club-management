<?php include 'user-head.php'; ?>

<?php
	//init
	$pr_sh = new db();
?>

<style type="text/css">
	
	.project-sh-up {
		display: inline-block;
	}
	.project-sh-up h2{
		display: inline-block;
	}
	.project-sh-up a{
		float: right;
		margin-right: 5px;
		margin-top: 20px;
	}

</style>

<div class="row">
	

	<div class="project-sh-main col-md-12">
		
		<div class="project-sh-up col-md-12">

			<?php
				if(isset($_GET['id'])){
					$gl_id = $_GET['id'];
				}

			?>
			
			
			<h2>Project Details</h2>
			<hr style="border-color: black;"> 

		</div>




		<div class="project-sh col-md-12">
			<?php
				//show the project
				if(isset($_GET['id'])){
					$pr_id = $_GET['id'];
					$get_proj_q = "select * from projects where id='$pr_id'";
					$get_proj = $pr_sh->custom_query($pdo,$get_proj_q);

					foreach ($get_proj as $value) {
						
			?>
			<label>Project Name: </label>
			<span><?php echo $value['name']; ?></span><br><br>
			<label>Project Author: </label>
			<span><?php echo $value['author']; ?></span><br><br>
			<label>Project Description: </label>
			<span><?php echo $value['details']; ?></span><br><br>

			<a href="img/project/<?php echo $value['file']; ?>" class="btn btn-info btn-block">Download/Show Project</a>

			<?php
					}
				}
			?>

		</div>



	</div>


</div>




<?php include 'user-footer.php'; ?>