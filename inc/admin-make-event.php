<?php include 'header.php'; ?>

<?php
	//initialize db
	$event = new db();
?>

<div class="row">
	<div class="make-main col-md-12">

		<?php
			//get event info and insert in db
			if(isset($_POST['submit'])){
				$event_name = $_POST['evname'];
				$event_detail = $_POST['evdetail'];

				if(!empty($event_name) && !empty($event_detail)){
					$make_ev_q = "insert into events (name,detail,new) values ('$event_name','$event_detail','yes')";
					$make_ev = $event->custom_query($pdo,$make_ev_q);
					echo "<p class='alert alert-success text-center'>Event Created Successful!</p>";

				}else{
					echo "<p class='alert alert-danger text-center'>Fields Cannot Be Empty!</p>";
				}	
			}
			
		?>


		<h2>Make A New Event</h2>
		
		<form class="form-group" action="" method="POST">
			<label>Event Name</label>
			<input class="form-control" type="text" name="evname" placeholder="Event Name"><br>
			<label>Event Details</label>
			<textarea rows="7" class="form-control" name="evdetail" placeholder="Event Details"></textarea><br>
			<input class="btn btn-primary btn-lg" type="submit" name="submit" value="Make Event">
		</form>

	</div>
</div>

<?php include 'footer.php' ?>