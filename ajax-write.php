<?php
require_once "admin/connectDB.req.php";


if(isset($_POST['action']) && $_POST['action'] == 'get_dates') { //Index.php : get Dates select to see entries
    $usr_id = $_POST['usr_id'];

    $sql2 = "SELECT y.diaf_date dat  FROM sdia_diary y WHERE y.dian_status = 1 AND y.diac_student = '".$usr_id."' ORDER BY 1;";
    $trns = $pdo -> query($sql2);
    echo 	'
                <div class="row">
                    <div class="col-md-12">
                        <select name="fec" class="form-control">
            ';
    while ($trn = $trns -> fetch()) 
    {
        $date=date_create($trn['dat']);
    	if($trn['dat'] == $_SESSION['fec'])
	{
        echo 	'
		<option value="'.$trn['dat'].'" selected>'.date_format($date,"l jS").'</option>
		';
	}
	else
	{
	echo 	'
	<option value="'.$trn['dat'].'">'.date_format($date,"l jS").'</option>
	';
		}
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

if(isset($_POST['action']) && $_POST['action'] == 'get_write_form') { //write.php : get the form to add an activity
    $now = new DateTime("now");
    $usr_id = $_POST['usr_id'];

    $sql2 = "SELECT y.diaf_date dat  FROM sdia_diary y WHERE y.dian_status = 1 AND y.diac_student = '".$usr_id."' AND y.diaf_date >= (now() - INTERVAL 3 DAY) ORDER BY 1;";
    $trns = $pdo -> query($sql2);
    echo 	'
                        <div class="row">
                            <div class="col-md-12">
                                <select name="fec" class="form-control">
            ';
    while ($trn = $trns -> fetch()) 
    {
        $date=date_create($trn['dat']);
        $interval = date_diff($date, $now, FALSE);
        if($date < $now)
        {
            $days = intval($interval->format('%a'));	
        }
        else
        {
            $days = 0;		
        }
        if($days > 0)
        {
            echo 	'
                                <option value="'.$trn['dat'].'" style="background-color:red;color:#fff;">'.date_format($date,"l jS").'</option>
                    ';
        }
        else
        {
            echo 	'
                                <option value="'.$trn['dat'].'">'.date_format($date,"l jS").'</option>
                    ';
        }
    }
    echo 	'
                                </select>
                            </div>
                        </div>
            ';
    echo 	'
                        <div class="row">
                            <div class="col">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="the-activities" class="form-group">
                                    <label for="act">Activity</label>
                                    <input type="text" name="act" class="form-control typeahead">
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
                                <div class="input-group">
                                <select class="form-control" id="hoi" name="hoi" style="width:62px;font-size:smaller;" onchange="javascript:validateHour();">';
                                for($i = 6; $i <= 23; $i++) {
                                    $n = $i;
                                    if($i < 10)	$n = '0'.$i;

                                    echo '<option value="'.$n.'">'.$n.'</option>';
                                }
                                for($i = 0; $i <= 5; $i++) {
                                    $n = $i;
                                    if($i < 10)	$n = '0'.$i;

                                    echo '<option value="'.$n.'">'.$n.'</option>';
                                }

                                echo '</select>
                                <span class="input-group-addon">:</span>
                                <select class="form-control" id="mii" name="mii" style="width:62px;font-size:smaller;" onchange="javascript:validateHour();">';
                                for($i = 0; $i <= 59; $i++) {
                                    $n = $i;
                                    if($i < 10)	$n = '0'.$i;

                                    echo '<option value="'.$n.'">'.$n.'</option>';
                                }
                                echo '</select>
                                <span class="input-group-addon">&nbsp;to&nbsp;</span>
                                <select class="form-control" id="hof" name="hof" style="width:62px;font-size:smaller;" onchange="javascript:validateHour();">';
                                for($i = 6; $i <= 23; $i++) {
                                    $n = $i;
                                    if($i < 10)	$n = '0'.$i;

                                    echo '<option value="'.$n.'">'.$n.'</option>';
                                }
                                for($i = 0; $i <= 5; $i++) {
                                    $n = $i;
                                    if($i < 10)	$n = '0'.$i;

                                    echo '<option value="'.$n.'">'.$n.'</option>';
                                }
                                echo '</select>
                                <span class="input-group-addon">:</span>
                                <select class="form-control" id="mif" name="mif" style="width:62px;font-size:smaller;" onchange="javascript:validateHour();">';
                                for($i = 0; $i <= 59; $i++) {
                                    $n = $i;
                                    if($i < 10)	$n = '0'.$i;

                                    echo '<option value="'.$n.'">'.$n.'</option>';
                                }
                                echo '</select>
                                </div>      
                            </div>
                        </div>
            ';

    echo 	'
                        <div class="row">
                            <div class="col">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 loc">
                                <div id="the-locations" class="form-group">
                                    <label for="loc">Location</label>
                                    <input type="text" name="loc" class="form-control typeahead">
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
                                <textarea name="des" class="form-control" placeholder="Write here more about your activity..."></textarea>
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
?>
        </div>
    </div>
    
    <div class="row">						
    </div>
<?php
}

if(isset($_POST['action']) && $_POST['action'] == 'add_entry') { //write.php : add entry to diary
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

    $sql7 = "SELECT COUNT(*) AS total FROM sdid_diary_detail WHERE didf_hour = '".$dat->format('Y-m-d H:i:s')."' AND didf_date = '".$fec."' AND didc_student = '".$_POST['usr_id']."';";
        
    $data = $pdo -> query($sql7);
        
    if ($data->fetchColumn() > 0)
    {
        echo("Error: The hour already exists, please verify the info");
    }
    else
    {
        $sql6 = "INSERT INTO sdid_diary_detail(didf_hour,didf_date,didc_student,didn_category,didn_location,didn_group,didn_duration,didc_description) VALUES('".$dat->format('Y-m-d H:i:s')."','".$fec."','".$_POST['usr_id']."','".$act."','".$loc."',".$lea.",".$tim.",'".$des."');";

        $data = $pdo -> query($sql6);

        if($data !== false)
            //echo "<div class='alert alert-success' role='alert'><span class='sr-only'>Success:</span>The info was submit</div>";
            echo "";
        else 
            echo 'Error, please try later';
    }

    
}

if(isset($_POST['action']) && $_POST['action'] == 'login') {
    $tok = $_POST['cod1'].$_POST['cod2'].$_POST['cod3'].$_POST['cod4'];

    $sql = "SELECT COUNT(*) AS total FROM buse_user WHERE usen_status = 1 AND usec_id = '".$tok."';";

    $data = $pdo -> query($sql);
    if ($data->fetchColumn() > 0) 
    {

        $sql = "SELECT usec_name nam,usec_surname sur,usen_status sta FROM buse_user WHERE usen_status = 1 AND usec_id = '".$tok."';";
        $data2 = $pdo -> query($sql);
        
        while ($row = $data2 -> fetch()) 
        {
            $obj = [
                'usr_id' => $tok,
                'usr_status' => 1,
                'usr_name' => $row['nam']
            ];
        }

        echo json_encode($obj);

    
    }
    else {
        $obj = [
            'usr_id' => '',
            'usr_status' => 0,
            'usr_name' => ''
        ];

        echo json_encode($obj);
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'get_activities') {
    $fec = $_POST['fec'];
    $usr_id = $_POST['usr_id'];

    $sql2 = "	SELECT 		d.didf_id id, 
                            d.didf_hour hou,
                            d.didn_category cat,
                            d.didn_location loc,
                            d.didn_group coe,
                            e.groc_name lea,
                            d.didn_duration dur,
                            ADDTIME(d.didf_hour,(d.didn_duration*10000)) hof,	
                            d.didc_description des
                FROM 		sdid_diary_detail d,
                            bgro_group e
                WHERE 		d.didn_group = e.gron_code AND
                            d.didf_date = '".$fec."' AND
                            d.didc_student = '".$usr_id."';
            ";

    $trns = $pdo -> query($sql2);
    while ($trn = $trns -> fetch()) 
    {
        $dati=date_create($trn['hou']);
        $datf=date_create($trn['hof']);
        $now = new DateTime('now');
        $interval = date_diff($dati, $now);
        $dfin = $interval->format('%a');

        $didf_id = $trn['id'];

        if($dfin >= 0 && $dfin < 3)
        {
            echo 	'
                        <hr width="100%">
                        <div class="card">
                            <div< class="card-header" style="background-color:#1B5082;color:#fff">
                    '.$dati->format('H:i').' to '.$datf->format('H:i').' - <a href="mod.php?didf_id='.$didf_id.'" style="color:#fff">Modify</a> / <a href="del.php?didf_id='.$didf_id.'" style="color:#fff">Delete</a>
                        </div>
                    ';
        }
        else
        {
            echo 	'
                        <hr width="100%">
                        <div class="card">
                            <div< class="card-header" style="background-color:#1B5082;color:#fff">
                    '.$dati->format('H:i').' to '.$datf->format('H:i').'
                        </div>
                    ';
        }
        echo 	'
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

if(isset($_POST['action']) && $_POST['action'] == 'get_modify_form') {
    $id = $_POST['id'];
    $usr = $_POST['usr'];

    $sql3 = "SELECT didf_hour hou,didf_date dat,didn_category cat,didn_location loc,didn_group gro,didn_duration dur,didc_description des FROM sdid_diary_detail WHERE didf_id = '".$id."' AND didc_student = '".$usr."';";								
    $trns = $pdo -> query($sql3);
    while ($trn = $trns -> fetch()) 
    {
        $date=date_create($trn['dat']);
        echo 	'
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="fet" class="form-control" value="'.date_format($date,"l jS").'" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" id="the-activities">
                                    <label for="act">Activity</label>
                                    <input type="text" name="act" class="form-control typeahead" value="'.$trn['cat'].'">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" id="the-locations">
                                    <label for="act">Location</label>
                                    <input type="text" name="loc" class="form-control typeahead" value="'.$trn['loc'].'">
                                </div>
                            </div>
                        </div>
                ';

                echo 	'	<div class="row">
                                <div class="col">
                                    <textarea name="des" class="form-control" required>'.$trn['des'].'</textarea>
                                <div>
                            </div>
                            <hr width=100%>
                            <div class="row">	
                                <div class="col-lg-12">
                                    <div class="form-group" align="right">
                                        <input type="hidden" name="didf_id" value="'.$id.'">
                                        <input type="submit" name="smd" class="btn btn-primary btn-lg btn-block" value="Update" style="background-color:#F08E8E">
                                    </div>	
                                </div>	
                            </div>	
                        </div>
                    </div>
                ';
    }
}


if(isset($_POST['action']) && $_POST['action'] == 'modify_entry') {
    $act = $_POST['act'];
    $loc = $_POST['loc'];
    $des = $_POST['des'];	

    $id = $_POST['didf_id'];
    

    $sql6 = "UPDATE sdid_diary_detail SET didn_category = '".$act."',didn_location = '".$loc."',didc_description = '".$des."' WHERE didf_id = '".$id."';";

    $data = $pdo -> query($sql6);
}


if(isset($_POST['action']) && $_POST['action'] == 'delete_entry') {
    $id = $_POST['didf_id'];

    $sql6 = "DELETE FROM sdid_diary_detail WHERE didf_id = '".$id."';";

    $data = $pdo -> query($sql6);
}

if(isset($_POST['action']) && $_POST['action'] == 'test_online') {
    
}



if(isset($_POST['action']) && $_POST['action'] == 'get_summary_form') {
    $usr_id = $_POST['usr_id'];

    $sql2 = "SELECT y.diaf_date dat  FROM sdia_diary y WHERE y.dian_status = 1 AND y.diac_student = '".$usr_id."' ORDER BY 1;";
    $trns = $pdo -> query($sql2);
    echo    '
                            <div class="row">
                                <div class="col-md-12">
                                    <select name="fec" class="form-control">
            ';
    while ($trn = $trns -> fetch()) 
    {
        $date=date_create($trn['dat']);
        echo    '
                            <option value="'.$trn['dat'].'">'.date_format($date,"l jS").'</option>
                ';
    }
        echo    '
                                    </select>
                                </div>
                            </div>
                ';
    ?>
    &nbsp;
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="summ">If you’re done with your day, which emoji would best describe your feeling of the day&nbsp;?</label>
                <textarea name="summ" class="form-control" required></textarea>
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
    <hr width=100%>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group" align="center">
                <input type="submit"  name="smd" class="btn btn-warning" value="Validate your day" style="border-radius: 100px;color:white;">
            </div>
        </div>
    </div>
    <?php
}