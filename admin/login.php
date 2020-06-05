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
		require_once "connectDB.req.php";

		session_start();
		$_SESSION['usr_id'] = '';
		$_SESSION['usr_name'] = '';
		$_SESSION['usr_type'] = '0';		

		if (isset($_POST['sbm']))
		{

			$usr = $_POST['usr'];
			$pwd = $_POST['pwd'];

			$sql = "SELECT COUNT(*) AS total FROM buse_user WHERE usen_status = 1 AND usen_type = 1 AND usec_id = '".$usr."' AND usec_pwd = '".$pwd."';";
			$data = $pdo -> query($sql);
			if ($data->fetchColumn() > 0)
			{
				$_SESSION['usr_id'] = $_POST['usr'];

				$sql = "SELECT usec_name nam,usec_surname sur,usen_type typ FROM buse_user WHERE usec_id = '".$usr."';";
				$data2 = $pdo -> query($sql);
				
				while ($row = $data2 -> fetch()) 
				{
					
					$_SESSION['usr_name'] = $row['nam'];
					header("Location: users.php");
				}
			}
			else
			{
				echo "<br><br><br>
				<div class='alert alert-danger' role='alert'>
					<span class='sr-only'>Error:</span>
					Please verify the information
				</div>";
			}
		}

	?>
</head>
<body>
	<div class="container">
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
</body>
</html>
