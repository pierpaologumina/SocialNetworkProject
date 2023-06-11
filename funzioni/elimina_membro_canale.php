<?php
$con = new mysqli("localhost", "pier","","social_network");


if(isset($_GET['id_m'])){
    $id_m = $_GET['id_m'];

    $delete_post = "DELETE FROM mebri_canali WHERE id_m='$id_m'";

    $run_delete = mysqli_query($con,$delete_post);

    if($run_delete){
        echo "<script>alert('Studente rimosso correttamente!')</script>";
        echo "<script>window.open('../gestore_canali.php', '_self')</script>";

    }
}

?>