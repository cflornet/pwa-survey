<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="manifest" href="manifest.json">
	<title>Survey</title>
	<?
		require_once "admin/connectDB.req.php"; // connexion db avec PDO 

		session_start(); // La méthode choisie pour préserver des données entre plusieurs accès est l'utilisation des sessions https://www.php.net/manual/fr/intro.session.php

		if (isset($_POST['sbm']))
		{
			$tok = $_POST['cod1'].$_POST['cod2'].$_POST['cod3'].$_POST['cod4'];

			$sql = "SELECT COUNT(*) AS total FROM buse_user WHERE usen_status = 1 AND usec_id = '".$tok."';";
			$data = $pdo -> query($sql);
			if ($data->fetchColumn() > 0)
			{
				$_SESSION['usr_id'] = $tok;
				$_SESSION['usr_status'] = 1;

				$sql = "SELECT usec_name nam,usec_surname sur,usen_status sta FROM buse_user WHERE usen_status = 1 AND usec_id = '".$usr."';";
				$data2 = $pdo -> query($sql);
				
				while ($row = $data2 -> fetch()) 
				{
					
					$_SESSION['usr_name'] = $row['nam'];
				}
			}
			else
			{
				$_SESSION['usr_id'] = '';
				$_SESSION['usr_name'] = '';
				$_SESSION['usr_status'] = '0';		
				echo "<br><br><br>
				<div class='alert alert-danger' role='alert'>
					<span class='sr-only'>Error:</span>
					Please verify the information
				</div>";
			}
		}
	?>
</head>
<body style="background-color: #1B5082;">
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
			<div class=row>
				&nbsp;
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
					<form method="post">
						<?
							if($_SESSION['usr_status'] > 0)
							{										
								$sql2 = "SELECT y.diaf_date dat  FROM sdia_diary y WHERE y.dian_status = 1 AND y.diac_student = '".$_SESSION['usr_id']."' ORDER BY 1;";
								$trns = $pdo -> query($sql2);
								echo 	'
											<div class="row">
												<div class="col-md-12">
													<select name="fec" class="form-control">
										';
								while ($trn = $trns -> fetch()) 
								{
									$date=date_create($trn['dat']);
									echo 	'
														<option value="'.$trn['dat'].'">'.date_format($date,"l jS").'</option>
											';
								}
								echo 	'
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
										';
							}
						?>
	
					</form>
					<?
						if (isset($_POST['smd']))
						{
							$fec = $_POST['fec'];

							$sql2 = "	SELECT 		d.didf_hour hou,
													d.didn_category coc,
													c.catc_name act,
													d.didn_location col,
													l.locc_name loc,
													d.didn_group coe,
													e.groc_name lea,
													d.didn_duration dur,
													ADDTIME(d.didf_hour,(d.didn_duration*10000)) hof,	
													d.didc_description des
										FROM 		sdid_diary_detail d,
													bcat_category c,
													bloc_location l,
													bgro_group e
										WHERE 		d.didn_category = c.catn_code AND
													d.didn_location = l.locn_code AND
													d.didn_group = e.gron_code AND
													d.didf_date = '".$fec."' AND
													d.didc_student = '".$_SESSION['usr_id']."';
									";

							$trns = $pdo -> query($sql2);
							while ($trn = $trns -> fetch()) 
							{
								$dati=date_create($trn['hou']);
								$datf=date_create($trn['hof']);

								echo 	'
											<hr width="100%">
											<div class="card">
												<div< class="card-header" style="background-color:#1B5082;color:#fff">
										'.$dati->format('H:i').' to '.$datf->format('H:i').'
											</div>
												<div class=card-body>
													<div class="row">
														<div class="col">
															'.$trn['act'].' at '.$trn['loc'].'
														</div>
													</div>
													&nbsp;
													<div class="row">
														<div class="col">
															<img src="assets/img/read.png" class="img-fluid" alt="Responsive image">
														</div>
														<div class="col">
															'.$trn['des'].'
														</div>
													</div>												
												</div>
									';
							}	
						}
					?>
					<div class="row">						
					</div>
					<div class="text-center">
						<img src="assets/img/see.png" class="img-fluid" alt="Responsive image">
						<a href="write.php"><img src="assets/img/edit.png" class="img-fluid" alt="Responsive image"></a>
					</div>

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
		<div class="text-center">
			<img src="assets/img/Feed.png" class="img-fluid" alt="Responsive image">
			<img src="assets/img/back.png" class="img-fluid" alt="Responsive image">
		</div>
		<form method="post">
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
						<input type="submit" name="sbm" id="btnLogin" class="btn btn-primary btn-lg btn-block" value="Let's Start" style="background-color:#F08E8E">
					</div>	
				</div>	
			</div>	
		</form>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="assets/js/jsstore.js"></script>
    <script src="assets/js/index.js"></script>
    <script src="assets/js/jsstore.worker.js"></script>
	<script src="sw.js"></script>
    <script>
    	var container = document.getElementsByClassName("modal-body")[0];
		container.onkeyup = function(e) 
		{
    		var target = e.srcElement || e.target;
    		var maxLength = parseInt(target.attributes["maxlength"].value, 10);
    		var myLength = target.value.length;
    		if (myLength >= maxLength) 
    		{
        		var next = target;
        		while (next = next.nextElementSibling) 
        		{
            		if (next == null)
                	break;
            		if (next.tagName.toLowerCase() === "input") 
            		{
                		next.focus();
                		break;
            		}
        		}
    		}
    		
    		// Move to previous field if empty (user pressed backspace)
    		else if (myLength === 0) 
    		{
        		var previous = target;
        		while (previous = previous.previousElementSibling) 
        		{
            		if (previous == null)
                	break;
            		if (previous.tagName.toLowerCase() === "input") 
            		{
                		previous.focus();
                		break;
            		}
        		}
    		}
		}
    </script>
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