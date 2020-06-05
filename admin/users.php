<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>Users</title>
	<?
		require_once "connectDB.req.php";
		session_start();

		if (isset($_SESSION['usr_id']))
		{
			if (isset($_POST['ctu']))
			{
				$usr = $_POST['usu'];
				$pwd = $_POST['pwu'];
				$nam = $_POST['nau'];
				$sur = $_POST['suu'];
				$typ = $_POST['ru'];


				$sql = "SELECT COUNT(*) AS total FROM buse_user WHERE usec_id = '".$usr."';";

				$data = $pdo -> query($sql);
				if ($data->fetchColumn() > 0)
				{
					echo "<br><br><br>
					<div class='alert alert-danger' role='alert'>
						<span class='sr-only'>Error:</span>
						The user already exists
					</div>";
				}
				else
				{
					$sql = "INSERT INTO buse_user(usec_id,usec_pwd,usec_name,usec_surname,usen_type,usen_status) VALUES('".$usr."','".$pwd."','".$nam."','".$sur."',".$typ.",1);";
					$data3 = $pdo -> query($sql);				
				}
			} // IF

			if (isset($_POST['upds']))
			{
				$usr = $_POST['useu'];
				$pwd = $_POST['pwdu'];
				$typ = $_POST['typu'];
				$sta = $_POST['stau'];

				$sql = "UPDATE buse_user SET usec_pwd = '".$pwd."',usen_type = ".$typ.",usen_status = ".$sta." WHERE usec_id = '".$usr."';";
				//echo('<br><br><br>'.$sql);

				$data = $pdo -> query($sql);
			}
		}
		else
		{
			header("Location: login.php");
		}
	?>
</head>
<body>
	<div class="container">		
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
		  	<div class="collapse navbar-collapse" id="navbarNavDropdown">
		    	<ul class="navbar-nav">
		      		<li class="nav-item dropdown">
		        		<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          			Actions
		        		</a>
		        		<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		        			<a class="dropdown-item" href="users.php">Users</a>
		        			<a class="dropdown-item" href="diaries.php">Diaries</a>
		        		</div>
		      		</li>
		    	</ul>
		  	</div>
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
			<div class="row">
				<div class="col align-self-end" style="text-align:right;">
					Users
				</div>
			</div>
			<hr width=100%>
			<div class="card">
				<div class="card-body">
					<div class=row>
						&nbsp;
					</div>
					<div class="card">
						<div class="card-body">
							<h6 class="card-title">New User</h6>
							<form method="post">
								<div class="row">
									<div class="col">
										<div class="form-group">
											<label for="emu">User</label>
											<input type="text" name="usu" placeholder="User" class="form-control"> 
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="form-group">
											<label for="pwu">Password</label>
											<input type="text" name="pwu" placeholder="Password" class="form-control"> 
										</div>
									</div>
								</div>	
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="nau">Name</label>
											<input type="text" name="nau" placeholder="Name" class="form-control"> 
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="suu">Surname</label>
											<input type="text" name="suu" placeholder="Surname" class="form-control"> 
										</div>
									</div>
								</div>	
								<div class="row">
									<div class="col">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="ru" id="ra" value="1">
											<label class="form-check-label" for="ra">Admin</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="ru" id="rn" value="2" checked="true">
											<label class="form-check-label" for="ra">User</label>
										</div>
									</div>
								</div>	
								<div class="row">	
									<div class="col-lg-12">
										&nbsp;
									</div>
								</div>
								<div class="row">	
									<div class="col-lg-12">
										<div class="form-group">
											<input type="submit" name="ctu" class="btn btn-primary btn-lg btn-block" value="Create User">
										</div>	
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class=row>
						&nbsp;
					</div>
					<div class="card">
						<div class="card-body">
							<h6 class="card-title">Users List</h6>
							<div class="table-responsive">
								<table id="tbp" class="table">
									<thead>
										<tr>
											<th>User</th>
											<th>Name</th>
											<th>Password</th>
											<th>Type</th>
											<th>Status</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
										<?
											$sql2 = "SELECT usec_id usr,usec_name nam,usec_surname sur,usec_pwd pwd,usen_type typ,usen_status sta FROM buse_user;";
											$trns = $pdo -> query($sql2);
											while ($trn = $trns -> fetch()) 
											{
												if ($trn['typ'] == 1)
												{
													$typv = "<select class='form-control' name='typu'>
  																<option value='1' selected>Admin</option>
  																<option value='2'>User</option>
  															</select>";
												}
												else
												{
													$typv = "<select class='form-control' name='typu'>
  																<option value='1'>Admin</option>
  																<option value='2' selected>User</option>
  															</select>";
												}
												if ($trn['sta'] == 1)
												{
													$stav = "<select class='form-control' name='stau'>
  																<option value='1' selected>Active</option>
  																<option value='2'>Retired</option>
  															</select>";
												}
												else
												{
													$stav = "<select class='form-control' name='stau'>
  																<option value='1'>Active</option>
  																<option value='2' selected>Retired</option>
  															</select>";
												}
  												echo "<form method='post'>
  														<input type='hidden' name='useu' value='".$trn['usr']."'>
  													  	<tr>
  															<td>".$trn['usr']."</td>
  															<td>".$trn['nam']." ".$trn['sur']."</td>
  															<td>
  																<input class='form-control' type='text' name='pwdu' value='".$trn['pwd']."'>
  															</td>
  															<td>".$typv."</td>
  															<td>".$stav."</td>
  															<td>
  																<input type='submit' class='btn btn-primary' name='upds' value='Update'>
  															</td>
  													  	</tr>
  													  </form>";
  											}
										?>
									</tbody>
								</table>	
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
</body>
</html>
