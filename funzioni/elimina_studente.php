<?php
$con = new mysqli("localhost", "pier","","social_network");


if(isset($_GET['id_studente'])){
    $id_studente = $_GET['id_studente'];

    $cancella_studente = "DELETE FROM prova WHERE id_utente='$id_studente'";

    $run_studente = mysqli_query($con,$cancella_studente);

    if($run_studente){
        echo "<script>alert('Studente Rimosso Correttamente!')</script>";
        echo "<script>window.open('../home_admin.php', '_self')</script>";

    }
}

?>