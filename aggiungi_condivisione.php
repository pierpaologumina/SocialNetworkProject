<!DOCTYPE html>
<html>

<!--INIZIO PARTE RELATIVA AL BOOTSTRAP -->
<head>
    <title>Condivisione Appunti</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
</head>
<!--FINE PARTE RELATIVA AL BOOTSTRAP -->

<style>
    body{
        overflow-x: hidden;
    }
    .main-content{
        width: 50%;
        height: 40%;
        margin: 10px auto;
        background-color: #fff;
        border: 2px solid #e6e6e6;
        padding: 40px 50px;
    }
    .header{
        border: 0px solid #000;
        margin-bottom: 5px;
    }
    .well{
        background-color: #187FAB;
    }

    #iscriviti{
        width: 60%;
        border-radius: 30px;
    }



</style>
<body>
<div class="row">
    <div class="col-sm-12">
        <div class="well">
            <center><h1 style="color: white">Condividi Appunti</h1>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="main-content">
            <div class="header">

                <h3 style="text-align: center;"><strong>Inserisci le informazioni necessarie</strong></h3>
            </div>
            <br>
            <div class="l-part">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">link</i></span>
                        <input type="text" class="form-control" placeholder="Link" name="link" required="required">
                    </div><br>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">library_books</i></span>
                        <input type="text" class="form-control" placeholder="Materia" name="materia" required="required">
                    </div><br>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">school</i></span>
                        <input type="text" class="form-control" placeholder="Corso" name="corso" required="required">
                    </div><br>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">format_color_text</i></span>
                        <input type="text" class="form-control" placeholder="Descrizione" name="descrizione" required="required">
                    </div><br>


                    <center><button id="inserisci" class="btn btn-info btn-lg" name="condividi_appunti" type="submit">Condividi Appunti</button></center>

                </form>

            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
if (isset($_POST['condividi_appunti'])){

    $con = new mysqli("localhost", "pier","","social_network");

    $link = htmlentities($_POST['link']);
    $materia = htmlentities($_POST['materia']);
    $corso = htmlentities($_POST['corso']);
    $descrizione = htmlentities($_POST['descrizione']);
    $data=date("Y/m/d");

    $id_utente = $_GET['id'];

    $insert = "INSERT INTO appunti (caricato_da,caricato_il,link,materia,corso,descrizione) VALUES ('$id_utente','$data','$link','$materia','$corso','$descrizione')";
    $run_insert = mysqli_query($con,$insert);

    if($run_insert){
        echo "<script>alert('Appunti aggiunti correttamente!')</script>";
        echo "<script>window.open('condivisione_appunti.php?u_id=$id_utente', '_self')</script>";

    }

}

?>