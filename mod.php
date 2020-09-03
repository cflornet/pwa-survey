<?
	require_once "admin/connectDB.req.php";

	session_start();

	$id = $_GET['didf_id'];

	if (isset($_POST['smd']))
	{
		

		header('Location: index.php');
	}
	
	require_once('header.php');
?>
<body style="background-color: #1B5082;">
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
				<form id="modForm">
					<div class="row">
						<div class="col-md-12">
							<input type="text" id="date_field" name="fet" class="form-control" readonly>
						</div>
					</div>

					<div class="row">
						<div class="col">&nbsp;</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group" id="the-activities">
								<label for="act">Activity</label>
								<input type="text" id="activity_field" name="act" class="form-control typeahead">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group" id="the-locations">
								<label for="act">Location</label>
								<input type="text" id="location_field" name="loc" class="form-control typeahead">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<textarea id="description_field" name="des" class="form-control" required></textarea>
						</div>
					</div>

					<hr width=100%>

					<div class="row">	
						<div class="col-lg-12">
							<div class="form-group" align="right">
								<input type="hidden" id="id_field" name="didf_id">
								<input type="submit" name="smd" class="btn btn-primary btn-lg btn-block" value="Update" style="background-color:#F08E8E">
							</div>	
						</div>	
					</div>	
				</form>
			</div>
		</div>
	</div>

	<?php
	require_once('footer.php');
	?>
</body>
</html>