<?php
	//include db class
	include 'db.php';
	$in = new db();

	//get data from database 
	$res = $in->getalldata($pdo , "frontpage");
	foreach ($res as $value) {
		
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="css/home.css">

	<script src="js/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
</head>
<body>

<!-- main section start -->

<div class="container-fluid">
	
	<div class="row">
		
		<!-- main body -->
		<div class="main col-md-12">
			
			<!-- header start -->
			<div class="row">
				<div class="header col-md-12 navbar-fixed-top">
										
					<div class="row">

						<!-- left header start -->
						<div class="left-head col-md-6">
							<h3>
								<?php
									echo $value['club_name'];
								?>
							</h3>
						</div>
						<!-- left header end -->


						<!-- right head start -->
						<div class="right-head col-md-6">
							<ul>
								<li><a href="#home">Home |</a></li>
								<li><a href="#about"> About Us |</a></li>
								<li><a href="#team"> Our Team |</a></li>
								<li><a href="#notice"> Notices |</a></li>
								<li><a href="#contact"> Contact Us </a></li>
							</ul>
						</div>
						<!-- right head end -->

					</div>
					


				</div>
			</div>
			<!-- header end -->



			<!-- slider start -->

			<div class="row">
				<div id="home" class="slider col-md-12">
					<!-- slider text start -->
					<div class="row">
						<div class="slider-text col-md-6 col-md-offset-6">
							<h2>
								<?php
									echo $value['slider_title'];
								?>
							</h2>
						</div>
					</div>
					<!-- slider text end -->
				</div>
			</div>

			<!-- slider end -->


			<!-- about us start -->

			<div class="row">
				<div id="about" class="about-main col-md-12">
					
					<!-- about details start -->
					<div class="row">
						<div class="about-head col-md-12">
							<h2>ABOUT US</h2>
						</div>
					</div>


					<div class="row">
						<div class="about-detail col-md-8 col-md-offset-2">
							<h3>
								<?php
									echo $value['about'];
								?>
							</h3>
						</div>
					</div>
					<!-- about details end -->

				</div>
			</div>

			<!-- about us end -->



			<!-- team start -->
			<div class="row">
				
				<div id="team" class="main-team col-md-12">

					<h2 style="text-align: center;padding-bottom: 3%;"><b>MEET THE TEAM</b></h2>
					
					<!-- team details start -->
					<div class="row">
						<div class="team-details-main col-md-12">
							
							<div class="row">
								<div class="team-details col-md-3">
									<img src="img/t1.jpg">
									<h3>
										<?php
											echo $value['team1_name'];
										?>
									</h3>
									<p>
										<?php
											echo $value['team1_title'];

										?>
									</p>
								</div>


								<div class="team-details col-md-3">
									<img src="img/t2.jpg">
									<h3>
										<?php
											echo $value['team2_name'];

										?>
									</h3>
									<p>
										<?php
											echo $value['team2_title'];

										?>
									</p>
								</div>


								<div class="team-details col-md-3">
									<img src="img/t3.jpg">
									<h3>
										<?php
											echo $value['team3_name'];

										?>
									</h3>
									<p>
										<?php
											echo $value['team3_title'];

										?>
									</p>
								</div>


								<div class="team-details col-md-3">
									<img src="img/t4.jpg">
									<h3>
										<?php
											echo $value['team4_name'];

										?>
									</h3>
									<p>
										<?php
											echo $value['team4_title'];

										?>
									</p>
								</div>
							</div>

						</div>
					</div>
					<!-- team details end -->
					<?php 
						}
						//end of foreach loop
					 ?>
				</div>

			</div>
			<!-- team end -->



			<!-- Notice / event start-->

					<div class="row">
						<div id="notice" class="notice-main col-md-12">

							<h2><b>Latest Events / Notices</b></h2>
							
							<!-- notice main section start -->

							<div class="row">
								
								<div class="notice col-md-6">
									<h3>Latest notices</h3>
									<div class="notice-outfit">
										
										<div class="notice-sc" >
											<marquee behavior="scroll" direction="up" style="height:145px;width: 100%;text-align: center;" onmouseover="this.stop();" onmouseout="this.start();" scrolldelay="150">
										<?php
												//get latest notice from noticeboard
												$not_query = "select * from noticeboard where mark='yes'";
												$l_notice = $in->custom_query($pdo,$not_query);

												foreach ($l_notice as $value) {
													
												
											?>
										<p style="border-bottom: 2px dotted white;">
											<?php echo "<b>".$value['notice_title']."</b>"; ?>
										</p>
										<?php
											} //end of latest notice
										?>
											</marquee>
										</div>

									</div>
								
									<a href="user-notice.php" style="color: white;">All Notices</a>
								</div>


								<div class="event col-md-6">
									<h3>Latest Events</h3>
									<div class="event-outfit">
										<div class="event-sc">
											<marquee behavior="scroll" direction="up" style="height:145px;width: 100%;" onmouseover="this.stop();" onmouseout="this.start();" scrolldelay="150">
												<?php
													//get latest event
													$get_ev = "select * from events where new='yes'";
													$ev = $in->custom_query($pdo,$get_ev);

													foreach ($ev as $value) {
														echo "<b><p style='border-bottom:2px dotted white;text-align:center;'>".$value['name']."</p></b>";
													}
												?>
											</marquee>
										</div>
									</div>
									<a href="user-event.php" style="color: white;">All Events</a>
								</div>

							</div>

							<!-- notice section end -->

						</div>
					</div>

					<!-- notice event end -->




					<!-- contact us start -->
					<div class="row">
						<div id="contact" class="contact-main col-md-12">

							<h2 style="text-align: center;font-weight: bolder;">CONTACT US</h2>
							<?php

							if(isset($_POST['send_mail'])){
								$u_name = $_POST['uname'];
								$u_email = $_POST['uemail'];
								$u_msg = $_POST['umessage'];

								if (!filter_var($u_email, FILTER_VALIDATE_EMAIL) === false && !empty($u_name) && !empty($u_email)&&!empty($umessage)) {

									$subject = "Club Manager: ".$u_email;
									$message = "Mail : ".$u_email."\n"."Name : ".$u_name."\n"."Message : ".$u_msg;
									//get email from db
									$get = $in->getalldata($pdo,"frontpage");
									foreach ($get as $val) {
										$ad_mail = $val['email'];
									}

									mail($ad_mail, $subject, $message);
									echo "<div class='alert alert-success'>SEND SUCCESSFULLY!</div>";
    								
								} else {
    								echo("<div class='alert alert-danger'>Email is not valid / Fields are empty/invalid!</div>");
								}
					}

							?>
							<div class="row">
								<div class="contact">
									<form class="form-group" action="" method="POST">
										<input class="form-control input-lg" type="text" name="uname" placeholder="Your Name">
										<input class="form-control input-lg" type="email" name="uemail" placeholder="Your Email">
										<textarea class="form-control input-lg" name="umessage" placeholder="Your Message" rows="5"></textarea>
										<input class="btn btn-success btn-lg btn-block" type="submit" name="send_mail" value="Submit">
									</form>
								</div>
							</div>

						</div>
					</div>
					<!-- contact us end -->




					<!-- footer start -->
					<div class="row">
						<div class="footer-main col-md-12">
							<a href="admin-login.php">Admin Login</a> ||
							<a href="user-login.php">User Login</a>
							<h3>&copy; 2017 All Rights Reserverd !</h3>
						</div>
					</div>
					<!-- footer end -->




		</div>
		<!-- main body end -->

	</div>

</div>

<!-- main section end -->















<script>
$(document).ready(function(){
  // Add scrollspy to <body>
  $('body').scrollspy({target: ".header", offset: 50});   

  // Add smooth scrolling on all links inside the navbar
  $(".right-head a").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    }  // End if
  });
});
</script>
</body>
</html>