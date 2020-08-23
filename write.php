<?php
	require_once "admin/connectDB.req.php";

	require_once('header.php');

?>
<body>
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
				<h4>Today's Feedback</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col" style="color:red;">
						If the date appears in red please remember the time for add information expire now	
					</div>
					
				</div>
				<form method="post" id="addEntryForm">
					<div class="row">
						<div class="col-md-12">
							<select name="fec" id="select_date" class="form-control">
 
							</select>
						</div>
					</div>
  
					<div class="row">
						<div class="col">&nbsp;</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div id="the-activities" class="form-group">
								<label for="act">Activity</label>
								<input type="text" name="act" class="form-control typeahead">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<div class="text-center">
								<h6>Set the Time</h6>
							</div>
						</div>
					</div>

					<div class="row d-flex justify-content-center">
						<div id="hours_row" class="d-flex justify-content-center">
							<div class="input-group">
								<select class="form-control hour" id="hoi" name="hoi" style="width:62px;font-size:smaller;" onchange="javascript:validateHour();">';
								

								</select>

								<span class="input-group-addon">:</span>
								<select class="form-control minutes" id="mii" name="mii" style="width:62px;font-size:smaller;" onchange="javascript:validateHour();">';
							
								</select>

								<span class="input-group-addon">&nbsp;to&nbsp;</span>
								<select class="form-control hour" id="hof" name="hof" style="width:62px;font-size:smaller;" onchange="javascript:validateHour();">';
								
								</select>
								
								<span class="input-group-addon">:</span>
								<select class="form-control minutes" id="mif" name="mif" style="width:62px;font-size:smaller;" onchange="javascript:validateHour();">';
								
								</select>
							</div>      
						</div>
					</div>
     
					<div class="row">
						<div class="col">&nbsp;</div>
					</div>
					<div class="row">
						<div class="col-md-12 loc">
							<div id="the-locations" class="form-group">
								<label for="loc">Location</label>
								<input type="text" name="loc" class="form-control typeahead">
							</div>
						</div>
					</div>
       
					<div class="row">
						<div class="col">&nbsp;</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="lea">Type of Learning</label>
								<select name="lea" id="select_group" class="form-control">
		
								</select>
							</div>
						</div>
					</div>

    				<div class="row">
						<div class="col">
							<textarea name="des" class="form-control" placeholder="Write here more about your activity..."></textarea>
</div>
					</div>
					<hr>
					<div class="row">	
						<div class="col-lg-12">
							<div class="form-group" align="right">
								<input type="submit" name="smd" class="btn btn-primary btn-lg btn-block" value="Add it" style="background-color:#F08E8E">
							</div>	
						</div>	
					</div>	

				</form>

				<div class="row">
					<div class="col-lg-12">
						<div class="form-group" align="center">
							<a href="summary.php">
								<button class="btn btn-warning" value="Valide your day" style="border-radius: 100px;color:white;">
									Validate your day
								</button>
							</a>
						</div>
					</div>
				</div>

				<div class="text-center">
					<a href="index.php"><img src="assets/img/see2.png" class="img-fluid" alt="Responsive image"></a>
					<img src="assets/img/edit2.png" class="img-fluid" alt="Responsive image">
				</div>
				<div class="row">	
					&nbsp;					
				</div>
			</div>
		</div>
	</div>

	<?php
	require_once('footer.php');
	?>
</body>
</html>
