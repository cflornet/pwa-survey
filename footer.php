<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<script src="assets/js/typeahead.bundle.js"></script>
<script src="sw.js"></script>

<script>
    
    
    <?php
    //Proposes db activities as completions typeahead
        $sql8 = "SELECT catc_name catn FROM bcat_category";
        $req = $pdo -> query($sql8);
        echo '
            var activities = [';
                while ($acta = $req -> fetch()) {
                    echo '"';
                    echo $acta['catn'];
                    echo '", ';
                }
            echo '];     
        ';

    //Proposes db locations as completions typeahead - JQuery
    $sql9 = "SELECT locc_name loc FROM bloc_location";
    $req = $pdo -> query($sql9);
    echo '
            var locations = [';
                while ($loca = $req -> fetch()) {
                    echo '"';
                    echo $loca['loc'];
                    echo '", ';
                }
                echo '];     
        ';
    ?>

    

</script>
<script src="assets/js/index-min.js"></script>
<script src="assets/js/functions.js"></script>


<script src="assets/js/script.js"></script>
<script src="assets/js/write.js"></script>
<script src="assets/js/mod.js"></script>

