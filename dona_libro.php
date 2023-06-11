<!DOCTYPE html>
<html>

<!--INIZIO PARTE RELATIVA AL BOOTSTRAP -->
<head>
    <title>♥ Dona Libro ♥</title>
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
            <center><h1 style="color: white">♥ Dona Libro ♥</h1>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="main-content">
            <div class="header">

                <h3 style="text-align: center;"><strong>Inserisci le informazioni del libro</strong></h3>
            </div>
            <br>
            <div class="l-part">
                <form action="donazione_libro.php?idd=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">book</i></span>
                        <input type="text" class="form-control" placeholder="Nome Libro" name="nome" required="required">
                    </div><br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">book</i></span>
                        <input type="text" class="form-control" placeholder="Autore" name="autore" required="required">
                    </div><br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">add_a_photo</i></span>
                        <input type="file" accept="image/*" value="Send File" name="foto" required="required">
                    </div><br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">place</i></span>
                        <input type="text" class="form-control" placeholder="Luogo" name="luogo" required="required">
                    </div><br>

                    <center><button id="inserisci" class="btn btn-info btn-lg" name="inserisci_libro" type="submit">Metti in Giro</button></center>

                </form>

            </div>
        </div>
    </div>
</div>
</body>
</html>

