<?php
session_start();

include("includes/connection.php");

if ($con->connect_errno){
    echo "<script>alert('ERRORE NELLA CONNESSIONE COL DB. Riprova piu tardi o contatta il tecnico')</script>";
    echo "<script>window.open('accedi.php', '_self')</script>";
    exit();
}

$email=$_POST["email"];
$pass=$_POST["password"];
$admin=$_POST["amministratore"];

if($admin=="Admin"){
    $query= "SELECT * FROM amministratori WHERE email='$email' AND password='$pass'";
    $run_query = mysqli_query($con, $query);
    $row_query = mysqli_fetch_array($run_query);
    $email_query = $row_query['email'];
    if($email_query == $email){
        $_SESSION['user_email'] = $email;
        echo "<script>window.open('home_admin.php', '_self')</script>";
    }else{
        echo "<script>alert('Email o Password errati. Perfavore riprova!')</script>";
        echo "<script>window.open('accesso_riservato.php', '_self')</script>";
        exit();
    }
}else{
    $query= "SELECT * FROM professori WHERE email='$email' AND password='$pass'";
    $run_query = mysqli_query($con, $query);
    $row_query = mysqli_fetch_array($run_query);
    $email_query = $row_query['email'];
    if($email_query == $email){
        $_SESSION['user_email'] = $email;
        echo "<script>window.open('gestore_canali.php', '_self')</script>";
    }else{
        echo "<script>alert('Email o Password errati. Perfavore riprova!')</script>";
        echo "<script>window.open('accesso_riservato.php', '_self')</script>";
        exit();
    }
}