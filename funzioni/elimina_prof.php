<?php
$con = new mysqli("localhost", "pier","","social_network");


if(isset($_GET['id_prof'])){
    $id_prof = $_GET['id_prof'];

    $cancella_prof = "DELETE FROM professori WHERE id_prof='$id_prof'";

    $run_prof = mysqli_query($con,$cancella_prof);

    if($run_prof){
        echo "<script>alert('Professore Rimosso Correttamente!')</script>";
        echo "<script>window.open('../home_admin.php', '_self')</script>";

    }
}

?>