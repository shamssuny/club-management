<?php include 'header.php'; ?>

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


				//delete a project

				if(isset($_GET['del'])){
					$delid = $_GET['id'];

					//at first delete the file
					$get_del_file_q = "select file from projects where id='$gl_id'";
					$get_del = $pr_sh->custom_query($pdo,$get_del_file_q);
					foreach ($get_del as $value) {
						$del_file = $value['file'];
						unlink("img/project/".$del_file);
					}

					//delete the db row
					$del_pr = "delete from projects where id='$delid'";
					$pr_sh->custom_query($pdo,$del_pr);
					header("location:admin-projects.php?delsucc=1");
				}




				//update the project

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
								$file = rand(1,1000)."".rand(0,1000)."".rand()."".rand().".doc";
							}else if($file_ex == "docx"){
								$file = rand(1,1000)."".rand(0,1000)."".rand()."".rand().".docx";
							}else if($file_ex == "pdf"){
								$file = rand(1,1000)."".rand(0,1000)."".rand()."".rand().".pdf";
							}


							$get_prev_file_q = "select file from projects where id='$gl_id'";
							$get_prev_file = $pr_sh->custom_query($pdo,$get_prev_file_q);

							foreach ($get_prev_file as $value) {
								$prev_file_nam = $value['file'];
								
							}
							unlink("img/project/".$prev_file_nam);

							move_uploaded_file($tmp, "img/project/".$file);

						}else{
							echo "<p class='alert alert-danger text-center'>Fileds cannot be empty or invalid file type. Need docx,doc or pdf</p>";
						}

					}

					if(!empty($get_pr_nam) && !empty($get_pr_auth) && !empty($get_pr_des)){
						$update_data = "update projects set name='$get_pr_nam',author='$get_pr_auth',details='$get_pr_des',file='$file' where id='$gl_id'";
						$pr_sh->custom_query($pdo,$update_data);
						echo "<p class='alert alert-success text-center'>Data Upadated!! </p>";
					}else{
						echo "<p class='alert alert-danger text-center'>Fileds cannot be empty or invalid file type. Need docx,doc or pdf</p>";

					}
				}
			?>
			
			<h2>Project Details</h2>
			<a href="" class="btn btn-success" data-toggle="modal" data-target="#myModal">Update Project</a>
			<a href="" class="btn btn-warning" data-toggle="modal" data-target="#myModal1">Delete Project</a>
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




<!-- Modal Curse-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Project</h4>
        </div>
        <div class="modal-body">
         	<?php
         		//set the values to the field
         		$get_project_data_q = "select * from projects where id='$pr_id'";
         		$get = $pr_sh->custom_query($pdo,$get_project_data_q);

         		foreach ($get as $value) {
         		
         	?>
          	<form class="form-group" action="" method="POST" enctype="multipart/form-data">
				<input class="form-control" value="<?php echo $value['name']; ?>" type="text" name="pr_name" placeholder="Project Name"><br>
				<input class="form-control" type="text" value="<?php echo $value['author']; ?>" name="pr_author" placeholder="Project Author"><br>
				<textarea class="form-control" placeholder="Project Description" rows="5" name="pr_des"><?php echo $value['details']; ?></textarea><br>
				<input class="form-control" type="file" name="pr_file" placeholder="Project File" accept="application/pdf,application/doc,application/docx"><br>
				<input class="btn btn-primary btn-block" type="submit" name="pr_save" value="Update Project">

			</form>

			<?php
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







 <!-- Modal Curse-->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Project</h4>
        </div>
        <div class="modal-body">
         
          	<h2>Are You Sure to Delete?</h2>
          	<a href="?id=<?php echo $gl_id; ?>&del=1" class="btn btn-danger">Yes! Delete</a>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 <!-- end of modal -->

<?php include 'footer.php'; ?>