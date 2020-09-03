<?
	require_once "connectDB.req.php";

	include "SimpleXLSX.php";

	session_start();

	if (isset($_SESSION['usr_id']))
	{

	}
	else
	{
		header("Location: login.php");
	}
?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>Users</title>
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
							<h6 class="card-title">Diaries</h6>
							<div class="table-responsive">
								<table id="tbp" class="table">
									<thead>
										<tr>
											<th>Name</th>
											<th>UTC</th>
											<th>Date</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<? 	
											$sql1 = "SELECT diac_student,usec_name,usec_surname,usen_utc,diaf_date,dian_status FROM sdia_diary,buse_user WHERE diac_student = usec_id AND usec_id = ".$_GET['cod'].";";
											$trns = $pdo -> query($sql1);
											while ($trn = $trns -> fetch()) 
											{
  												echo "<tr>
  															<td><a href='detail.php?cod=".$trn['diac_student']."' target='_blank'>".$trn['usec_name']." ".$trn['usec_surname']."</a></td>
															  <td><a href='detail.php?cod=".$trn['diac_student']."' target='_blank'>".$trn['usen_utc']."</a></td>
															  <td><a href='detail.php?cod=".$trn['diac_student']."' target='_blank'>".$trn['diaf_date']."</a></td>
															  <td><a href='detail.php?cod=".$trn['diac_student']."' target='_blank'>".$trn['dian_status']."</a></td>
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
