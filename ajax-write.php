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

if(isset($_POST['action']) && $_POST['action'] == 'get_write_form') {
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
                                <select class="form-control" id="hoi" name="hoi" style="width:72px;" onchange="javascript:validateHour();">';
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
                                &nbsp;&nbsp;:&nbsp;&nbsp;
                                <select class="form-control" id="mii" name="mii" style="width:72px;" onchange="javascript:validateHour();">';
                                for($i = 0; $i <= 59; $i++) {
                                    $n = $i;
                                    if($i < 10)	$n = '0'.$i;

                                    echo '<option value="'.$n.'">'.$n.'</option>';
                                }
                                echo '</select>
                                &nbsp;&nbsp;to&nbsp;&nbsp;
                                <select class="form-control" id="hof" name="hof" style="width:72px;" onchange="javascript:validateHour();">';
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
                                &nbsp;&nbsp;:&nbsp;&nbsp;
                                <select class="form-control" id="mif" name="mif" style="width:72px;" onchange="javascript:validateHour();">';
                                for($i = 0; $i <= 59; $i++) {
                                    $n = $i;
                                    if($i < 10)	$n = '0'.$i;

                                    echo '<option value="'.$n.'">'.$n.'</option>';
                                }
                                echo '</select>
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
        echo("<div class='alert alert-danger' role='alert'><span class='sr-only'>Error:</span>The hour already exists, please verify the info</div>");
    }
    else
    {
        $sql6 = "INSERT INTO sdid_diary_detail(didf_hour,didf_date,didc_student,didn_category,didn_location,didn_group,didn_duration,didc_description) VALUES('".$dat->format('Y-m-d H:i:s')."','".$fec."','".$_POST['usr_id']."','".$act."',".$loc.",".$lea.",".$tim.",'".$des."');";

        $data = $pdo -> query($sql6);

        if($data !== false)
            echo 'OK';
        else 
            echo 'ERR';
    }

    
}