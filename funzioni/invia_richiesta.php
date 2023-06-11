<?php
$con = new mysqli("localhost", "pier","","social_network");


if(isset($_GET['id_utente']) && isset($_GET['mestesso'])){
    $id_utente = $_GET['id_utente'];
    $mestesso = $_GET['mestesso'];


    $get_user = "SELECT * FROM prova WHERE email='$mestesso'";
    $run_user = mysqli_query($con, $get_user);
    $row_user = mysqli_fetch_array($run_user);
    $user_id = $row_user['id_utente'];

    $stato=0;
    $tipo="Studente";

    $insert = "INSERT INTO relazioni (id_utente,amico_di,stato,tipo) VALUES ('$user_id','$id_utente','$stato','$tipo')";

    $run_insert = mysqli_query($con,$insert);

    if($run_insert){
        echo "<script>alert('Richiesta Inviata!')</script>";
        echo "<script>window.open('../amici.php', '_self')</script>";

    }
}

?>