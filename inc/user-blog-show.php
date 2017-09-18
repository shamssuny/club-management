<?php include 'user-head.php'; ?>

<?php
	//init
	$ush = new db();
?>

<style type="text/css">
	
</style>

<div class="row">
	
	<div class="user-sh-main col-md-12">

		<?php
			//delete a comment from the user
			if(isset($_GET['del'])){
				$get_com_id = $_GET['com_id'];
				$get_user_id = $_SESSION['id'];
				$del_com_q = "delete from blog_comment where uid='$get_user_id' and b_c_id='$get_com_id'";
				$ush->custom_query($pdo,$del_com_q);
				echo "<p class='alert alert-warning text-center'>Comment Deleted!</p>";
			}

			//make a comment in the blog post
			if(isset($_POST['comment'])){
				$coo = $_POST['comm'];
				$uu_id = $_SESSION['id'];
				$bl = $_GET['view'];
				if(!empty($coo)){
					$make_com = "insert into blog_comment (uid,bid,comment) values ('$uu_id','$bl','$coo')";
					$ush->custom_query($pdo,$make_com);
					echo "<p class='alert alert-success text-center'>Comment Successfull! </p>";
				}
			}
		?>
		
		<div class="user-sh col-md-12">
			<?php
				//show blog post
				if(isset($_GET['view'])){
					$bid = $_GET['view'];
					$uus = "select * from blog where b_id='$bid'";
					$uu = $ush->custom_query($pdo,$uus);

					foreach ($uu as $value) {
			?>
			<h2><?php echo $value['title']; ?></h2>
			<hr style="border-color: black;">
			<p><b><?php echo $value['detail']; ?></b></p>
			<?php			
					}
				}
				
			?>
		</div>


		<div class="user-sh-com col-md-12">

			<div class="comment-show col-md-12">
				<h2>Comments</h2>
				<?php
					//get comment for the post
					$g_com_q = "select * from blog_comment where bid='$bid' ORDER BY b_c_id DESC";
					$g_com = $ush->custom_query($pdo,$g_com_q);

					foreach ($g_com as $comm) {
						$comment_id = $comm['b_c_id'];
				?>
				
				<div class="comment-main col-md-12">
					<hr style="border-color: black;">
					<h4>
						<?php
							//get username from id
							$comenter_id = $comm['uid'];
							$get_commenter_name = "select * from users where uid='$comenter_id'";
							$get_username = $ush->custom_query($pdo,$get_commenter_name);
							foreach ($get_username as $uuaa) {
								echo $uuaa['name'];
							}
						?>
					</h4>

					<p><?php echo $comm['comment']; ?></p>
					<?php
						$curr_user = $_SESSION['id'];
						$loop_user = $comm['uid'];
						if($curr_user == $loop_user){
							echo "<a href='?view=$bid&del=1&com_id=$comment_id' style='color:red;'>delete</a>";
						}
					?>
				</div>
				<?php		
					}
				?>


			</div>
			
			
			<div class="comment-box col-md-12">
				<hr style="border:1px dotted black;">
				<form class="form-group" action="" method="POST">
					<textarea class="form-control" rows="5" name="comm" placeholder="Make a Comment Here"></textarea><br>
					<input type="submit" name="comment" class="btn btn-primary" value="Comment">
				</form>

			</div>

		</div>


	</div>
</div>

<?php include 'user-footer.php'; ?>