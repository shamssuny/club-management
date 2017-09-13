<?php include 'header.php'; ?>

<?php
	//init
	$co = new db();
?>

<style type="text/css">
	.cost-up{
		display: inline-block;
	}
	.cost-up h2{
		display: inline-block;
	}

	.cost-up a{
		margin-top: 20px;
		float: right;
	}

	.cost-all{
		border:2px solid grey;
		display: inline-block;
		overflow: auto;
		border-radius: 5px;
		height: 400px;
	}

	.cost-show{
		border-bottom: 1px solid black;
		padding: 5px;
	}

	.mar{
		margin-top: 5px;
	}

</style>

<div class="row">
	
	<div class="cost-main col-md-12">
		
		<div class="cost-up col-md-12">

			<?php
				//get error status
				if(isset($_GET['error'])){
					echo "<p class='alert alert-danger text-center'>Invalid Input !</p>";
				}

				//get success status
				if(isset($_GET['success'])){
					echo "<p class='alert alert-success text-center'>Cost Added !</p>";
				}

				//get delete status
				if(isset($_GET['del'])){
					$ccd = $_GET['id'];
					$del_cos = "delete from cost where c_id='$ccd'";
					$co->custom_query($pdo,$del_cos);
					echo "<p class='alert alert-info text-center'>Deleted Cost !</p>";
				}
			?>

			<h2>Cost Manager</h2>
			<a class="btn btn-success" data-toggle="modal" data-target="#myModal" href="">add cost</a>
			<hr style="border-color: black;">
		</div>


		<div class="cost-all col-md-12">

			<?php
				//show the data
				$all_cost = $co->getalldatadesc($pdo,"cost","c_id");
				$i = 1;
				foreach ($all_cost as $value) {
					$cid = $value['c_id'];
			?>
			
			<div class="cost-show col-md-12">
				
				<div class="cost-data col-md-3 mar">
					<p><b><?php echo $i.". ".$value['name']; ?></b></p>
				</div>

				<div class="cost-data col-md-3 mar">
					<p><?php echo $value['date']; ?></p>
				</div>

				<div class="cost-data col-md-3 mar">
					<p><?php echo $value['cost']; ?></p>
				</div>

				<div class="cost-data col-md-3">
					<a class="btn btn-warning" href="<?php echo '?del=1&id='.$cid; ?>">Delete</a>
				</div>

			</div>

			<?php
				$i++;}
			?>

		</div>


		<div class="total-cost col-md-12">
			<?php
				//query for sum all cost
				$sum_q = "SELECT SUM(cost) as lul from cost";
				$get_sum = $co->custom_query($pdo,$sum_q);
				foreach ($get_sum as $value) {
					$lu = $value['lul'];
					echo "<h2 class='text-center'>Total Cost: $lu</h2>";
				}
			?>
		</div>

	</div>

</div>




<!-- Modal for Make cost Curse-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Make A COST</h4>
        </div>
        <div class="modal-body">
          <!-- input the cost details -->
          <?php
          	//get data and put in db
          	if(isset($_POST['make'])){

          		$cost_name = $_POST['cname'];
          		$cost_date = $_POST['cdate'];
          		$cost_value = $_POST['tcost'];

          		if(!empty($cost_name)&&!empty($cost_date)&&!empty($cost_value)){
          			$cost_in_q = "insert into cost (name,date,cost) values ('$cost_name','$cost_date','$cost_value')";
          			$co->custom_query($pdo,$cost_in_q);
          			header("location:admin-cost.php?success=1");
          		}else{
          			header("location:admin-cost.php?error=1");
          		}
          		
          	}
          ?>
          <form class="form-group" method="POST" action="">
          	<input class="form-control" type="text" name="cname" placeholder="Cost Name"><br>
          	<input class="form-control" type="date" name="cdate" placeholder="Cost Date"><br>
          	<input class="form-control" type="number" name="tcost" placeholder="Cost Value"><br>
          	<input class="btn btn-warning" type="submit" name="make" value="Add Cost">
          </form>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 <!-- end of modal -->

<?php include 'footer.php'; ?>