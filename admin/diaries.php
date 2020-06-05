<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>Diaries</title>
	<?
		require_once "connectDB.req.php";
		session_start();

		if (isset($_SESSION['usr_id']))
		{
			if (isset($_POST['ctd']))
			{
				$tea = $_SESSION['usr_id'];
				$stu = $_POST['stu'];
				$dat = $_POST['dat'];

				$sql = "SELECT COUNT(*) AS total FROM sdia_diary WHERE diac_student = '".$stu."' AND diaf_date = '".$dat."';";

				$data = $pdo -> query($sql);
				if ($data->fetchColumn() > 0)
				{
					echo "<br><br><br>
					<div class='alert alert-danger' role='alert'>
						<span class='sr-only'>Error:</span>
						The Diary registry already exists
					</div>";
				}
				else
				{
					$sql = "INSERT INTO sdia_diary(diac_student,diac_teacher,diaf_date,dian_status) VALUES('".$stu."','".$tea."','".$dat."',1);";
					$data3 = $pdo -> query($sql);				
				}
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
					Diaries
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
							<h6 class="card-title">New Diary</h6>
							<form method="post">
								<div class="row">
									<div class="col">
										<div class="form-group">
											<label for="stu">Student</label>
											<select name="stu" class="form-control">
												<?
													$sql2 = "SELECT usec_id usr,usec_name nam,usec_surname sur FROM buse_user WHERE usen_status = 1 AND usen_type = 2 ORDER BY usec_name, usec_surname;";
													$trns = $pdo -> query($sql2);
													while ($trn = $trns -> fetch()) 
													{
														echo "<option value='".$trn['usr']."'>".$trn['nam']." ".$trn['sur']."</option>";
													}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="form-group">
											<label for="dat">Date</label>
											<input type="date" class="form-control" name="dat" value="<? echo date("Y-m-d"); ?>">
										</div>
									</div>
								</div>
								<div class="row">	
									<div class="col-lg-12">
										<div class="form-group">
											<input type="submit" name="ctd" class="btn btn-primary btn-lg btn-block" value="Create Diary">
										</div>	
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<hr width="100%">
					<div class="card">
						<div class="card-body">
							<h6 class="card-title">Diaries List</h6>
							<div class="table-responsive">
								<table id="tbp" class="table">
									<thead>
										<tr>
											<th>Date</th>
											<th>Student</th>
											<th>Teacher</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<?
											$sql3 = "SELECT diaf_date dat,diac_student stu,diac_teacher tea,dian_status sta FROM sdia_diary;";
											$trns = $pdo -> query($sql3);
											while ($trn = $trns -> fetch()) 
											{
												if ($trn['sta'] == 1)
												{
													$std = "Open";
												}
												else
												{
													$std = "Close";
												}
  												echo "<tr>
  															<td>".$trn['dat']."</td>
  															<td>".$trn['stu']."</td>
  															<td>".$trn['tea']."</td>
  															<td>".$std."</td>
  													  	</tr>";
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
