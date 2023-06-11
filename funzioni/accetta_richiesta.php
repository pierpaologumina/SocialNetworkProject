<?php
$con = new mysqli("localhost", "pier","","social_network");


if(isset($_GET['id_relazione'])){
    $id_relazione = $_GET['id_relazione'];

    $accetta_richiesta = "UPDATE relazioni SET stato=1 WHERE id_relazione='$id_relazione'";

    $run_accetta_richiesta = mysqli_query($con,$accetta_richiesta);

    if($run_accetta_richiesta){
        echo "<script>alert('Richiesta Cancellata Correttamente!')</script>";
        echo "<script>window.open('../amici.php', '_self')</script>";

    }
}

?>