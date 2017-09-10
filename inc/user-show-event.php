<?php include 'user-head.php'; ?>

<?php
	//init
	$us = new db();

	//get the GET method data
	if(isset($_GET['event'])){
		$ev = $_GET['event'];
		$user_id = $_SESSION['id'];
	}
?>

<style type="text/css">
	
</style>

<div class="row">
	
	<div class="user-sh-main col-md-12">

		<?php
			//get error or success message
			if(isset($_GET['err'])){
				echo "<p class='alert alert-danger'>Already Registered!</p>";
			}
			if(isset($_GET['done'])){
				echo "<p class='alert alert-success'>Register Successful!</p>";
			}

			//check and register for the event
			if(isset($_GET['regsiterid'])){
				$e_id = $_GET['regsiterid'];
				$u_id = $_GET['userid'];

				$chek_reg_q = "select * from event_reg_users where eid='$e_id' and uid='$u_id'";
				$res_of_chk = $us->custom_query($pdo,$chek_reg_q);
				if($res_of_chk->rowCount() ==1 ){
					header("location:user-show-event.php?event=".$e_id."&err=1");
				}
				else{
					$reg_user_q = "insert into event_reg_users (uid,eid,apprv) values ('$u_id','$e_id','no')";
					$us->custom_query($pdo,$reg_user_q);
					header("location:user-show-event.php?event=".$e_id."&done=1");
				}
			}
		?>

		
		<h2 class="text-center">Event Details</h2>
		<hr style="border-color: black;">

		<?php
			//show event data
			$see_e_q = "select * from events where ev_id='$ev'";
			$see_e = $us->custom_query($pdo,$see_e_q);

			foreach ($see_e as $value) {
				$GLOBALS['ev_name'] = $value['name'];
		?>
		<label>Event Name:</label>
		<p><?php echo $value['name']; ?></p>
		<label>Event Details</label>
		<p><?php echo $value['detail']; ?></p>

		<?php } ?>

		<?php
			$butt_chk_q = "select * from event_reg_users where uid='$user_id' and eid='$ev'";
			$butt_res = $us->custom_query($pdo,$butt_chk_q);
			if($butt_res->rowCount() ==1 ){

		?>
		<a href="" class="btn btn-warning btn-block disabled"><b>Already Registered ! If You Are Selected You Will Get Ticket Here!</b></a>	

		<?php
			}else{

		?>
		<a href="<?php echo '?regsiterid='.$ev.'&userid='.$user_id; ?>" class="btn btn-success btn-block">Register Event</a>	
		<?php } ?>



		<?php
			//get Ticket if selected for the event
			$chk_user_confirm_q = "select * from event_reg_users where uid='$user_id' and eid='$ev'";
			$chk_user_confirm = $us->custom_query($pdo,$chk_user_confirm_q);
			foreach ($chk_user_confirm as $value) {
				if($value['apprv'] == "yes"){

					echo "<h2 class='alert alert-success text-center'>CONGRATS! You Have Been Selected.</h2>";

					//get user info for the ticket
					$get_user_q = "select * from users where uid='$user_id'";
					$get_user = $us->custom_query($pdo,$get_user_q);
					foreach ($get_user as $uu) {
						$user_name = $uu['name'];
						$user_email = $uu['email'];
						$user_contact = $uu['contact'];
						$us_id = $uu['uid'];


						
						//create jpg ticket with php image proceessor
						$im = imagecreatetruecolor(600, 400);

						$text_color = imagecolorallocate($im, 0, 0, 0);
						$rojo = imagecolorallocate($im, 186, 203, 211);
						imagefill($im, 0, 0, $rojo);

						imagettftext($im, 30, 0, 200, 50, $text_color, "fonts/lob.ttf", "Event Clearance");
						imagettftext($im, 22, 0, 30, 100, $text_color, "fonts/lob.ttf", "Event Name: ".$GLOBALS['ev_name']);
						imagettftext($im, 18, 0, 30, 200, $text_color, "fonts/lob.ttf", "Participant Name: ".$user_name);
						imagettftext($im, 18, 0, 30, 250, $text_color, "fonts/lob.ttf", "Participant Email: ".$user_email);
						imagettftext($im, 18, 0, 30, 300, $text_color, "fonts/lob.ttf", "Participant Contact: ".$user_contact);
						imagettftext($im, 18, 0, 30, 350, $text_color, "fonts/lob.ttf", "Participant ID: ".$us_id);
						// Save the image as 'simpletext.jpg'
						imagejpeg($im, "img/user/".$us_id.$ev.".jpg");

						// Free up memory
						imagedestroy($im);

						echo "<a class='btn btn-success text-center' href='img/user/$us_id$ev.jpg'>Click Here to get your Ticket!</a>";

					}

					
				}
			}
		?>

	</div>

</div>

<?php include 'user-footer.php'; ?>