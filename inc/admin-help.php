<?php include 'header.php'; ?>

<?php
	//init
	$adh = new db();
?>

<style type="text/css">
	.admin-help{
		border:2px solid green;
		border-radius: 10px;
		padding: 8px;
		overflow: auto;
		height: 450px;
	}
	.admin-help-box{
		border-bottom: 2px dotted black;
	}
</style>

<div class="row">
	
	<div class="admin-help-main col-md-12">

		<?php
			//get delete success status
			if(isset($_GET['delsucc'])){
				echo "<p class='alert alert-success text-center'>Request Deleted Successfull!!</p>";
			}
		?>
		
		<div class="admin-help-up col-md-12">
			<h3>All Requests</h3>
			<hr style="border-color: black;">
		</div>



		<div class="admin-help col-md-12">

			<?php
				//show all the request with status
				$sh_req_q = $adh->getalldatadesc($pdo,"help_question","q_id");
				$i=1;
				foreach ($sh_req_q as $value) {
				
			?>
			
			<div class="admin-help-box col-md-12 text-center">
				
				<div class="admin-help-user col-md-4">
					<p><b><?php echo $i.". "; ?></b></p>
				</div>


				<div class="admin-help-user col-md-4">
					<a style="color: black;text-decoration: underline;" href="admin-help-show.php?q=<?php echo $value['q_id']; ?>">
					<p>
					<?php
						//show some word of the question
						$quw = $value['help_q'];
						echo substr($quw, 0,10)." . . . ";
					?>
					</p>
					</a>
				</div>


				<div class="admin-help-user col-md-4">
					<?php
						if($value['chk'] == "no"){

					?>
					<span class="label label-warning">Unanswered</span>
					<?php

						}elseif ($value['chk'] == "yes") {
					
					?>
					<span class="label label-success">Answered</span>
					<?php
						}elseif ($value['chk'] == "close") {

					?>
					<span class="label label-default">Closed</span>
					<?php
							
						}
					?>
				</div>

			</div>

			<?php
				$i++; 
				}
			 ?>

		</div>



	</div>

</div>


<?php include 'footer.php'; ?>