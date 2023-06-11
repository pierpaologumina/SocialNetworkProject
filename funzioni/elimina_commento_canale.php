<?php
$con = new mysqli("localhost", "pier","","social_network");


if(isset($_GET['id_commento'])){
    $id_commento = $_GET['id_commento'];

    $delete_commento_post = "DELETE FROM commenti_canali WHERE id_commento='$id_commento'";

    $run_delete = mysqli_query($con,$delete_commento_post);

    if($run_delete){
        echo "<script>alert('Commento rimosso correttamente!')</script>";
        echo "<script>window.open('../gestore_canali.php', '_self')</script>";

    }
}

?>