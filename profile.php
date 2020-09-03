<?php

require_once "admin/connectDB.req.php";

require_once('header.php');
?>
<body style="background-color: #1B5082;">
	<div class="container">
		<nav class="navtop">
			<div>	
				<a class="float-right" href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a class="float-right" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
	</div>


	<div class="container" id="cnt_1" style="display:block;">
		<div class="row">
			<div class="col">
				&nbsp;
			</div>
		</div>
		<div class="text-center">
			<a href="index.php">
				<img src="assets/img/Feed.png" class="img-fluid" alt="Responsive image">
				<img src="assets/img/back.png" class="img-fluid" alt="Responsive image">
			</a>
		</div>
		<div class="card" style="background-color: #E5E5E5">
			<div class="card-title">
				<a href="javascript:history.back()">Go Back</a>
				<h4>Today's Workload</h4>
			</div>
			<div class="card-body">
			<h2>Profile Page</h2>
			<div class="profile">
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Name:</td>
						<td class="name"></td>
					</tr>
					<tr>
						<td>ID:</td>
						<td class="id"></td>
					</tr>
				</table>
			</div>
			</div>
		</div>
	</div>

	<?php
	require_once('footer.php');
	?>
	<script src="assets/js/profile.js"></script>
	</body>
</html>