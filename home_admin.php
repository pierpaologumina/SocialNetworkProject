<!DOCTYPE>
<?php
session_start();
include("funzioni/functions.php");
if (!isset($_SESSION['user_email'])){
    header("location: index.php");
}


?>
<html>
<head>
    <style>
        div.sticky {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            padding: 10px 25px;


        }
    </style>

    <title>Home Amministratore</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>

<div class="row">

    <div class="sticky">
        <a href='logout.php'><button class='btn btn-danger'>Esci</button></a>
    </div>


    <div class="col-sm-12">

        <div class="row">







        </div><br>
        <center><h2>Studenti</h2></center><br>
        <?php mostra_studenti(); ?>
        <center><h2>Professori</h2></center>
        <center><a href='inserisci_prof.php'><button class='btn btn-success'>Registra Professore</button></a></center>
        <?php mostra_professori(); ?>
    </div>

</div>
</body>
</html>