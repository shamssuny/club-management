<?php include 'header.php'; ?>

<?php
	//init
	$bbl = new db();
?>

<style type="text/css">
	.blog-head{
		display: inline-block;
		margin-top: 10px;
	}

	.blog-head h2{
		display: inline;
	}
	.blog-head a{
		float:right;
		margin-top: 1px;
	}
	.blog-all{
		padding: 10px;
		font-weight: bold;
		border:2px dotted black;
	}
	.blog-all h3{
		transition: all 0.5s;
	}

	.blog-all h3:hover {
		text-decoration: underline;
	}
</style>

<div class="row">
	
	<div class="blog-main col-md-12">
		
		<div class="row">
			
			<div class="blog-head col-md-12">
				<?php
					//show success message
					if(isset($_GET['succ'])){
						echo "<p class='alert alert-success'>Blog Post Success!</p>";
						header("refresh:2;url=admin-blog.php");
					}

					//show erro on empty
					if(isset($_GET['err'])){
						echo "<p class='alert alert-danger'>Fields Cannot Be Empty!</p>";
						header("refresh:2;url=admin-blog.php");
					}

					//delete confirm show from show
					if (isset($_GET['d'])) {
						echo "<p class='alert alert-warning text-center'>Delete Successfull! </p>";
					}
				?>
				<h2>All Blogs</h2>
				<a href="" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Make A Notice</a>
				<hr style="border-color: black;">
			</div>

		</div>



		<div class="row">
			
			<div class="blog-show col-md-12">
				
				<?php
					//get all blog and show them
					$get_blog_q = "select * from blog ORDER BY b_id DESC";
					$get_blog = $bbl->custom_query($pdo,$get_blog_q);
					$i=1;
					foreach ($get_blog as $value) {
						$bid = $value['b_id'];
				?>
				<a href="<?php echo 'admin-blog-show.php?view='.$bid; ?>" >
				<div class="blog-all col-md-12">
					<h3 style="color: black;"><?php echo $i.'. '.$value['title']; ?></h3>
				</div>
				</a>
				<?php $i++;} ?>

			</div>

		</div>


	</div>

</div>




<!-- Modal for post blog Curse-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Post A Blog</h4>
        </div>
        <div class="modal-body">
        	<?php
        		//post a blog
        		if(isset($_POST['blog'])){
        			$blog_name = $_POST['bname'];
        			$blog_detail = $_POST['bdetail'];

        			if(empty($blog_name) && empty($blog_detail)){
        				header("location:admin-blog.php?err=1");
        			}else{
        				//insert blog into db
        				$make_blog_q = "insert into blog (title,detail) values ('$blog_name','$blog_detail')";
        				$bbl->custom_query($pdo,$make_blog_q);
        				header("location:admin-blog.php?succ=1");
        			}
        		}
        	?>
	          <form class="form-group" action="" method="POST">
	          	<input type="text" class="form-control" name="bname" placeholder="Blog Name"><br>
	          	<textarea class="form-control" name="bdetail" rows="6" placeholder="Blog Details"></textarea><br>
	          	<input class="btn btn-success" type="submit" name="blog" value="Make A Post">
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