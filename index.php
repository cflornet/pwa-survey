<?php
	require_once "admin/connectDB.req.php"; // connexion db avec PDO 

	require_once('header.php');

?>
<body style="background-color: #1B5082;">
	<div class="container">
		<nav class="navtop">
			<a class="float-right" href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
			<a class="float-right" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
		</nav>
	</div>
	<div class="container" id="cnt_1">
		<div class="row">
			&nbsp;
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
				<h4 id="titre">Today's Feedback</h4>
			</div>
			<div class="card-body">
				<form id="selectDateForm">
					
					<div class="row">
						<div class="col-md-12">
							<select name="fec" id="select_date" class="form-control">

							</select>
						</div>
					</div>
					<hr width=100%>
					<div class="row">	
						<div class="col-lg-12">
							<div class="form-group" align="right">
								<input type="submit" name="smd" class="btn btn-primary btn-lg btn-block" value="Go" style="background-color:#F08E8E">
							</div>	
						</div>	
					</div>	

				</form>
				<div id="activities">
				
				</div>

				<div class="row">						
				</div>
				<div class="text-center">
					<img src="assets/img/see.png" class="img-fluid" alt="Responsive image">
					<a href="write.php"><img src="assets/img/edit.png" class="img-fluid" alt="Responsive image"></a>
				</div>

				</div>
			</div>
		</div>


		<div class="container" id="cnt_2">
			<div class="row">
				<div class="col">
					&nbsp;
				</div>
			</div>			
			<div class="text-center">
				<img src="assets/img/Feed.png" class="img-fluid" alt="Responsive image">
				<img src="assets/img/back.png" class="img-fluid" alt="Responsive image">
			</div>
			<form id="loginForm">
				<div class="text-center">		
					<h6 style="color:#fff">Enter the code your teacher gave you</h6>
				</div>	
				<div class="row">
					<div class="col">
						&nbsp;
					</div>
				</div>			
				<div class="modal-body">
					<div class="text-center">				
						<div class="row">
							<div class="col">
								<input id="cod1" name="cod1" type="number" class="form-control" min="1" max="9" inputmode="numeric">
							</div> 
							<div class="col">
								<input id="cod2" name="cod2" type="number" class="form-control" min="0" max="9" inputmode="numeric"> 
							</div> 
							<div class="col">
								<input id="cod3" name="cod3" type="number" class="form-control" min="0" max="9" inputmode="numeric"> 
							</div> 
							<div class="col">
								<input id="cod4" name="cod4" type="number" class="form-control" min="0" max="9" inputmode="numeric"> 
							</div> 
						</div>		
					</div>
				</div>
				<hr width=100%>						
				<div class="row">	
					<div class="col-lg-12">
						<div class="form-group" align="right">
							<input type="submit" name="submitLogin" id="btnLogin" class="btn btn-primary btn-lg btn-block" value="Let's Start" style="background-color:#F08E8E">
						</div>	
					</div>	
				</div>	
			</form>
		</div>
	</div>

	<?php
	require_once('footer.php');
	?>
</body>
</html>

