<?php include 'user-head.php'; ?>

<?php
	//initialize db
	$uu = new db();
?>

<style type="text/css">
	.ev-up{
		display: inline-block;
		margin-top: 5px;
	}

	.ev-up h2{	
		display: inline;
	}

	.ev-al {
		margin-top: 5px;
		background-color: #507723;
		border-radius: 20px;
	}

	.ev-al p{
		padding: 10px;
		font-weight: bold;
		transition: all 1s;
	}
	.ev-al p:hover{
		text-decoration: underline;
	}

	.sh-ev{
		background-color: #1b421a;
		border-radius: 10px;
		margin-top: 5px;
		margin-bottom: 5px;
	}
	.sh-ev p{
		font-weight: bold;
	}

	.sh-ev p:hover{
		text-decoration: underline;
	}
</style>


<div class="row">
	<div class="ev-main col-md-12">
		
		<div class="ev-up col-md-12">
			
			<h2>Upcomming Events List</h2>
			<a style="float: right;margin-top: 3px;" class="btn btn-warning" href="" data-toggle="modal" data-target="#myModal">Your Events</a>
			<hr style="border-color: black;">
		</div>


		<div class="ev col-md-12">
			
			<?php
				//show upcomming event
				$up_ev_q = "select * from events where new='yes'";
				$get_up = $uu->custom_query($pdo,$up_ev_q);
				$i=0;
				foreach ($get_up as $value) {
					
			?>
			<a href="<?php echo 'user-show-event.php?event='.$value['ev_id']; ?>">
			<div class="ev-al">
				<?php echo "<p>".$value['name']."</p>"; ?>

			</div>
			</a>
			<?php } ?>

		</div>

	</div>
</div>



<!-- Modal for Show users Event Curse-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Your Registered Events.</h4>
        </div>
        <div class="modal-body">
          <?php
          	//get user register event list
          	$uuid = $_SESSION['id'];
          	$get_user_ev_q = "select * from event_reg_users where uid='$uuid'";
          	$get_user_ev = $uu->custom_query($pdo,$get_user_ev_q);

          	foreach ($get_user_ev as $uval) {
          		$eev = $uval['eid'];
          		
          		//get event details for show
          		$get_event_q = "select * from events where ev_id='$eev' ORDER BY ev_id DESC";
          		$get_event = $uu->custom_query($pdo,$get_event_q);
          		foreach ($get_event as $p) {
          				$ee = $p['ev_id'];
          ?>
          		<a href="<?php echo 'user-show-event.php?event='.$ee; ?>">
	          		<div class="sh-ev col-md-12">
	          			<p><?php echo $p['name']; ?></p>
	          		</div>
          		</a>
          <?php
          		}
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



<?php include 'user-footer.php'; ?>