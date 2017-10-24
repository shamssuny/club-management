<?php 
	include 'event-header.php';
?>

<?php
	//initialize db object
	$ev = new db();
?>

<style type="text/css">
	.event-up{
		margin-top: 10px;
	}
	.event-up h2{
		margin:0;
		padding: 0;
		display: inline-block;
	}
	.event-new {
		background-color: #256051;
		border-radius: 20px;
		margin-top: 5px;
	}
	.event-new p{
		display: inline-block;
		margin-top: 10px;
	}

</style>

<div class="row">
	<div class="event-main-area col-md-12">
		

		<div class="row">
			<div class="event-up col-md-12">

				<?php
					if(isset($_GET['success'])){
						echo "<p class='alert alert-success'>Event Delete Successfull</p>";
						header("refresh:3;url=admin-event.php");
					}
				?>
				<a class="btn btn-warning" href="admin-make-event.php">Make New Event</a>
				<a class="btn btn-info" href="admin-make-vol.php">Make volunteer</a>
				
				<a style="float:right;" class="btn btn-success" href="admin-archive-event.php">Archive Events</a>
			</div>
		</div>

		<div class="row">
			<div class="event-list col-md-12">
				<hr style="border-color: black;">
				<h2 class="text-center">Running Events</h2>
				<hr style="border-color: black;">


				<?php

					//get archive status
					if(isset($_GET['ar'])){
						$e_id = $_GET['ar'];

						$arc_q = "update events SET new='no' where ev_id='$e_id'";
						$ev->custom_query($pdo,$arc_q);
						echo "<p class='alert alert-success text-center'>Event Marked As Archived!</p>";
						header("refresh:3;url=admin-event.php");
					}



					//get new events
					$new_ev_q = "SELECT * FROM events WHERE new='yes' ORDER BY ev_id DESC";
					$get_new = $ev->custom_query($pdo,$new_ev_q);

					foreach ($get_new as $value) {
						$evid = $value['ev_id'];
				?>
				<div class="event-new col-md-12">
					<a href="<?php echo 'admin-event-show.php?evid='.$evid; ?>"><p><?php echo "".$value['name'].""; ?></p></a>
					<a class="btn btn-danger" style="float: right;margin-top: 3px;" href="?ar=<?php echo $evid; ?>">mark as archive</a>
				</div>

				<?php
					}
				?>




			</div>
		</div>

	</div>
</div>




<?php 
	include 'footer.php';
?>