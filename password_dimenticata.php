<!DOCTYPE>
<html>
<head>
    <title>Password Dimenticata</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
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
        border: 8px solid #000;
        margin-bottom: 5px;
    }

    .well{
        background-color: #187FAB;
    }

    #signup{
        width: 60%;
        border-radius: 30px;
    }

</style>

<body>
<div class="row">
    <div class="col-sm-12">
        <div class="well">
            <center><h1 style="color: white;"><strong>The Great Social Network</strong></h1></center>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="main-content">
            <div class="header">
                <h3 style="text-align: center;"><strong>Password Dimenticata.</strong></h3><hr>
            </div>
            <div class="l_pass">
                <form action="" method="post">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="email" type="email" class="form-control" name="email" placeholder="Inserisci la tua Email" required>
                    </div><br>
                    <hr>
                    <pre class="text">Inserisci il nome del tuo migliore amico.</pre>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <input id="msg" type="text" class="form-control" placeholder="Scrivi qualcosa" name="recovery_account" required>
                    </div><br>
                    <a style="text-decoration: none; float: right; color: #187FAB;" data-toggle="tooltip" title="Accedi" href="accedi.php">Torna indietro al Login</a><br>
                    <center><button id="signup" class="btn btn-info btn-lg" name="submit">Invia</button></center>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
session_start();

include("includes/connection.php");

if(isset($_POST['submit'])) {
    $email = htmlentities($_POST['email']);
    $recovery_account = htmlentities($_POST['recovery_account']);

    $select_user = "SELECT * FROM prova WHERE email='$email' AND recovery_account='$recovery_account'";

    $query = mysqli_query($con, $select_user);
    $check_user = mysqli_num_rows($query);

    if ($check_user == 1) {
        $_SESSION['user_email'] = $email;
        echo "<script>window.open('change_password.php', '_self')</script>";
    } else {
        echo "<script>alert('Email o Nome migliore amico errati. Perfavore riprova!')</script>";


    }

}