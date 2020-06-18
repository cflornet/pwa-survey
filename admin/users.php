<?
	require_once "connectDB.req.php";

	include "SimpleXLSX.php";

	session_start();

	if (isset($_SESSION['usr_id']))
	{
		if (isset($_POST['submit']))
		{
			$dir_upl = '';
			$file_uploaded = $dir_upl . basename($_FILES['fil']['name']);

			if (move_uploaded_file($_FILES['fil']['tmp_name'], $file_uploaded)) 
			{
				//echo "The file is valid and was succesly uploaded.\n";
				echo "";
			} 
			else 
			{
				echo "¡Error uploading File!\n";
			}

			if ( $xlsx = SimpleXLSX::parse('Users.xlsx') ) 
			{
				foreach ($xlsx->rows() as $elt) 
				{
					$rnd = rand(1000,9999); // chiffre aléatoire "token"
					$sql = "SELECT COUNT(*) as cnt FROM buse_user WHERE usec_id = '".$rnd."';"; // vérification s'il existe déjà 
					$data = $pdo -> query($sql);
					while ($data->fetchColumn() > 0)
					{
						$rnd = rand(1000,9999); // vérification de non existence du même chiffre
						$data = $pdo -> query($sql);
					}

					$sql2 = "INSERT INTO buse_user(usec_id,usec_name,usec_surname,usen_type,usen_status) VALUES('".$rnd."','".$elt[0]."','".$elt[1]."',2,1);"; // 2 - user 1 - actif
					$data2 = $pdo -> query($sql2);	
					// 7 pour 7 jours
					$sql4 = "INSERT INTO sdia_diary(diac_student,diac_teacher,diaf_date,dian_status) VALUES('".$rnd."','".$_SESSION['usr_id']."',CURDATE(),1);"; // CURDATE - SQL
					$data4 = $pdo -> query($sql4);	
					for($i = 1; $i <= 6; $i++) {
						$sql4 = "INSERT INTO sdia_diary(diac_student,diac_teacher,diaf_date,dian_status) VALUES('".$rnd."','".$_SESSION['usr_id']."',CURDATE() + INTERVAL $i DAY,1);"; // + INTERVAL 1 DAY - SQL
						$data4 = $pdo -> query($sql4);	
					}																	
				}
			} 
			else 
			{
				echo SimpleXLSX::parseError();
			}
		}
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
							<h6 class="card-title">New Users</h6>
							<form enctype="multipart/form-data" method="POST">
								<div class="row">
									<div class="col">
										<div class="form-group">
											<label for="fil">File</label>
											<input type="file" name="fil" class="form-control-file"> <!--- CHAMP html type file --->
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
											<input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="Upload File">
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
											<th>Name</th>
											<th>Token</th>
										</tr>
									</thead>
									<tbody>
										<? 	// affiche les utilisateurs crées avec les tokens 
											$sql3 = "SELECT usec_id tok,usec_name nam,usec_surname sur FROM buse_user WHERE usen_status = 1 AND usen_type = 2;";
											$trns = $pdo -> query($sql3);
											while ($trn = $trns -> fetch()) 
											{
  												echo "<tr>
  															<td>".$trn['nam']." ".$trn['sur']."</td>
  															<td>".$trn['tok']."</td>
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
