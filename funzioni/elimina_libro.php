<?php

$con = new mysqli("localhost", "pier","","social_network");

if(isset($_GET['id_libro'])){
    $id_libro = $_GET['id_libro'];

    $delete_commento_post = "DELETE FROM libri WHERE id_libro='$id_libro'";

    $run_delete = mysqli_query($con,$delete_commento_post);

    if($run_delete){
        echo "<script>alert('Libro rimosso dalla Libreria!')</script>";
        echo "<script>window.open('../libri.php', '_self')</script>";
    }
}

?>