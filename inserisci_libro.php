<?php
if (isset($_POST['inserisci_libro'])){

    $con = new mysqli("localhost", "pier","","social_network");

    $nome = htmlentities($_POST['nome']);
    $autore = htmlentities($_POST['autore']);
    $edizione = htmlentities($_POST['edizione']);
    $condizione = htmlentities($_POST['condizione']);
    $prezzo = htmlentities($_POST['prezzo']);
    $u_facolta = htmlentities($_POST['u_facolta']);
    $telefono = htmlentities($_POST['telefono']);
    $data=date("Y/m/d");


    $upload_image = $_FILES['foto']['name'];
    $image_tmp = $_FILES['foto']['tmp_name'];
    $random_number = rand(1,100);
    $img_salvata = $random_number.$upload_image;
    move_uploaded_file($image_tmp, "img_libri/$img_salvata");


    $id_utente = $_GET['idd'];


    $insert = "INSERT INTO libri (corso,titolo_testo,edizione,autore,caricato_da,condizione,prezzo,caricato_il,img_libro,info) VALUES ('$u_facolta','$nome','$edizione','$autore','$id_utente','$condizione','$prezzo','$data','$img_salvata','$telefono')";
    $run_insert = mysqli_query($con,$insert);

    if($run_insert){
        echo "<script>alert('Libro aggiunto correttamente!')</script>";
        echo "<script>window.open('libri.php', '_self')</script>";

    }

}

?>