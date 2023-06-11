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
    $get_prof= "select * from professori where email='$user'";
    $run_prof = mysqli_query($con,$get_prof);
    $row_post = mysqli_fetch_array($run_prof);
    $id_prof= $row_post['id_prof'];
    $nome = $row_post['nome'];
    $cognome = $row_post['cognome'];

    $id_post= $_GET['post_id'];

    $get_post = "SELECT * FROM post_canali WHERE id_post='$id_post'";

    $run_post = mysqli_query($con,$get_post);
    $row_post = mysqli_fetch_array($run_post);
    $titolo= $row_post['titolo'];
    $contenuto= $row_post['contenuto'];


    ?>
    <title><?php echo $nome, $cognome; ?></title>
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
                    <td colspan="6" class="active"><h2>Modifica Post Canale</h2></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Cambia il Titolo del post</td>
                    <td>
                        <input class="form-control" type="text" name="titolo" required value="<?php echo $titolo;  ?>">
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Modifica il contenuto del post</td>
                    <td>
                        <input class="form-control" type="text" name="contenuto" required value="<?php echo $contenuto;  ?>">
                    </td>
                </tr>

                <tr align="center">
                    <td colspan="6">
                        <input type="submit" class="btn btn-info" name="update" style="width: 250px;" value="Conferma">
                    </td>
                </tr>
            </table>

        </form>
    </div>




</body>
</html>


<?php
if (isset($_POST['update'])){
    $titolo_m = htmlentities($_POST['titolo']);
    $contenuto_m = htmlentities($_POST['contenuto']);



    $update = "UPDATE post_canali SET titolo='$titolo_m', contenuto='$contenuto_m' WHERE id_post='$id_post'";
    $run = mysqli_query($con, $update);
    if ($run){
        echo "<script>alert('Aggiorno le nuove informazioni..')</script>";
        echo "<script>window.open('gestore_canali.php','_self')</script>";
    }
}

?>