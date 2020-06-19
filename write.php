<?
	require_once "admin/connectDB.req.php";

	session_start();

	if (isset($_POST['smd']))
	{
		$fec = $_POST['fec'];
		$act = $_POST['act'];
		$hoi = $_POST['hoi'];
		$mii = $_POST['mii'];
		$hof = $_POST['hof'];
		$mif = $_POST['mif'];
		$loc = $_POST['loc'];
		$lea = $_POST['lea'];
		$des = $_POST['des'];

		if ($mif < $mii)
		{
			$reh = (( $hof -1 ) - $hoi);
			$rem =  (($mif + 60) - $mii);
		}
		else
		{
			$reh = $hof - $hoi;
			$rem =  $mif - $mii;				
		}
		$tim = $reh.".".$rem;

		$hsc = intVal($hoi);
		$hrf = "PT".$hsc."H";
		$msc = intVal($mii);
		if($msc <> 0)
		{
			$hrf = $hrf.$msc."M";
		}

		$dat = new DateTime($fec);
		$dat->add(new DateInterval($hrf));

		$sql7 = "SELECT COUNT(*) AS total FROM sdid_diary_detail WHERE didf_hour = '".$dat->format('Y-m-d H:i:s')."' AND didf_date = '".$fec."' AND didc_student = '".$_SESSION['usr_id']."';";
			
		$data = $pdo -> query($sql7);
			
		if ($data->fetchColumn() > 0)
		{
			echo("<div class='alert alert-danger' role='alert'><span class='sr-only'>Error:</span>The hour already exists, please verify the info</div>");
		}
		else
		{
			$sql6 = "INSERT INTO sdid_diary_detail(didf_hour,didf_date,didc_student,didn_category,didn_location,didn_group,didn_duration,didc_description) VALUES('".$dat->format('Y-m-d H:i:s')."','".$fec."','".$_SESSION['usr_id']."','".$act."',".$loc.",".$lea.",".$tim.",'".$des."');";

			$data = $pdo -> query($sql6);
		}
	}

	require_once('header.php');
?>
<body style="background-color: #1B5082;">
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
			<img src="assets/img/Feed.png" class="img-fluid" alt="Responsive image">
			<img src="assets/img/back.png" class="img-fluid" alt="Responsive image">
		</div>
		<div class="card" style="background-color: #E5E5E5">
			<div class="card-title">
				&nbsp;
				<h4>Today's Feedback</h4>
			</div>
			<div class="card-body">
				<form method="post" id="addEntryForm">


				</form>
			</div>
			<div class="row">						
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

	<?php
	require_once('footer.php');
	?>
</body>
</html>