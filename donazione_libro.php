<?php
if (isset($_POST['inserisci_libro'])){

    $con = new mysqli("localhost", "pier","","social_network");

    $nome = htmlentities($_POST['nome']);
    $autore = htmlentities($_POST['autore']);
    $luogo = htmlentities($_POST['luogo']);

    $data=date("Y/m/d");



    $numberr=rand(1,500);
    $bcid = $nome.$numberr;


    $upload_image = $_FILES['foto']['name'];
    $image_tmp = $_FILES['foto']['tmp_name'];
    $random_number = rand(100,200);
    $img_salvata = $random_number.$upload_image;
    move_uploaded_file($image_tmp, "img_libri/$img_salvata");


    $id_utente = $_GET['idd'];

    $insert = "INSERT INTO bookcrossing (bcid,titolo,autore,img_copertina,utente_inserito,data_inserimento,stato,luogo) VALUES ('$bcid','$nome','$autore','$img_salvata','$id_utente','$data','donazione','$luogo')";
    $run_insert = mysqli_query($con,$insert);

    if($run_insert){
        echo "<script>alert('Libro aggiunto correttamente!')</script>";
        echo "<script>window.open('bookcrossing.php?u_id=$id_utente', '_self')</script>";

    }

}

?>