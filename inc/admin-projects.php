<?php include 'header.php'; ?>

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

				//get delete success message from project show page
				if(isset($_GET['delsucc'])){
					echo "<p class='alert alert-success text-center'>Project Deleted Successfully!</p>";
				}



				//add a project
				if(isset($_POST['pr_save'])){

					$get_pr_nam = $_POST['pr_name'];
					$get_pr_auth = $_POST['pr_author'];
					$get_pr_des = $_POST['pr_des'];

					$file = $_FILES['pr_file']['name'];
					$tmp = $_FILES['pr_file']['tmp_name'];

					if(!empty($file) && !empty($tmp)){

						$info = new SplFileInfo($file);
						$file_ex = $info->getExtension();

						if($file_ex == "doc" || $file_ex == "docx" || $file_ex == "pdf"){

							//rename file name with the filetype
							if($file_ex == "doc"){
								$file = rand(0,1000)."".rand()."".rand().".doc";
							}else if($file_ex == "docx"){
								$file = rand(0,1000)."".rand()."".rand().".docx";
							}else if($file_ex == "pdf"){
								$file = rand(0,1000)."".rand()."".rand().".pdf";
							}

							if(!empty($get_pr_nam) && !empty($get_pr_auth) && !empty($get_pr_des)){

								$add_pr_q = "insert into projects (name, author, details, file) values ('$get_pr_nam','$get_pr_auth','$get_pr_des','$file')";
								$ad_pr->custom_query($pdo,$add_pr_q);
								move_uploaded_file($tmp, "img/project/".$file);
								echo "<p class='alert alert-success text-center'>Project Added Successfully !</p>";

							}else{
								echo "<p class='alert alert-danger text-center'>Invalid Input or File is not Valid. Doc / docx / pdf preferred!</p>";
							}
						}else{
							echo "<p class='alert alert-danger text-center'>Invalid Input or File is not Valid. Doc / docx / pdf preferred!</p>";
						}

						
					}else{
						echo "<p class='alert alert-danger text-center'>Invalid Input or File is not Valid. Doc / docx / pdf preferred!</p>";
					}

				}
			?>
			
			<h3>All Projects</h3>
			<a href="" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add a Project</a>
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
					<a href="admin-project-show.php?id=<?php echo $value['id']; ?>" class="btn btn-info">Show Project</a>
				</div>


			</div>

			<?php
				$i++;
				}
			?>

		</div>



	</div>


</div>





<!-- Modal Curse-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add an Project</h4>
        </div>
        <div class="modal-body">
         
          	<form class="form-group" action="" method="POST" enctype="multipart/form-data">
				<input class="form-control" type="text" name="pr_name" placeholder="Project Name" required=""><br>
				<input class="form-control" type="text" name="pr_author" placeholder="Project Author" required=""><br>
				<textarea class="form-control" placeholder="Project Description" rows="5" name="pr_des" required=""></textarea><br>
				<input class="form-control" type="file" name="pr_file" placeholder="Project File" accept="" required=""><br>
				<input class="btn btn-primary btn-block" type="submit" name="pr_save" value="Add Project">

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