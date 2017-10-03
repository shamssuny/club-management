<?php include 'header.php'; ?>

<?php
	//init
	$adhsh = new db();
?>

<style type="text/css">
	.admin-hlp-up{
		display: inline-block;
		border-bottom: 2px solid black;
	}
	.admin-hlp-up h3{
		display: inline-block;
	}

	.admin-hlp-up a{
		float: right;
		margin-right: 5px;
		margin-top: 10px;
	}
	.admin-hlp-ques{
		border-bottom: 2px solid black;
	}

	.admin-hlp{
		border:2px solid green;
		padding: 8px;
		border-radius: 8px;
		margin-top: 8px;
		margin-bottom: 5px;
		height: 320px;
	}

	.admin-hlp-det{
		border-bottom: 2px dotted black;
	}
</style>

<div class="row">
	
	<div class="admin-hlp-sh col-md-12">
		
		<div class="admin-hlp-up col-md-12">

			<?php
				//mark as complete
				if(isset($_GET['comp'])){
					$qqd = $_GET['q'];
					$up_q = "update help_question set chk='close' where q_id='$qqd'";
					$adhsh->custom_query($pdo,$up_q);
					echo "<p class='alert alert-warning text-center'>Marked As Complete! User cannot reply anumore! </p>";
				}

				//get the delete request and delete
				if(isset($_GET['del'])){
					$del_d = $_GET['q'];
					$del_answer = "delete from help_answer where q_id='$del_d'";
					$adhsh->custom_query($pdo,$del_answer);
					$del_ques = "delete from help_question where q_id='$del_d'";
					$adhsh->custom_query($pdo,$del_ques);
					header("location: admin-help.php?delsucc=1");
				}
			?>
			
			<h3>Request Details</h3>
			<a class="btn btn-warning" href="" data-toggle="modal" data-target="#myModal">Delete Request</a>
			<a class="btn btn-info" href="" data-toggle="modal" data-target="#myModal1">Mark As Complete</a>

		</div>


		<div class="admin-hlp-ques col-md-12 text-center">
			<h4>
				<?php
					//get the question
					if(isset($_GET['q'])){
						$thq = $_GET['q'];
						$get_q = "select help_q from help_question where q_id='$thq'";
						$get_qq = $adhsh->custom_query($pdo,$get_q);
						foreach ($get_qq as $value) {
							echo $value['help_q'];
						}
					}
				?>
			</h4>
		</div>


		<div class="admin-hlp  col-md-12">

			<?php
				//show user admin conversation
				if(isset($_GET['q'])){
					$q_id = $_GET['q'];
					$get_conv_q = "select * from help_answer where q_id='$q_id'";
					$get_conv = $adhsh->custom_query($pdo,$get_conv_q);

					foreach ($get_conv as $value) {
			
			?>
			
			<div class="admin-hlp-det col-md-12">
				<label>
					<?php
						//see if admin replied
						if($value['admin'] == "no"){
							echo "User : ";
						}else{
							echo "Admin : ";
						}
					?>
				</label>
				<span><?php echo $value['h_ans']; ?></span>
			</div>

			<?php
				}
			}
			?>

		</div>



		<div class="admin-hlp-rep col-md-12">

			<?php
				//admin make a reply and make anwser in help_question table
				if(isset($_POST['repl'])){
					$the_ad_msg = $_POST['ad_rep'];
					$ad_reply_q = "insert into help_answer (q_id,admin,h_ans) values ('$q_id','yes','$the_ad_msg')";
					$ch_q_t = "update help_question set chk='yes' where q_id='$q_id'";
					$adhsh->custom_query($pdo,$ad_reply_q);
					$adhsh->custom_query($pdo,$ch_q_t);
					header("Refresh:0");
				}
			?>
			
			<form action="" method="POST" class="form-group">
				<textarea rows="5" class="form-control" name="ad_rep"></textarea><br>
				<input type="submit" name="repl" value="Reply Message" class="btn btn-success">
			</form>

		</div>




	</div>

</div>



 <!-- Modal for Make cost Curse-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Request</h4>
        </div>
        <div class="modal-body">
         	<h2>Are you sure you want to delete thi thread?</h2>
         	<a href="?q=<?php echo $q_id; ?>&del=1" class="btn btn-danger">Yes. Do it Now!!</a>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 <!-- end of modal -->






  <!-- Modal for Make cost Curse-->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Mark as Complete?</h4>
        </div>
        <div class="modal-body">
         	<h2>Are you sure you want to mark as complete?</h2>
         	<a href="?q=<?php echo $q_id; ?>&comp=1" class="btn btn-warning">Yes , Do it!!</a>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 <!-- end of modal -->

<?php include 'footer.php'; ?>