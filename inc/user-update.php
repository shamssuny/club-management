<?php include 'user-head.php'; ?>
<?php
//initialize object of db
$up = new db();

?>
<div class="row">
	<div class="main-update col-md-12">
		
		<div class="update-area col-md-12 text-center">
			<?php
				//get updated data and update
				if (isset($_POST['submit'])) {
					// $gname = $_POST['uname'];
					$gmail = $_POST['umail'];
					$grname = $_POST['urname'];
					$gnum = $_POST['unum'];
					$gblood = $_POST['blood'];
					$gid = $_SESSION['id'];
					$gdoner = $_POST['doner'];
					$gaddr = $_POST['addr'];
					if (!empty($gmail) && !empty($grname) &&!empty($gnum) && !empty($gblood) && !empty($gdoner)&& !empty($gaddr)) {
						$up_user_q = "update users SET email='$gmail',name='$grname',blood='$gblood',contact='$gnum',doner='$gdoner',location='$gaddr' where uid='$gid'";
						$up->custom_query($pdo,$up_user_q);
						echo "<p class='alert alert-success text-center'>Update Data Successfull!</p>";	
					}else{
						echo "<p class='alert alert-danger text-center'>Fileds Cannot Be Empty!</p>";	
					}
					

				}
			?>
			
			<h2>Update Profile</h2>
			
			<form class="form-group" action="" method="POST">
				<?php
					//get profile data and show with function for make dropdown selection
					$u_id =  $_SESSION['id'];
					$arr = array("A+","A-","B+","B-","AB+","AB-","O+","O-");
					$get_user_query = "select * from users where uid='$u_id'";
					$get_user_data = $up->custom_query($pdo , $get_user_query);

					foreach ($get_user_data as $value) {
						
				?>
				
				<input class="form-control" type="email" name="umail" value="<?php echo $value['email']; ?>" placeholder="Email Address"><br>
				<input class="form-control" type="text" name="urname" value="<?php echo $value['name']; ?>" placeholder="Full Name"><br>
				<input class="form-control" type="number" name="unum" value="<?php echo $value['contact']; ?>" placeholder="Your Mobile Number"><br>
				<label>Blood Group</label>

				<select class="form-control" name="blood">
					<option value="<?php echo $value['blood']; ?>"><?php echo $value['blood']; ?></option>
					<?php
						$i=0;
						$va = $value['blood'];
						while($i<8){
							if(strcmp($arr[$i], $va) !=0){
								$yo = $arr[$i];
								echo "<option value='$yo'>"."$yo</option>";	
							}
							
							$i++;
						}
					?>
					
					<?php  ?>
				</select><br>
				<label>Blood Doner? : </label>

				<input type="radio" name="doner" value="YES" <?php if($value['doner']=="YES"){echo "Checked";}; ?>>Yes
				<input type="radio" name="doner" value="NO" <?php if($value['doner']=="NO"){echo "Checked";}; ?>>NO
				<br><br>
				<label>Your Adress: <span> (Please Give Detail Info For Search Perpose)</span></label>
				<textarea class="form-control" name="addr" placeholder="Your Address"><?php echo $value['location']; ?></textarea><br>
				<input class="btn btn-primary" type="submit" name="submit" value="Update Info">
				<?php } ?>
			</form>

		</div>

	</div>
</div>

<?php include 'user-footer.php'; ?>