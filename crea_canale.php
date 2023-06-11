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
    <?php
    $user = $_SESSION['user_email'];
    $get_user = "select * from professori where email='$user'";
    $run_user = mysqli_query($con,$get_user);
    $row = mysqli_fetch_array($run_user);
    $id_prof = $row['id_prof'];
    $nome = $row['nome'];
    $cognome = $row['cognome'];
    $corso = $row['corso'];
    $email = $row['email'];

    ?>
    <title><?php echo $nome, $cognome ; ?></title>
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
                    <td colspan="6" class="active"><h2>Creazione Canale</h2></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Inserisci Nome Canale</td>
                    <td>
                        <input class="form-control" type="text" name="nome" required>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Inserisci Titolo Canale</td>
                    <td>
                        <input class="form-control" type="text" name="titolo" required>
                    </td>
                </tr>

                <tr align="center">
                    <td colspan="6">
                        <input type="submit" class="btn btn-info" name="update" style="width: 250px;" value="Crea">
                    </td>
                </tr>
            </table>

        </form>
    </div>




</body>
</html>


<?php
if (isset($_POST['update'])){
    $nome = htmlentities($_POST['nome']);
    $titolo = htmlentities($_POST['titolo']);
    $data = date("Y/m/d");

    $insert = "INSERT INTO canali (nome, id_prof, data, titolo) VALUES ('$nome', '$id_prof', '$data', '$titolo')";
    $run = mysqli_query($con, $insert);
    if ($run){
        echo "<script>alert('Creazione nuovo Canale..')</script>";
        echo "<script>window.open('gestore_canali.php','_self')</script>";
    }
}

?>