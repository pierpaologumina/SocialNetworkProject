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
    <?php echo mostra_feed(); ?>
    <div id="insert_post" class="col-sm-12">
        <div style="text-align: center;">
            <form action="home.php?id=<?php echo $id_utente; ?>" method="post" id="f" enctype="multipart/form-data">
            <textarea class="pb-cmnt-textarea" id="content" rows="4" name="content" placeholder="A cosa stai pensando?"></textarea><br>
            <label class="btn btn-warning" id="upload_image_button">Sel. img
                <input type="file" name="upload_image" size="30">
            </label>
                <button id="btn-post" class="btn btn-success" name="sub">Condividi</button>
            </form>
            <?php insertPost(); ?>
        </div>

    </div>

</div>



<div class="row">

    <div class="col-sm-12">

        <center><h2><strong>Nuovi Feed</strong></h2><br></center>
        <?php echo get_posts(); ?>

    </div>


</div>

</body>
</html>