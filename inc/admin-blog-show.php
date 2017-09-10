<?php include 'header.php'; ?>

<?php
	//init
	$bsh = new db();
?>

<style type="text/css">
	.blog-sh-up{
		display: inline-block;
	}

	.blog-sh-up h2{
		display: inline-block;
	}
	.blog-sh-up a{
		margin-top: 20px;
		float: right;
		margin-right: 5px;
	}
</style>

<div class="row">
	
	<div class="blog-sh-main col-md-12">
		
		<div class="blog-sh-up col-md-12">

			<?php
				//get blog id
				if(isset($_GET['view'])){
					$pu = $_GET['view'];
				}
				//update post
				if(isset($_POST['update'])){
					$nam = $_POST['blname'];
					$des = $_POST['bldes'];

					if(!empty($nam) && !empty($des)){
						$up_q = "update blog set title='$nam',detail='$des' where b_id='$pu'";
						$bsh->custom_query($pdo,$up_q);
						echo "<p class='alert alert-success'>Update Successfull!</p>";
					}else{
						echo "<p class='alert alert-danger'>Invalid Input!</p>";
					}
				}

				//delete post
				if(isset($_GET['del'])){
					$del_q = "delete from blog where b_id='$pu'";
					$bsh->custom_query($pdo,$del_q);
					header("location:admin-blog.php?d=1");

				}

			?>

			<h2>News Details</h2>
			<a data-toggle="modal" data-target="#myModal" class="btn btn-warning" href="">Update Post</a>
			<a data-toggle="modal" data-target="#myModal1" class="btn btn-danger" href="">Delete Post</a>
			<hr style="border-color: black;">
		</div>


		<div class="blog-sh-det col-md-12">
			<?php
				//show the post data
				if(isset($_GET['view'])){
					$post_id =$_GET['view'];
					$sh_data_q = "select * from blog where b_id='$post_id'";
					$sh_dat = $bsh->custom_query($pdo,$sh_data_q);

					foreach ($sh_dat as $value) {
			?>


			<h3><?php echo $value['title']; ?></h3>

			<p><?php echo $value['detail']; ?></p>

			<?php			
					}
				}
			?>
		</div>

	</div>

</div>



<!-- Modal for update Curse-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Post</h4>
        </div>
        <div class="modal-body">
          

          <form class="form-group" action="" method="POST">
          <?php
        	//show th data for update
        	$get_dat = "select * from blog where b_id='$post_id'";
        	$dat_res = $bsh->custom_query($pdo,$get_dat);

        	foreach ($dat_res as $ssh) {
        		
          ?>
          	<input class="form-control" placeholder="Post Name" type="text" name="blname" value="<?php echo $ssh['title']; ?>"><br>
          	<textarea class="form-control" name="bldes" placeholder="Post Description" rows="7"><?php echo $ssh['detail']; ?></textarea><br>
          	<input class="btn btn-info" type="submit" name="update" value="Update Post">

          	<?php
          		}
          	?>
          </form>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 <!-- end of modal -->



 <!-- Modal for Delete Curse-->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Post</h4>
        </div>
        <div class="modal-body">
          <h2>Are You Sure ? </h2>
          <a href="<?php echo '?view='.$pu.'&del=1'; ?>" class="btn btn-danger">Yes Delete Post</a>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 <!-- end of modal -->


<?php include 'footer.php' ?>