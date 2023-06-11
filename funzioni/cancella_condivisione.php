<?php

$con = new mysqli("localhost", "pier","","social_network");

if(isset($_GET['id_appunto'])){
    $id_appunto = $_GET['id_appunto'];

    $delete_appunto = "DELETE FROM appunti WHERE id_appunto='$id_appunto'";

    $run_delete = mysqli_query($con,$delete_appunto);

    if($run_delete){
        echo "<script>alert('Appunti rimossi!')</script>";
        echo "<script>window.open('../home.php', '_self')</script>";
    }
}

?>