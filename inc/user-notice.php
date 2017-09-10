<?php include 'user-head.php'; ?>

<?php
	//init
	$un = new db();
?>

<style type="text/css">
	.notice-all{
		background-color: #387c59;
		margin-top: 5px;
		border-radius: 10px;
	}
	.notice-all h3{}

	.notice-all h3:hover{
		text-decoration: underline;
	}
</style>

<div class="row">
	
	<div class="notice-main col-md-12">
		
		<h2 class="text-center">All Notices</h2>
		<hr style="border-color: black;">

		<?php
			//show notice to users
			$not_res = $un->getalldatadesc($pdo,"noticeboard","id");
			$i = 1;
			foreach ($not_res as $value) {
				$n_id = $value['id'];
		?>
		<a href="<?php echo 'user-notice-show.php?v='.$n_id; ?>" >
			<div class="notice-all col-md-12">
				<h3><?php echo $i.'. '.$value['notice_title']; ?></h3>
			</div>
		</a>
		<?php	
			$i++;}
		?>

	</div>

</div>



<?php include 'user-footer.php'; ?>