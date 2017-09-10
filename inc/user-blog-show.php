<?php include 'user-head.php'; ?>

<?php
	//init
	$ush = new db();
?>

<style type="text/css">
	
</style>

<div class="row">
	
	<div class="user-sh-main col-md-12">
		
		<div class="user-sh col-md-12">
			<?php
				//show blog post
				if(isset($_GET['view'])){
					$bid = $_GET['view'];
					$uus = "select * from blog where b_id='$bid'";
					$uu = $ush->custom_query($pdo,$uus);

					foreach ($uu as $value) {
			?>
			<h2><?php echo $value['title']; ?></h2>
			<hr style="border-color: black;">
			<p><b><?php echo $value['detail']; ?></b></p>
			<?php			
					}
				}
				
			?>
		</div>


	</div>
</div>

<?php include 'user-footer.php'; ?>