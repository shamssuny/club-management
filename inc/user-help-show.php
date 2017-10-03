<?php include 'user-head.php'; ?>

<?php
	//init
	$uhsh = new db();
?>

<style type="text/css">
	.help-sh-box{
		overflow: auto;
		border:2px solid black;
		border-radius: 10px;
		padding: 8px;
		height: 300px;
		margin-bottom: 10px;
	}

	.help-sh-msg{
		border-bottom: 2px solid blue;
	}
</style>

<div class="row">
	
	<div class="help-sh-main col-md-12">
		
		<div class="help-sh-up col-md-12">
			<h3>Request Details</h3>
			<?php
				//show the question
				if(isset($_GET['q']) && $_SESSION['id'] == $_GET['uid']){
					$qq = $_GET['q'];
					$get_q_q = "select help_q from help_question where q_id='$qq'";
					$get_q = $uhsh->custom_query($pdo,$get_q_q);
					foreach ($get_q as $value) {
						
			?>
			<label>Question: </label>
			<span><?php echo $value['help_q']; ?></span>
			<?php
					}
				}
			?>
			<hr style="border-color: black;">
		</div>


		<div class="help-sh-box col-md-12">
			<?php
				//show the messages
				if(isset($_GET['q']) && $_SESSION['id'] == $_GET['uid']){
					$q_an = $_GET['q'];
					$get_msg_q = "select * from help_answer where q_id='$q_an'";
					$get_msg = $uhsh->custom_query($pdo,$get_msg_q);

					foreach ($get_msg as $value) {
							

			?>
			<div class="help-sh-msg col-md-12">
				<?php 
					if($value['admin'] == "yes"){

				?>
				<label>Admin: </label>				
				<?php		
					}else{
				 ?>
				<label>You: </label>				
				 <?php } ?>
				<span><?php echo $value['h_ans']; ?></span>

			</div>

			<?php 

					}
				}
			 ?>

		</div>

		<?php
			//check if the comment is closed
			$chk_p = "select chk from help_question where q_id='$qq'";
			$chl = $uhsh->custom_query($pdo,$chk_p);
			foreach ($chl as $value) {
				if($value['chk'] != "close"){

		?>

		<div class="help-sh-reply col-md-12">

			<?php
				//post a reply
				if(isset($_POST['reply']) && $_SESSION['id'] == $_GET['uid']){
					$ques_id = $_GET['q'];
					$msg = $_POST['g_msg'];
					$com = "insert into help_answer (q_id,admin,h_ans) values ('$ques_id','no','$msg')";
					$uhsh->custom_query($pdo,$com);
					//update question on queued
					$up_q_t = "update help_question set chk='no' where q_id='$ques_id'";
					$uhsh->custom_query($pdo,$up_q_t);
					header("Refresh:0");
				}
			?>
			
			<form class="form-group" action="" method="POST">
				<textarea name="g_msg" rows="4" class="form-control"></textarea><br>
				<input type="submit" value="Reply a Message" name="reply" class="btn btn-primary">
			</form>

		</div>

		<?php 
			}else{
				echo "<p class='alert alert-warning text-center'>This Request Marked As Complete By Admin! You cannot reply this conversation now.</p>";
			}
		}
		 ?>

	</div>

</div>

<?php include 'user-footer.php'; ?>