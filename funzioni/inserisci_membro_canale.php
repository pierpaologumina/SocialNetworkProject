<?php
$con = new mysqli("localhost", "pier","","social_network");


if(isset($_GET['id_studente']) && isset($_GET['id_canale'])){
    $id_studente = $_GET['id_studente'];
    $id_canale = $_GET['id_canale'];

    $insert = "INSERT INTO mebri_canali (id_studente,id_canale) VALUES ('$id_studente','$id_canale')";

    $run_insert = mysqli_query($con,$insert);

    if($run_insert){
        echo "<script>alert('Studente aggiunto correttamente!')</script>";
        echo "<script>window.open('../gestore_canali.php', '_self')</script>";

    }
}

?>