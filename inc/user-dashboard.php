<?php include 'user-head.php'; ?>
<style type="text/css">
	.idea{
		background-color: #517254;
		border-radius: 30px;
		margin-left: 40px;
		padding: 10px;
		margin-top: 20px;
		transition: all 0.5s;
	}
	.idea:hover{
		border-radius: 0px;
		box-shadow: 0px 5px 28px 2px rgba(0,0,0,0.75);
		transform: scale(1.2,1.2);
	}
	.idea p{
		font-size: 40px;
		font-weight: bold;
	}
	.idea h3{
		margin:0;
		padding: 10px;
	}
	.idea p{
		padding-top: 10px;
	}

	.back-vid{
	margin:0;
	padding: 0;
	position: absolute;
	top: 0%;
	left: 0%;
	/*transform: translate(-50%,-50%);
	min-width: 100%;
	min-height: 100%;
	width: auto;
	height: auto;*/
}

.back-vid p{
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background:rgba(24,22,58,0.7);
}

.back-vid video{
	height: 100%;
	width: 100%;
}
</style>


<div class="row">

	<div class="back-vid col-md-12">
		<p></p>
		<video autoplay="true" loop="" >
			<source src="img/vid.mp4" type="video/mp4">
		</video>
	</div>

	<div class="dash-main text-center col-md-12">
		<a href="user-event.php">
			<div class="idea col-md-3">
				<p class="glyphicon glyphicon-th-list"></p>
				<h3>Events</h3>
			</div>
		</a>

		
		<a href="user-blog.php">
			<div class="idea col-md-3 ">
				<p class="glyphicon glyphicon-blackboard"></p>
				<h3>Blog/News</h3>
			</div>
		</a>


		<a href="user-blood.php">
			<div class="idea col-md-3">
				<p class="glyphicon glyphicon-tint"></p>
				<h3>Blood Bank</h3>
			</div>
		</a>

		<a href="user-notice.php">
			<div class="idea col-md-3">
				<p class="glyphicon glyphicon-envelope"></p>
				<h3>Notice Board</h3>
			</div>
		</a>

		<a href="user-alumni.php">
			<div class="idea col-md-3">
				<p class="glyphicon glyphicon-user"></p>
				<h3>Alumni's</h3>
			</div>
		</a>

		<a href="user-project.php">
			<div class="idea col-md-3">
				<p class="glyphicon glyphicon-list-alt"></p>
				<h3>Club Projects</h3>
			</div>
		</a>

		<a href="user-help.php">
			<div class="idea col-md-3">
				<p class="glyphicon glyphicon-info-sign"></p>
				<h3>Help Center</h3>
			</div>
		</a>
	</div>
</div>

<?php include 'user-footer.php' ?>