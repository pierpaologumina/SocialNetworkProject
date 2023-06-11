<?php
$con = new mysqli("localhost", "pier","","social_network");


if(isset($_GET['id_relazione'])){
    $id_relazione = $_GET['id_relazione'];

    $cancella_richiesta = "DELETE FROM relazioni WHERE id_relazione='$id_relazione'";

    $run_richiesta = mysqli_query($con,$cancella_richiesta);

    if($run_richiesta){
        echo "<script>alert('Richiesta Cancellata Correttamente!')</script>";
        echo "<script>window.open('../amici.php', '_self')</script>";

    }
}

?>