<?php

include("includes/connection.php");

if ($con->connect_errno){
    echo "<script>alert('ERRORE NELLA CONNESSIONE COL DB. Riprova piu tardi o contatta il tecnico')</script>";
    echo "<script>window.open('iscriviti.php', '_self')</script>";
    exit();
}
        $nome=$_POST["nome"];
        $cognome=$_POST["cognome"];

        $newgid=sprintf('%05d', rand(0,999999));
        $username=strtolower($nome . "_" . $cognome . "_" . $newgid);

        $pass=$_POST["u_pass"];
        $email=$_POST["u_email"];
        $paese=$_POST["u_country"];
        $sesso=$_POST["u_gender"];
        $compleanno=$_POST["u_birthday"];
        $status="verified";
        $posts="no";
        $descrizione="Descrizione di default, iserisci la tua descrizione!";
        $relazioni="...";
        $user_cover="default_cover.jpg";

        $rand = rand(1, 3);
        if($rand == 1){
            $profile_pic = "soccer.png";
        }
        else if($rand == 2){
            $profile_pic = "plane.png";
        }
        else if($rand == 3){
            $profile_pic = "dog.png";
        }

        $user_reg_date=date("Y/m/d");
        $recovery_account="...";

        $facolta=$_POST["u_facolta"];

        $check_email= "select email from prova where email='$email'";
        $stmt = $con->prepare($check_email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($coso);
        $stmt->fetch();
        echo "<script>alert('Benvenuto $coso!, cerca i tuoi amici.')</script>";

        if($coso == $email){
            echo "<script>alert('Email già esistente, perfavore prova con un altra email')</script>";
            echo "<script>window.open('iscriviti.php', '_self')</script>";
            exit();
        }

        $grado = "Studente";

        $insert = "INSERT INTO prova (nome,cognome,user_name,pass,email,paese,sesso,compleanno,u_status,u_posts,descrizione,relazioni,user_cover,user_image,user_reg_date,recovery_account,facolta,grado) VALUES ('$nome','$cognome','$username','$pass','$email','$paese','$sesso','$compleanno','$status','$posts','$descrizione','$relazioni','$user_cover','$profile_pic','$user_reg_date','$recovery_account','$facolta','$grado')";

        $stmt = $con->prepare($insert);
        $stmt->execute();
        $stmt->close();
        $con->close();

        if($stmt){
            echo "<script>alert('Benvenuto $nome!, cerca i tuoi amici.')</script>";
            echo "<script>window.open('accedi.php', '_self')</script>";

        }
        else{
            echo "<script>alert('Registrazione fallita, perfavore riprova!')</script>";
            echo "<script>window.open('iscriviti.php', '_self')</script>";
        }

?>