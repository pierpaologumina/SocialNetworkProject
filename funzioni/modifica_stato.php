<?php
$con = new mysqli("localhost", "pier","","social_network");
session_start();
if (isset($_GET['id_libro'])){
    $id_libro = $_GET['id_libro'];
    $metodo = $_GET['metodo'];
    $utente = $_SESSION['user_email'];
    $get_utente_info = "SELECT * FROM prova WHERE email='$utente'";
    $run_utente_info = mysqli_query($con, $get_utente_info);
    $row_utente_info = mysqli_fetch_array($run_utente_info);
    $id_mio = $row_utente_info['id_utente'];

    if($metodo == 'disponibile'){


        $get_libri_info = "SELECT * FROM bookcrossing WHERE utente_inserito='$id_mio'";
        $run_libri_info = mysqli_query($con, $get_libri_info);
        $conteggio_donati = mysqli_num_rows($run_libri_info);


        $get_libri_info2 = "SELECT * FROM bookcrossing WHERE possessore='$id_mio'";
        $run_libri_info2 = mysqli_query($con, $get_libri_info2);
        $conteggio_presi = mysqli_num_rows($run_libri_info2);

        if($conteggio_donati>$conteggio_presi){
            $data = date("Y/m/d");
            $update = "UPDATE bookcrossing SET stato='ritiro', possessore='$id_mio', data_possesso='$data' WHERE id='$id_libro'";
            $run = mysqli_query($con, $update);
            if ($run){
                echo "<script>alert('Aggiorno le nuove informazioni..')</script>";
                echo "<script>window.open('../bookcrossing.php?u_id=$id_mio','_self')</script>";
            }
        }else{
            echo "<script>alert('Per poter prendere un libro prima donane uno alla comunità (Grazie di ♥)..')</script>";
            echo "<script>window.open('../bookcrossing.php?u_id=$id_mio','_self')</script>";
        }
    }elseif ($metodo=='donazione'){
        $update = "UPDATE bookcrossing SET stato='disponibile' WHERE id='$id_libro'";
        $run = mysqli_query($con, $update);
        if ($run){
            echo "<script>alert('Aggiorno le nuove informazioni..')</script>";
            echo "<script>window.open('../bookcrossing.php?u_id=$id_mio','_self')</script>";
        }
    }elseif ($metodo=='ritiro'){
        $update = "UPDATE bookcrossing SET stato='lettura' WHERE id='$id_libro'";
        $run = mysqli_query($con, $update);
        if ($run){
            echo "<script>alert('Aggiorno le nuove informazioni..')</script>";
            echo "<script>window.open('../bookcrossing.php?u_id=$id_mio','_self')</script>";
        }
    }elseif ($metodo=='lettura'){
        $recensione = htmlentities($_POST['prova2']);

        if($recensione!=''){

            $data = date("Y/m/d");
            $insert = "INSERT INTO recensioni (id_libro,id_utente,testo,data) VALUES ('$id_libro','$id_mio','$recensione','$data')";
            $run_insert = mysqli_query($con,$insert);


            if($run_insert){
                echo "<script>alert('Recensione aggiunta correttamente!')</script>";

            }
        }
        $update = "UPDATE bookcrossing SET stato='rimessa' WHERE id='$id_libro'";
        $run = mysqli_query($con, $update);
        if ($run){
            echo "<script>alert('Aggiorno le nuove informazioni..')</script>";
            echo "<script>window.open('../bookcrossing.php?u_id=$id_mio','_self')</script>";
        }
    }elseif ($metodo=='rimessa'){
        $nuovo_luogo = htmlentities($_POST['prova']);

        if($nuovo_luogo!='') {
            $update = "UPDATE bookcrossing SET stato='disponibile', possessore=NULL, data_possesso=NULL, luogo='$nuovo_luogo' WHERE id='$id_libro'";
            $run = mysqli_query($con, $update);
            if ($run) {
                echo "<script>alert('Aggiorno le nuove informazioni..')</script>";
                echo "<script>window.open('../bookcrossing.php?u_id=$id_mio','_self')</script>";
            }
        }else{
            echo "<script>alert('Perfavore, inserisci un luogo di rilascio valido.')</script>";
            echo "<script>window.open('../bookcrossing.php?u_id=$id_mio','_self')</script>";
        }
    }elseif ($metodo=='cancella_ritiro'){
        $update = "UPDATE bookcrossing SET stato='disponibile', possessore=NULL, data_possesso=NULL WHERE id='$id_libro'";
        $run = mysqli_query($con, $update);
        if ($run){
            echo "<script>alert('Aggiorno le nuove informazioni..')</script>";
            echo "<script>window.open('../bookcrossing.php?u_id=$id_mio','_self')</script>";
        }
    }





}

