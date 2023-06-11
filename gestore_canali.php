<!DOCTYPE>
<?php
session_start();
include("includes/header.php");

if (!isset($_SESSION['user_email'])){
    header("location: index.php");
}

$user = $_SESSION['user_email'];
$get_user = "select * from professori where email='$user'";
$run_user = mysqli_query($con,$get_user);
$row = mysqli_fetch_array($run_user);
$id_prof = $row['id_prof'];
$nome = $row['nome'];
$cognome = $row['cognome'];
$corso = $row['corso'];
$email = $row['email'];

$id_canale = $_GET['id_canale'];

if($id_prof!=""){
    $a = "<a href='crea_canale.php'><button class='btn btn-success'>Crea Canale</button></a>";

}else{
    $b = " di $facolta";

}


?>
<html>
<head>
    <title>Cerca</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>
<body>
<div class="row">
    <?php echo mostra_feed(); ?>
</div>
<br>
<div class="row">
    <div class="col-sm-12">

            <center><h2>I Tuoi Canali<?php echo $b; ?></h2><?php echo $a; ?></center><br><br>
        <center></center>

        <?php mostra_canali(); ?>
    </div>

</div>
</body>
</html>