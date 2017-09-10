<?php include 'user-head.php'; ?>

<?php
	//init
	$shn = new db();
?>

<style type="text/css">
	.not-all p{
		font-size:20px;
	}
</style>

<div class="row">
	
	<div class="not-show col-md-12">

		<?php
			//show the notice
			if(isset($_GET['v'])){
				$ah = $_GET['v'];
				$sh_q = "select * from noticeboard where id='$ah'";
				$sh = $shn->custom_query($pdo , $sh_q);

				foreach ($sh as $value) {
		?>

		
		
		<div class="not-all col-md-12">
			<h2><?php echo $value['notice_title']; ?></h2>
			<hr style="border-color: black;">
			<p><?php echo $value['notice_details']; ?></p>	
		</div>

		<?php
				}
			}			
		?>

	</div>

</div>

<?php include 'user-footer.php'; ?>