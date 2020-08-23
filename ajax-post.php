<?php
require_once "admin/connectDB.req.php";

if(isset($_POST['action'])) {
    switch($_POST['action']) {
        case 'get_user_dates':
            $usr_id = $_POST['usr_id'];

            $sql2 = "SELECT y.diaf_date dat  FROM sdia_diary y WHERE y.dian_status = 1 AND y.diac_student = '".$usr_id."' ORDER BY 1;";
            $trns = $pdo->query($sql2);

            $dates = [];

            while ($trn = $trns->fetch(PDO::FETCH_ASSOC)) {
                $dates[] = $trn['dat'];
            }

            echo json_encode($dates);
            break;

        case 'get_user_activities':
            $usr_id = $_POST['usr_id'];

            $requestSql = "SELECT
                            detail.didf_id id, 
                            detail.didf_date date, 
                            detail.didf_hour start_hour, 
                            ADDTIME(detail.didf_hour,(detail.didn_duration*10000)) end_hour,
                            detail.didn_category category, 
                            detail.didn_location location, 
                            detail.didn_group group_id, 
                            group_table.groc_name group_name, 
                            detail.didc_description description

                            FROM 
                            sdid_diary_detail detail

                            JOIN 
                            bgro_group group_table ON detail.didn_group = group_table.gron_code 

                            WHERE 
                            detail.didc_student = '".$usr_id."'

                            ";

            $query = $pdo->query($requestSql);

            $activities = [];
            while($entry = $query->fetch(PDO::FETCH_ASSOC)) {
                $activities[] = $entry;
            }

            echo json_encode($activities);
            break;

        case 'get_groups':
            $requestSql = "SELECT gron_code as id, groc_name as name FROM bgro_group";
            $query = $pdo->query($requestSql);

            $groups = [];

            while ($entry = $query->fetch(PDO::FETCH_ASSOC)) {
                $groups[] = $entry;
            }

            echo json_encode($groups);
            break;

        case 'login':
            $tok = $_POST['cod1'].$_POST['cod2'].$_POST['cod3'].$_POST['cod4'];

            $sql = "SELECT COUNT(*) AS total FROM buse_user WHERE usen_status = 1 AND usec_id = '".$tok."';";

            $data = $pdo->query($sql);
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
            break;

        case 'add_activity':
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
                echo "Error: The hour already exists, please verify the info";
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
            break;

        case 'modify_activity':
            $act = $_POST['act'];
            $loc = $_POST['loc'];
            $des = $_POST['des'];	

            $id = $_POST['didf_id'];
            

            $requestSql = "UPDATE sdid_diary_detail SET didn_category = '".$act."',didn_location = '".$loc."',didc_description = '".$des."' WHERE didf_id = '".$id."';";

            $data = $pdo->query($requestSql);
            break;

        case 'delete_activity':
            $id = $_POST['didf_id'];

            $requestSql = "DELETE FROM sdid_diary_detail WHERE didf_id = '".$id."';";

            $data = $pdo->query($requestSql);
            break;

        case 'add_summary':
            $date = $_POST['fec'];
            $sql4 = "UPDATE sdia_diary SET diac_summary='".$_POST['summ']."',dian_smiley=".$_POST['smi'].",dian_status=2 WHERE diac_student='".$_POST['usr_id']."' AND diaf_date='".$date."';";
            $data = $pdo->query($sql4);
            break;

        case 'test_online':
            echo json_encode(true);
            break;
    }
}