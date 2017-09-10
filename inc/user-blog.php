<?php include 'user-head.php'; ?>

<?php
	//init
	$ub = new db();
?>

<style type="text/css">
	.user-blog-sh h3{
		padding: 10px;
		background-color: #38727c;
		border-radius: 10px;
		color: white;
		margin-top: 5px;
	}
	.user-blog-sh h3:hover{
		text-decoration: underline;
	}
</style>

<div class="row">
	
	<div class="user-blog-main col-md-12">
		
		<div class="user-blog col-md-12">
			<h2>All Blogs</h2>
			<hr style="border-color: black;">
		</div>


		<div class="user-blog-sh col-md-12">
			
			<?php
				//show the blog posts
				$sh_b_q = "select * from blog ORDER BY b_id DESC";
				$sh_b = $ub->custom_query($pdo,$sh_b_q);
				$i=1;
				foreach ($sh_b as $value) {
					$v = $value['b_id'];
			?>

			<a href="<?php echo 'user-blog-show.php?view='.$v; ?>"><h3><?php echo $i.'. '.$value['title']; ?></h3></a>

			<?php
				$i++;}
			?>
			
		</div>

	</div>

</div>

<?php include 'user-footer.php'; ?>