<?php include 'header.php'; ?>

<?php
	//intialize
	$ol = new db();
?>

<style type="text/css">
	.archive {
		background-color: #256051;
		border-radius: 20px;
		margin-top: 5px;
	}
	.archive p{
		display: inline-block;
		margin-top: 10px;
	}
</style>

<div class="row">
	
	<div class="archive-main col-md-12">
		
		<h2 class="text-center">Archive Events</h2>

		<?php
			//mark new from archive
			if(isset($_GET['ar'])){
				$e_id = $_GET['ar'];

				$arc_q = "update events SET new='yes' where ev_id='$e_id'";
				$ol->custom_query($pdo,$arc_q);
				echo "<p class='alert alert-success text-center'>Event Marked As Archived!</p>";
				header("refresh:3;url=admin-archive-event.php");
			}


			//show archive data
			$arc_q = "select * from events where new='no' ORDER BY ev_id DESC";
			$arch_r = $ol->custom_query($pdo,$arc_q);

			foreach ($arch_r as $value) {
				$evid = $value['ev_id'];

		?>
		<div class="archive col-md-12">
			<a href="<?php echo 'admin-event-show.php?evid='.$evid; ?>"><p><?php echo "".$value['name'].""; ?></p></a>
			<a class="btn btn-primary" style="float: right;margin-top: 3px;" href="?ar=<?php echo $evid; ?>">mark as new</a>
		</div>

		<?php
			}
		?>

	</div>

</div>

<?php include 'footer.php'; ?>