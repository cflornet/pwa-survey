<?php

require_once "admin/connectDB.req.php";

session_start();

if (!isset($_SESSION['usr_status']) || $_SESSION['usr_status'] !== 1) {
	header('Location: index.php');
}



$stmt = $pdo->prepare('SELECT * FROM buse_user WHERE usec_id = :id');

$stmt->execute([':id' => $_SESSION['usr_id']]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

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
			<img src="assets/img/Feed.png" class="img-fluid" alt="Responsive image">
			<img src="assets/img/back.png" class="img-fluid" alt="Responsive image">
		</div>
		<div class="card" style="background-color: #E5E5E5">
			<div class="card-title">
				&nbsp;
				<h4>Today's Feedback</h4>
			</div>
			<div class="card-body">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Name:</td>
						<td><?=$user['usec_name'].' '.$user['usec_surname']?></td>
					</tr>
					<tr>
						<td>ID:</td>
						<td><?=$user['usec_id']?></td>
					</tr>
				</table>
			</div>
			</div>
		</div>
	</div>

	<?php
	require_once('footer.php');
	?>
	
	</body>
</html>