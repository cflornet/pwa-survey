<?
    require_once "admin/connectDB.req.php";

    session_start();

    if (isset($_POST['smd']))
    {
        //$aday = date('2020-06-11');
        $date = $_POST['fec'];
        $sql4 = "UPDATE sdia_diary SET diac_summary='".$_POST['summ']."',dian_smiley=".$_POST['smi'].",dian_status=2 WHERE diac_student='".$_SESSION['usr_id']."' AND diaf_date='".$date."';";
        $data = $pdo->query($sql4);
        header("Location: write.php");
    }
    require_once "header.php";
?>
<body>
<div class="container">
    <nav class="navtop">
        <div>   
            <a class="float-right" href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
            <a class="float-right" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </nav>
    <div class="row">
        <div class="col">
            &nbsp;
        </div>
    </div>
    <div class="text-center">
        <a href="index.php">
            <img src="assets/img/Feed.png" class="img-fluid" alt="Responsive image">
            <img src="assets/img/back.png" class="img-fluid" alt="Responsive image">
        </a>
    </div>
    <div class="card" style="background-color: #E5E5E5">
        <div class="card-title">
            <a href="javascript:history.back()">Go Back</a>
            <h4>Today's Workflow</h4>
        </div>
        <div class="card-body">
            <form method="post" id="summaryForm">
                <div class="row">
                    <div class="col-md-12">
                        <select name="fec" id="select_date" class="form-control">

                        </select>
                    </div>
                </div>

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

            </form>

            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center" align="center">
                        <p>&nbsp;</p>
                        <a href="index.php"><img src="assets/img/see2.png" class="img-fluid" alt="Responsive image"></a>
                        <a href="write.php"><img src="assets/img/edit2.png" class="img-fluid" alt="Responsive image"></a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<?php
require_once('footer.php');
?>
<script src="assets/js/summary.js"></script>
</body>
</html>
