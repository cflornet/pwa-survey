<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="manifest" href="manifest.json">
	<title>Feedback</title>
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

			$sql6 = "INSERT INTO sdid_diary_detail(didf_hour,didf_date,didc_student,didn_category,didn_location,didn_group,didn_duration,didc_description) VALUES('".$dat->format('Y-m-d H:i:s')."','".$fec."','".$_SESSION['usr_id']."','".$act."',".$loc.",".$lea.",".$tim.",'".$des."');";

			$data = $pdo -> query($sql6);
		}
	?>
</head>
<body style="background-color: #1B5082;">
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
									';

							$sql3 = "SELECT catn_code cod,catc_name nam FROM bcat_category ORDER BY 2;";
							$trns = $pdo -> query($sql3);
							echo 	'
												<div class="row">
													<div class="col">&nbsp;</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label for="act">Choose your activity</label>
															<select name="act" class="form-control">
								';
						while ($trn = $trns -> fetch()) 
						{
							echo 	'
																<option value="'.$trn['cod'].'">'.$trn['nam'].'</option>
									';
						}
						echo 	'
															</select>
														</div>
													</div>
												</div>
									';

							echo 	'
												<div class="row">
													<div class="col">
														<div class="text-center">
															<h6>Set the Time</h6>
														</div>
													</div>
												</div>
												<div class="row d-flex justify-content-center">
													<div class="d-flex justify-content-center">
														<select class="form-control" name="hoi" style="width:72px;">
															<option value="06">06</option>
															<option value="07">07</option>
															<option value="08">08</option>
															<option value="09">09</option>
															<option value="10">10</option>
															<option value="11">11</option>
															<option value="12">12</option>
															<option value="13">13</option>
															<option value="14">14</option>
															<option value="15">15</option>
															<option value="16">16</option>
															<option value="17">17</option>
															<option value="18">18</option>
															<option value="19">19</option>
															<option value="20">20</option>
															<option value="21">21</option>
															<option value="22">22</option>
															<option value="23">23</option>
															<option value="00">00</option>
															<option value="01">01</option>
															<option value="02">02</option>
															<option value="03">03</option>
															<option value="04">04</option>
															<option value="05">05</option>
														</select>
														&nbsp;&nbsp;:&nbsp;&nbsp;
														<select class="form-control" name="mii" style="width:72px;">
															<option value="00">00</option>
															<option value="01">01</option>
															<option value="02">02</option>
															<option value="03">03</option>
															<option value="04">04</option>
															<option value="05">05</option>
															<option value="06">06</option>
															<option value="07">07</option>
															<option value="08">08</option>
															<option value="09">09</option>
															<option value="10">10</option>
															<option value="11">11</option>
															<option value="12">12</option>
															<option value="13">13</option>
															<option value="14">14</option>
															<option value="15">15</option>
															<option value="16">16</option>
															<option value="17">17</option>
															<option value="18">18</option>
															<option value="19">19</option>
															<option value="20">20</option>
															<option value="21">21</option>
															<option value="22">22</option>
															<option value="23">23</option>
															<option value="24">24</option>
															<option value="25">25</option>
															<option value="26">26</option>
															<option value="27">27</option>
															<option value="28">28</option>
															<option value="29">29</option>
															<option value="30">30</option>
															<option value="31">31</option>
															<option value="32">32</option>
															<option value="33">33</option>
															<option value="34">34</option>
															<option value="35">35</option>
															<option value="36">36</option>
															<option value="37">37</option>
															<option value="38">38</option>
															<option value="39">39</option>
															<option value="40">40</option>
															<option value="41">41</option>
															<option value="42">42</option>
															<option value="43">43</option>
															<option value="44">44</option>
															<option value="45">45</option>
															<option value="46">46</option>
															<option value="47">47</option>
															<option value="48">48</option>
															<option value="49">49</option>
															<option value="50">50</option>
															<option value="51">51</option>
															<option value="52">52</option>
															<option value="53">53</option>
															<option value="54">54</option>
															<option value="55">55</option>
															<option value="56">56</option>
															<option value="57">57</option>
															<option value="58">58</option>
															<option value="59">59</option>
														</select>
														&nbsp;&nbsp;to&nbsp;&nbsp;
														<select class="form-control" name="hof" style="width:72px;">
															<option value="06">06</option>
															<option value="07">07</option>
															<option value="08">08</option>
															<option value="09">09</option>
															<option value="10">10</option>
															<option value="11">11</option>
															<option value="12">12</option>
															<option value="13">13</option>
															<option value="14">14</option>
															<option value="15">15</option>
															<option value="16">16</option>
															<option value="17">17</option>
															<option value="18">18</option>
															<option value="19">19</option>
															<option value="20">20</option>
															<option value="21">21</option>
															<option value="22">22</option>
															<option value="23">23</option>
															<option value="00">00</option>
															<option value="01">01</option>
															<option value="02">02</option>
															<option value="03">03</option>
															<option value="04">04</option>
															<option value="05">05</option>
														</select>
														&nbsp;&nbsp;:&nbsp;&nbsp;
														<select class="form-control" name="mif" style="width:72px;">
															<option value="00">00</option>
															<option value="01">01</option>
															<option value="02">02</option>
															<option value="03">03</option>
															<option value="04">04</option>
															<option value="05">05</option>
															<option value="06">06</option>
															<option value="07">07</option>
															<option value="08">08</option>
															<option value="09">09</option>
															<option value="10">10</option>
															<option value="11">11</option>
															<option value="12">12</option>
															<option value="13">13</option>
															<option value="14">14</option>
															<option value="15">15</option>
															<option value="16">16</option>
															<option value="17">17</option>
															<option value="18">18</option>
															<option value="19">19</option>
															<option value="20">20</option>
															<option value="21">21</option>
															<option value="22">22</option>
															<option value="23">23</option>
															<option value="24">24</option>
															<option value="25">25</option>
															<option value="26">26</option>
															<option value="27">27</option>
															<option value="28">28</option>
															<option value="29">29</option>
															<option value="30">30</option>
															<option value="31">31</option>
															<option value="32">32</option>
															<option value="33">33</option>
															<option value="34">34</option>
															<option value="35">35</option>
															<option value="36">36</option>
															<option value="37">37</option>
															<option value="38">38</option>
															<option value="39">39</option>
															<option value="40">40</option>
															<option value="41">41</option>
															<option value="42">42</option>
															<option value="43">43</option>
															<option value="44">44</option>
															<option value="45">45</option>
															<option value="46">46</option>
															<option value="47">47</option>
															<option value="48">48</option>
															<option value="49">49</option>
															<option value="50">50</option>
															<option value="51">51</option>
															<option value="52">52</option>
															<option value="53">53</option>
															<option value="54">54</option>
															<option value="55">55</option>
															<option value="56">56</option>
															<option value="57">57</option>
															<option value="58">58</option>
															<option value="59">59</option>
														</select>
													</div>
												</div>
									';

							$sql4 = "SELECT locn_code cod,locc_name nam FROM bloc_location ORDER BY 2;";
							$trns = $pdo -> query($sql4);
							echo 	'
												<div class="row">
													<div class="col">&nbsp;</div>
												</div>
												<div class="row">
													<div class="col-md-12"loc>
														<div class="form-group">
															<label for="loc">Choose your location</label>
															<select name="loc" class="form-control">
									';
							while ($trn = $trns -> fetch()) 
							{
								echo 	'
																<option value="'.$trn['cod'].'">'.$trn['nam'].'</option>
										';
							}
							echo 	'
															</select>
														</div>
													</div>
												</div>
									';

							$sql5 = "SELECT gron_code cod,groc_name nam FROM bgro_group ORDER BY 2;";
							$trns = $pdo -> query($sql5);
							echo 	'
												<div class="row">
													<div class="col">&nbsp;</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label for="lea">Type of Learning</label>
															<select name="lea" class="form-control">
									';
							while ($trn = $trns -> fetch()) 
							{
								echo 	'
																<option value="'.$trn['cod'].'">'.$trn['nam'].'</option>
										';
							}
							echo 	'
															</select>
														</div>
													</div>
												</div>
									';
							echo 	'			<div class="row">
													<div class="col">
														<textarea name="des" class="form-control" placeholder="Write here more about your activity..." required></textarea>
													<div>
												</div>
												<hr width=100%>
												<div class="row">	
													<div class="col-lg-12">
														<div class="form-group" align="right">
															<input type="submit" name="smd" class="btn btn-primary btn-lg btn-block" value="Add it" style="background-color:#F08E8E">
														</div>	
													</div>	
												</div>	
									';

							echo 	'
											</div>
										</div>
									';
						}
					?>

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

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</body>
</html>