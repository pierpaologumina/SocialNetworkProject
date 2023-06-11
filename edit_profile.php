<!DOCTYPE>
<?php
session_start();
include("includes/header.php");

if (!isset($_SESSION['user_email'])){
    header("location: index.php");
}


?>
<html>
<head>
    <title>Modifica Impostazioni Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>


<body>
<div class="row">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8">
        <form action="" method="post" enctype="multipart/form-data">
            <table class="table table-bordered table-hover">
                <tr align="center">
                    <td colspan="6" class="active"><h2>Modifica il tuo Profilo</h2></td>
                </tr>
                <tr>
                   <td style="font-weight: bold;">Cambia il tuo Nome</td>
                    <td>
                        <input class="form-control" type="text" name="nome" required value="<?php echo $nome; ?>">
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Cambia il tuo Cognome</td>
                    <td>
                        <input class="form-control" type="text" name="cognome" required value="<?php echo $cognome; ?>">
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Cambia il tuo User-Name</td>
                    <td>
                        <input class="form-control" type="text" name="u_name" required value="<?php echo $user_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Descrizione</td>
                    <td>
                        <input class="form-control" type="text" name="describe_user" required value="<?php echo $descrizione; ?>">
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Stato Relazioni</td>
                    <td>
                        <select class="form-control" name="relazioni">
                            <option><?php echo $relazioni; ?></option>
                            <option>Impegnato/a</option>
                            <option>Sposato/a</option>
                            <option>Single</option>
                            <option>Relazione Complicata</option>
                            <option>Separato/a</option>
                            <option>Divorziato/a</option>
                            <option>Vedovo/a</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Password</td>
                    <td>
                        <input class="form-control" type="password" name="u_password" id="mypass" required value="<?php echo $pass; ?>">
                        <input type="checkbox" onclick="show_password()"><strong>Mostra Password</strong>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Email</td>
                    <td>
                        <input class="form-control" type="email" name="u_email" required value="<?php echo $email; ?>">
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Paese</td>
                    <td>
                        <select class="form-control" name="u_paese">
                            <option><?php echo $paese; ?></option>
                            <option>USA</option>
                            <option>Europa</option>
                            <option>Asia</option>
                            <option>Africa</option>
                            <option>Oceania</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Sesso</td>
                    <td>
                        <select class="form-control" name="u_sesso">
                            <option><?php echo $sesso; ?></option>
                            <option>Maschio</option>
                            <option>Femmina</option>
                            <option>Altro</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Compleanno</td>
                    <td>
                        <input class="form-control" type="date" name="u_compleanno" required value="<?php echo $compleanno; ?>">
                    </td>
                </tr>

                <tr>
                    <td style="font-weight: bold;">Password Dimenticata</td>
                    <td>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Attiva</button>

                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Modal Header</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="recovery.php?id=<?php echo $id_utente; ?>" method="post" id="f">
                                            <strong>Domanda 1 </strong>
                                            <textarea class="form-control" cols="83" rows="4" name="content" placeholder="Qualcuno"></textarea><br>
                                            <input class="btn btn-default" type="submit" name="sub" value="Submit" style="width: 100px;"><br><br>
                                            <pre>Scrivi una domanda alla quale dovrai rispondere se vovessi dimenticarti la <br>password.</pre>
                                            <br><br>
                                        </form>
                                        <?php
                                            if(isset($_POST['sub'])){
                                                $bfn = htmlentities($_POST['content']);

                                                if ($bfn == ''){
                                                    echo "<script>alert('Perfavore compila correttamente i campi.')</script>";
                                                    echo "<script>window.open('edit_profile.php?u_id=$id_utente','_self')</script>";
                                                    exit();
                                                }else{
                                                    $update = "UPDATE prova SET recovery_account='$bfn' WHERE id_utente='$id_utente'";

                                                    $run = mysqli_query($con, $update);
                                                    if ($run){
                                                        echo "<script>alert('Eseguendo..')</script>";
                                                        echo "<script>window.open('edit_profile.php?u_id=$id_utente','_self')</script>";
                                                    }else{
                                                        echo "<script>alert('Errore durante il caricamento. Riprova perfavore!')</script>";
                                                        echo "<script>window.open('edit_profile.php?u_id=$id_utente','_self')</script>";
                                                    }
                                                }
                                            }

                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr align="center">
                    <td colspan="6">
                        <input type="submit" class="btn btn-info" name="update" style="width: 250px;" value="Update">
                    </td>
                </tr>
            </table>

        </form>
    </div>
    <div class="col-sm-2">


    </div>
</div>
</body>
</html>
<?php
    if (isset($_POST['update'])){
        $nome = htmlentities($_POST['nome']);
        $cognome = htmlentities($_POST['cognome']);
        $u_name = htmlentities($_POST['u_name']);
        $descrizione = htmlentities($_POST['describe_user']);
        $relazioni = htmlentities($_POST['relazioni']);
        $u_pass = htmlentities($_POST['u_password']);
        $u_email = htmlentities($_POST['u_email']);
        $u_paese = htmlentities($_POST['u_paese']);
        $u_sesso = htmlentities($_POST['u_sesso']);
        $u_compleanno = htmlentities($_POST['u_compleanno']);

        $update = "UPDATE prova SET nome='$nome', cognome='$cognome', user_name='$u_name', pass='$u_pass', email='$u_email', paese='$u_paese', sesso='$u_sesso', compleanno='$u_compleanno', descrizione='$descrizione', relazioni='$relazioni' WHERE id_utente='$id_utente'";
        $run = mysqli_query($con, $update);
        if ($run){
            echo "<script>alert('Aggiornando il tuo Profilo..')</script>";
            echo "<script>window.open('edit_profile.php?u_id=$id_utente','_self')</script>";
        }
    }

?>