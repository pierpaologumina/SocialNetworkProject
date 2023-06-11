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
        <div class="well">
            <center><h1 style="color: white">THE GREAT SOCIAL NETWORK</h1></center>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="main-content">
            <div class="header">
                <h3 style="text-align: center;"><strong>Unisciti a THE GREAT SOCIAL</strong></h3>
            </div>
            <div class="l-part">
                <form action="inserisci_utente.php" method="post">
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
                        <input id="password" type="password" class="form-control" placeholder="Password" name="u_pass" required="required">
                    </div><br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="email" type="email" class="form-control" placeholder="Email" name="u_email" required="required">
                    </div><br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
                        <select class="form-control" name="u_country" required="required">
                            <option disabled>Seleziona il tuo Paese</option>
                            <option>Italia</option>
                            <option>USA</option>
                            <option>French</option>
                            <option>Germany</option>
                            <option>Spain</option>
                            <option>Uk</option>
                            <option>Altri (Europa)</option>
                            <option>Altri (America)</option>
                            <option>Altri (Asia)</option>
                        </select>
                    </div><br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
                        <select class="form-control input-md" name="u_gender" required="required">
                            <option disabled>Seleziona il tuo Sesso</option>
                            <option>Maschio</option>
                            <option>Femmina</option>
                            <option>Altro</option>
                        </select>
                    </div><br>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
                        <select class="form-control input-md" name="u_facolta" required="required">
                            <option disabled>Seleziona la tua facoltà</option>
                            <option>Ingegneria</option>
                            <option>Legge</option>
                            <option>Lettere</option>
                        </select>
                    </div><br>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input type="date" class="form-control input-md" placeholder="Email" name="u_birthday" required="required">
                    </div><br>
                    <a style="text-decoration: none; float: right; color: #187FAB;" data-toggle="tooltip" title="Signin" href="accedi.php">Hai già un account?</a><br><br>
                    <center><button id="iscriviti" class="btn btn-info btn-lg" name="sign_up" type="submit">Iscriviti</button></center>

                </form>

            </div>
        </div>
    </div>
</div>
</body>
</html>

