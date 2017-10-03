<?php include 'user-head.php'; ?>

<?php
	//init
	$uhlp = new db();
?>

<style type="text/css">
	.user-help-up{
		display: inline-block;
	}
	.user-help-up h3{
		display: inline-block;
	}
	.user-help-up a{
		margin-top: 10px;
		float: right;
	}
	.user-help{
		border:2px solid green;
		border-radius: 10px;
		padding: 8px;
		overflow: auto;
		height: 450px;
	}

	.user-help-box{
		border-bottom: 2px dotted black;
	}
</style>

<div class="row">
	
	<div class="user-help-main col-md-12">
		
		<div class="user-help-up col-md-12">

			<?php
				//make a request
				if(isset($_POST['submit'])){
					$que = $_POST['req'];

					if(!empty($que)){
						$us_id = $_SESSION['id'];
						$add_req = "insert into help_question (help_q,uid,chk) values ('$que','$us_id','no')";
						$uhlp->custom_query($pdo,$add_req);
						echo "<p class='alert alert-success text-center'>Request Added Successfully!!</p>";
					}
				}
			?>
			
			<h3>Help Center</h3>
			<a href="" class="btn btn-success" data-toggle="modal" data-target="#myModal">Submit A Request</a>
			<hr style="border-color: black;">

		</div>



		<div class="user-help col-md-12">

			<?php
				//show the request by the user
				$get_u_id = $_SESSION['id'];
				$show_req_q = "select * from help_question where uid='$get_u_id' order by q_id DESC";
				$show_req = $uhlp->custom_query($pdo,$show_req_q);

				$i = 1;
				foreach ($show_req as $value) {
					
			?>
			
			<div class="user-help-box col-md-12 text-center">
				
				<div class="user-help-div col-md-4">
					<p><b><?php echo $i.". "; ?></b></p>
				</div>


				<div class="user-help-div col-md-4">
					<a style="color: black;text-decoration: underline;" href="user-help-show.php?q=<?php echo $value['q_id']; ?>&uid=<?php echo $get_u_id; ?>"><p><?php echo $value['help_q']; ?></p></a>
				</div>


				<div class="user-help-div col-md-4">
					<?php
						if($value['chk'] == "no"){

					?>
					<span class="label label-warning">Queued</span>
					<?php
						}else if($value['chk'] == "yes"){

					?>
					<span class="label label-success">Answered</span>
					<?php
						}else if($value['chk'] == "close"){
 
					?>
					<span class="label label-default">Cleared</span>
					<?php 
						}
					 ?>
				</div>

			</div>

			<?php 
				$i++;
				}

			 ?>

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
          <h4 class="modal-title">Submit a request</h4>
        </div>
        <div class="modal-body">
         	

        	<form class="form-group" action="" method="POST">
        		<textarea class="form-control" placeholder="Make Your Request" rows="5" name="req"></textarea><br>
        		<input type="submit" name="submit" value="Post A Request" class="btn btn-primary">
        	</form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 <!-- end of modal -->

<?php include 'user-footer.php'; ?>