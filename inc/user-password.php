<?php
include 'user-head.php';

//init
$pass = new db();
?>

<style type="text/css">
	.change-pass{
		text-align: center;
	}

	.change-pass input{
		margin-top: 10px;
	}
</style>
							
							<div class="row">
								
								<div class="change-pass col-md-10 col-md-offset-1">
								<?php
									//check the old pass and make new one
									if(isset($_POST['change_pass'])){
										//get user old password
										$u_name = $_SESSION['name'];
										$get = "select * from users where username='$u_name'";
										$g_res = $pass->custom_query($pdo,$get);
										foreach ($g_res as $value) {
											$get_old = $value['password'];
										}
										//match old password
										$given_old_pass = md5($_POST['old_pass']);
										$given_new_pass = md5($_POST['new_pass']);

										if($get_old == $given_old_pass){
											$update_pass_q = "update users set password='$given_new_pass' where username='$u_name'";
											$pass->custom_query($pdo,$update_pass_q);
											echo "<p class='alert alert-success'>Password Updated Successfully.</p>";
										}else{
											echo "<p class='alert alert-danger'>Old Password Won't Match! .</p>";
										}
									}
								?>
									
									<h2>Change Password</h2>

									<form class="form-group" action="" method="POST">
										<input class="form-control" type="password" name="old_pass" placeholder="Old Password">
										<input class="form-control" type="password" name="new_pass" placeholder="New Password">
										<input class="btn btn-success" type="submit" name="change_pass" value="Change Password">
									</form>

								</div>

							</div>

<?php include 'user-footer.php'; ?>