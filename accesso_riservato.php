<!DOCTYPE html>
<html>
<head>
    <title>Accesso Riservato</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

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
        background-color: #da971d;
    }
    #accedi{
        width: 60%;
        border-radius: 30px;
    }

    .overlap-text{
        position: relative;

    }

    .overlap-text a{
        position: absolute;
        top: 8px;
        right: 10px;
        font-size: 14px;
        text-decoration: none;
        font-family: 'Overpass Mono', monospace;
        letter-spacing: -1px;

    }

</style>

<div class="row">
    <div class="col-sm-12">
        <div class="well">
            <center><h1 style="color: white">THE GREAT SOCIAL NETWORK</h1></center>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="main-content">
            <div class="header">
                <h3 style="text-align: center;"><strong>Accesso Admin e Professori</strong></h3>
            </div>
            <div class="l-part">
                <form action="acceduto_riservato.php" method="post">
                    <input type="email" name="email" placeholder="Inserisci la tua Email" required="required" class="form-control input-md"><br>
                    <div class="overlap-text">
                        <input type="password" name="password" placeholder="Password" required="required" class="form-control input-md"><br>
                        <a style="text-decoration: none; float: right; color: #da971d;" data-toggle="tooltip" title="Reset Password" href="password_dimenticata.php">Password dimenticata?</a>
                    </div>
                    <input type="checkbox" name="amministratore" value="Admin"> Spunta se sei un Amministratore<br>
                    <a style="text-decoration: none; float: left; color: #187FAB;" data-toggle="tooltip" title="Accesso Riservato" href="accedi.php">Accesso Studenti. Torna </a><br><br>
                    <center><button id="accedi" class="btn btn-warning btn-lg" name="accedi" type="submit">Accedi</button></center>

                </form>
            </div>
        </div>


    </div>



</div>


</body>
</html>