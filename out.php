<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>Survey</title>
	<?
		require_once "admin/connectDB.req.php";
		session_destroy();
		header("Location: index.php");
	?>
</head>
<body>
	<?
		if($_SESSION['usr_status'] > 0)
		{
			echo '<div class="container" id="cnt_1" style="display:block;">';		
		}
		else
		{
			echo '<div class="container" id="cnt_1" style="display:none;">';		
		}
	?>
		<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
			<a class="navbar-brand" href="#">
	    		<img src="/assets/img/icon/s.png" width="30" height="30" alt="" loading="lazy">
	  		</a>		
	  		<a class="navbar-brand" href="#">
		  		SURVEY
			</a>
		  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="fa="fal.$sqls;e" aria-label="Toggle navigation">
		    	<span class="na//vbar-toggler-icon"></span>
		  	</button>
		</nav>	
		<div class="container">
			<div class="row">
				<div class="col">
					&nbsp;
				</div>
			</div>			
			<div class="row">
				<div class="col">
					&nbsp;
				</div>
			</div>			
			<div class="row">
				<div class="col">
					&nbsp;
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<div class=row>
						&nbsp;
					</div>
					<form method="post">
						<?
							if($_SESSION['usr_status'] > 0)
							{										
								$sql2 = "SELECT y.diaf_date dat, y.diac_teacher tea  FROM sdia_diary y WHERE y.dian_status = 1 AND y.diac_student = '".$_SESSION['usr_id']."' AND diaf_date = (SELECT MIN(x.diaf_date) FROM sdia_diary x WHERE x.dian_status = y.dian_status AND x.diac_student = y.diac_student);";
								$trns = $pdo -> query($sql2);
								
								while ($trn = $trns -> fetch()) 
								{
									echo 	'
												<div class="row">
													<div class="col align-self-end" style="text-align:right;">
														Teacher:
											'
											.$trn['tea'].
											'
													</div>
												</div>
												<hr width="100%">
												<div class="card">
													<div class="card-body">
														<h6 class="card-title">
											'
											.$trn['dat'].
											'
														</h6>
											<input type="hidden" name="ddt" value="'.$trn['dat'].'">';
	
											for ($i = 6; $i <= 23; $i++)
											{
												echo 	'
														<div class="row">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="hou'.$i.'">Hour</label>
																	<input type="text" class="form-control" name="hou'.$i.'" value="'.$i.':00" readonly>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label for="act'.$i.'">Activity</label>
																	<select name="act'.$i.'" class="form-control">
																		<option value="1">Reading</option>
																		<option value="2">Writing</option>
																	</select>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label for="loc'.$i.'">Location</label>
																	<select name="loc'.$i.'" class="form-control">
																		<option value="1">Home</option>
																		<option value="2">University</option>
																		<option value="3">Library</option>
																	</select>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label for="gro'.$i.'">Group</label>
																	<select name="gro'.$i.'" class="form-control">
																		<option value="1">Self</option>
																		<option value="2">Group Learning</option>
																	</select>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label for="tim'.$i.'">Time</label>
																	<input type="number" class="form-control" name="tim'.$i.'" value="0" min="0" max="24" step="0.5">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col">
																<div class="form-group">
																	<label for="des'.$i.'">Description</label>
																	<textarea name="des'.$i.'" class="form-control"></textarea>
																</div>
															</div>
														</div>
														<hr width="100%">

														<div class="row">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="hou'.$i.'m">Hour</label>
																	<input type="text" class="form-control" name="hou'.$i.'m" value="'.$i.':30" readonly>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label for="act'.$i.'m">Activity</label>
																	<select name="act'.$i.'m" class="form-control">
																		<option value="1">Reading</option>
																		<option value="2">Writing</option>
																	</select>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label for="loc'.$i.'m">Location</label>
																	<select name="loc'.$i.'m" class="form-control">
																		<option value="1">Home</option>
																		<option value="2">University</option>
																		<option value="3">Library</option>
																	</select>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label for="gro'.$i.'m">Group</label>
																	<select name="gro'.$i.'m" class="form-control">
																		<option value="1">Self</option>
																		<option value="2">Group Learning</option>
																	</select>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label for="tim'.$i.'m">Time</label>
																	<input type="number" class="form-control" name="tim'.$i.'m" value="0" min="0" max="24" step="0.5">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col">
																<div class="form-group">
																	<label for="des'.$i.'m">Description</label>
																	<textarea name="des'.$i.'m" class="form-control"></textarea>
																</div>
															</div>
														</div>
														<hr width="100%">
														';
											}

											echo 
											'	
														<div class="row">
															<div class="col">
																<div class="form-group">
																	<label for="summ">Summary</label>
																	<textarea name="summ" class="form-control"></textarea>
																</div>
															</div>
														</div>	
														<div class="row">
															<div class="col">
																<div class="form-group">
																	<label>Please thick the box</label>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col">
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="radio" name="smi" id="smi1" value="1" checked>
																	<i class="far fa-smile" style="font-size:24px"></i>
																	&nbsp;
																	<label class="form-check-label" for="smi1">Happy</label>
																</div>																
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="radio" name="smi" id="smi2" value="2">
																	<i class="far fa-tired" style="font-size:24px"></i>
																	&nbsp;
																	<label class="form-check-label" for="smi2">Tired</label>
																</div>																
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="radio" name="smi" id="smi3" value="3">
																	<i class="far fa-sad-tear" style="font-size:24px"></i>
																	&nbsp;
																	<label class="form-check-label" for="smi3">Sad</label>
																</div>																
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="radio" name="smi" id="smi4" value="4">
																	<i class="far fa-meh-rolling-eyes" style="font-size:24px"></i>
																	&nbsp;
																	<label class="form-check-label" for="smi4">Worried</label>
																</div>																
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="radio" name="smi" id="smi5" value="5">
																	<i class="far fa-dizzy" style="font-size:24px"></i>
																	&nbsp;
																	<label class="form-check-label" for="smi5">Sick</label>
																</div>																
															</div>
														</div>	
													</div>
												</div>
												<hr width=100%>
												<div class="row">	
													<div class="col-lg-12">
														<div class="form-group" align="right">
															<input type="submit" name="smd" class="btn btn-primary btn-lg btn-block" value="Send">
														</div>	
													</div>	
												</div>	
											';
								}
							}
						?>
					</form>
				</div>
			</div>
			<div class=row>
				&nbsp;
			</div>
		</div>
	</div>

	<?
		if($_SESSION['usr_status'] > 0)
		{
			echo '<div class="container" id="cnt_2" style="display:none;">';		
		}
		else
		{
			echo '<div class="container" id="cnt_2" style="display:block;">';		
		}
	?>
		<div class="row">
			<div class="col">
				&nbsp;
			</div>
		</div>			
		<div class="card">
			<div class="card-body">
				<h6 class="card-title">Survey</h6>
				<img src="assets/img/sv.jpg" class="img-fluid" alt="Responsive image">
				<div class="row">
					<div class="col">
						&nbsp;
					</div>
				</div>
				<form method="post">		
					<div class="row">
						<div class="col-lg-12">
							<label for="usr">User</label>
							<input id="txtUser" type="text" name="usr" placeholder="User" class="form-control" autofocus> 
						</div>	
					</div>
					<div class="row">
						<div class="col">
							&nbsp;
						</div>
					</div>			
					<div class="row">
						<div class="col-lg-12">
							<label for="password">Password</label>
							<input id="txtPassword" name="pwd" type="password" placeholder="Password" class="form-control"> 
						</div>	
					</div>
					<hr width=100%>
					<div class="row">	
						<div class="col-lg-12">
							<div class="form-group" align="right">
								<input type="submit" name="sbm" id="btnLogin" class="btn btn-primary btn-lg btn-block" value="Login">
							</div>	
						</div>	
					</div>	
				</form>
			</div>
		</div>
	</div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
	<script src="sw.js"></script>
  	<script>
    	if ('serviceWorker' in navigator)
    	{
        	navigator.serviceWorker.register('sw.js')
				.then(function(reg)
				{
        			console.log("SW Registered.");
      			}).catch(function(err) 
      			{
        			console.log("SW Not Registered: ", err)
      			});      	
      	}
    </script>
    <!--<script src="assets/js/app.js"></script>-->
</body>
</html>