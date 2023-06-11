<?php
$con = new mysqli("localhost", "pier","","social_network");


if(isset($_GET['id_canale'])){
    $id_canale = $_GET['id_canale'];

    $cancella_canale = "DELETE FROM canali WHERE id_canale='$id_canale'";

    $run_delete = mysqli_query($con,$cancella_canale);

    if($run_delete){
        echo "<script>alert('Commento rimosso correttamente!')</script>";
        echo "<script>window.open('../gestore_canali.php', '_self')</script>";

    }
}

?>