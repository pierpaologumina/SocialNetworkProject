<!DOCTYPE html>
<html>

<!--INIZIO PARTE RELATIVA AL BOOTSTRAP -->
<head>
    <title>ISCRIVITI</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
        <a href='home_admin.php'><button class='btn btn-danger'>Torna. Annulla</button></a>
        <div class="main-content">
            <div class="header">
                <h3 style="text-align: center;"><strong>Registra Professore</strong></h3>
            </div><br>
            <div class="l-part">
                <form action="" method="post">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <input type="text" class="form-control" placeholder="Nome" name="nome" required="required">
                    </div><br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <input type="text" class="form-control" placeholder="Cognome" name="cognome" required="required">
                    </div><br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" placeholder="Password" name="u_pass" required="required">
                    </div><br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
                        <select class="form-control input-md" name="u_corso" required="required">
                            <option disabled>Seleziona la tua facoltà</option>
                            <option>Ingegneria</option>
                            <option>Legge</option>
                            <option>Lettere</option>
                        </select>
                    </div><br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="email" class="form-control" placeholder="Email" name="u_email" required="required">
                    </div><br>


                    <center><button class="btn btn-info btn-lg" name="update" type="submit">Registra</button></center>

                </form>

            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
if (isset($_POST['update'])){
    $con = new mysqli("localhost", "pier","","social_network");
    $nome = htmlentities($_POST['nome']);
    $cognome = htmlentities($_POST['cognome']);
    $password = htmlentities($_POST['u_pass']);
    $corso = htmlentities($_POST['u_corso']);
    $email = htmlentities($_POST['u_email']);

    $data=date("Y/m/d");

    $insert = "INSERT INTO professori (nome,cognome,password,corso,data,email) VALUES ('$nome','$cognome','$password','$corso','$data','$email')";

    $run_insert = mysqli_query($con,$insert);

    if($run_insert){
        echo "<script>alert('Professore Registrato Correttamente!')</script>";
        echo "<script>window.open('home_admin.php', '_self')</script>";

    }
}

?>