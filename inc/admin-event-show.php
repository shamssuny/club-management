<?php include 'event-header.php'; ?>

<?php
	//initialize
	$sh = new db();
?>


<style type="text/css">
	.show-head{
		display: inline-block;
		margin-top: 10px;
	}
	.show-head h2{
		display: inline;
	}
	.show-reg-user{

		overflow: auto;
		height: 300px;
		border:2px solid #213f59;
	}
	.uu-show{
		border-bottom: 2px solid black;
		padding: 5px;
	}
	.mr-tp{
		margin-top: 5px;
	}
</style>

<?php
	//delete event
	if(isset($_GET['del'])){
		$gid = $_GET['del'];
		//delete from event reg table . Foreign Key Constrains there.Then Delete from event table
		$del_reg_user_q = "delete from event_reg_users where eid='$gid'";
		$del_ev_q = "delete from events where ev_id='$gid'";
		$sh->custom_query($pdo,$del_reg_user_q);
		$sh->custom_query($pdo,$del_ev_q);
		header("location:admin-event.php?success=1");

	}


	//get event id
	if(isset($_GET['evid'])){
		$eeid = $_GET['evid'];
	}
?>

<div class="row">
	<div class="show-main col-md-12">


		
		<div class="show-head col-md-12">
			<h2>Event Info</h2>
			<a style="float: right;margin-top: 3px;" data-toggle="modal" data-target="#myModal" class="btn btn-danger" href="">Delete Event</a>
			<a style="float: right;margin-top: 3px;margin-right: 5px" data-toggle="modal" data-target="#myModal_u" class="btn btn-warning" href="">Update Event</a>
			<hr style="border-color: black;">
		</div>


		<div class="show col-md-12">

			<?php

				//update event data
				if(isset($_POST['submit'])){
					$evname = $_POST['ename'];
					$evdet = $_POST['edetail'];

					$up_ev_q = "update events set name='$evname',detail='$evdet' where ev_id='$eeid'";
					$sh->custom_query($pdo,$up_ev_q);
					echo "<p class='alert alert-success text-center'>Update Successfull!</p>";
				}


				//get event data
				if(isset($_GET['evid'])){
					$iid = $_GET['evid'];
					$get_q = "select * from events where ev_id='$iid'";
					$get_data = $sh->custom_query($pdo,$get_q);

					foreach ($get_data as $value) {
				
			?>


			<label>Event Name: </label>
			<h4><?php echo $value['name']; ?></h4>

			<label>Event Details:</label>
			<p><?php echo $value['detail']; ?></p>

			<?php 
					}//end of foreach
				}//end of isset
			?>
		</div>


		<div class="show-reg-top col-md-12">

			<?php
				//confirm user
				if(isset($_GET['conf'])){
					$eventid = $_GET['evid'];
					$userid = $_GET['conf'];

					$conf_q = "update event_reg_users set apprv='yes' where eid='$eventid' and uid='$userid'";
					$sh->custom_query($pdo,$conf_q);
					echo "<p class='alert alert-success'>User Confirmed!</p>";
					header("refresh:2;url=admin-event-show.php?evid=".$eventid);
				}

				//unconfirm user
				if(isset($_GET['unconf'])){
					$eventid = $_GET['evid'];
					$userid = $_GET['unconf'];

					$conf_q = "update event_reg_users set apprv='no' where eid='$eventid' and uid='$userid'";
					$sh->custom_query($pdo,$conf_q);
					echo "<p class='alert alert-warning'>User Unconfirmed!</p>";
					header("refresh:2;url=admin-event-show.php?evid=".$eventid);
				}
			?>


			<h2 style="display: inline-block;" class="">Registered Users</h2>
			<a href="<?php echo '?evid='.$eeid.'&sh_reg=1'; ?>" style="float: right;margin-top: 20px;" class="btn btn-info">Show Confirm Users</a>
			<a href="<?php echo '?evid='.$eeid; ?>" class="btn btn-info" style="float: right;margin-top: 20px;margin-right: 5px;">Show All</a>
		</div>

		<div class="show-reg-user col-md-12">
			<?php
				//get registered users list
				if(isset($_GET['sh_reg'])){
					$get_reg_q = "select * from event_reg_users where eid='$eeid' and apprv='yes'";

				}else{
					$get_reg_q = "select * from event_reg_users where eid='$eeid'";	
				}
				
				$get_reg = $sh->custom_query($pdo,$get_reg_q);

				$i=1;
				foreach ($get_reg as $value) {
					$uuid = $value['uid'];
					//get user data and show
					$g_uq = "select * from users where uid='$uuid'";
					$g_res = $sh->custom_query($pdo,$g_uq);
					foreach ($g_res as $dat) {
						$c_id = $dat['uid'];
			?>

			<div class="row">
				<div class="uu-show col-md-12">
					<div class="u-name col-md-3 mr-tp">
						<b><?php echo $i.". ".$dat['name']; ?></b>
					</div>

					<div class="u-mail col-md-3 mr-tp">
						<p><?php echo $dat['email']; ?></p>
					</div>

					<div class="u-phone col-md-3 mr-tp">
						<p><?php echo $dat['contact']; ?></p>
					</div>

					<div class="u-confirm col-md-3 text-center">
						<?php
							//get check if user registered or not and generate link
							$reg_c_q = "select * from event_reg_users where uid='$c_id' and eid='$eeid'";
							$reg_c = $sh->custom_query($pdo,$reg_c_q);

							foreach ($reg_c as $c) {
								$re_id = $c['uid'];
								if($c['apprv'] == "no"){
									echo "<a class='btn btn-primary' href='?evid=$eeid&conf=$re_id'>Confirm</a>";
								}else{
									echo "<a class='btn btn-warning' href='?evid=$eeid&unconf=$re_id'>Unconfirm</a>";
								}
							}
						?>
						
					</div>
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





<!-- Modal for Delete Curse-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">You are going to delete an event.</h4>
        </div>
        <div class="modal-body">
          <h2>Are You Sure ? </h2>
          <a class="btn btn-warning" href="<?php echo '?del='.$eeid; ?>">Yes Delete Event</a>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 <!-- end of modal -->




 <!-- Modal for Update Curse-->
  <div class="modal fade" id="myModal_u" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update event</h4>
        </div>
        <div class="modal-body">
          <?php
          	//show data on input Fields
          	$sh_q = "select * from events where ev_id='$eeid'";
          	$get_sh = $sh->custom_query($pdo,$sh_q);
          	foreach ($get_sh as $value) {

          ?>
          <form class="form-group" action="" method="POST">
	          <input class="form-control" type="text" name="ename" value="<?php echo $value['name']; ?>" placeholder="Update Event Name"><br>
	          <textarea class="form-control" rows="6" name="edetail" placeholder="Update Event Detais"><?php echo $value['detail']; ?></textarea><br>
	          <input class="btn btn-warning" type="submit" name="submit" value="Update Now">
          </form>
          <?php } ?>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 <!-- end of modal -->

<?php include 'footer.php'; ?>