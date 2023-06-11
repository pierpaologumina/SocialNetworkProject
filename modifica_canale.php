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
    $get_user = "select * from prova where email='$user'";
    $run_user = mysqli_query($con,$get_user);
    $row = mysqli_fetch_array($run_user);
    $id_utente = $row['id_utente'];
    $user_name = $row['user_name'];

    $id_canale= $_GET['id_canale'];

    $get_canale = "SELECT * FROM canali WHERE id_canale='$id_canale'";

    $run_canale = mysqli_query($con,$get_canale);
    $row_canale = mysqli_fetch_array($run_canale);
    $nome= $row_canale['nome'];
    $titolo= $row_canale['titolo'];


    ?>
    <title><?php echo $user_name; ?></title>
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
                    <td colspan="6" class="active"><h2>Modifica Canale</h2></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Cambia il Nome</td>
                    <td>
                        <input class="form-control" type="text" name="nome" required value="<?php echo $nome; ?>">
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Modifica il titolo</td>
                    <td>
                        <input class="form-control" type="text" name="titolo" required value="<?php echo $titolo; ?>">
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




</body>
</html>


<?php
if (isset($_POST['update'])){
    $nome = htmlentities($_POST['nome']);
    $titolo = htmlentities($_POST['titolo']);

    $update = "UPDATE canali SET nome='$nome', titolo='$titolo' WHERE id_canale='$id_canale'";
    $run = mysqli_query($con, $update);
    if ($run){
        echo "<script>alert('Aggiorno le nuove informazioni..')</script>";
        echo "<script>window.open('gestore_canali.php','_self')</script>";
    }
}

?>