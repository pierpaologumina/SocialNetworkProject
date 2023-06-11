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
<title>
    Modifica Post
</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>
<div class="row">
    <div class="col-sm-3">

    </div>
    <div class="col-sm-6">
        <?php
            if (isset($_GET['post_id'])){
                $get_id = $_GET['post_id'];

                $con = new mysqli("localhost", "pier","","social_network");
                $gg = "SELECT post_content FROM posts WHERE post_id='$get_id'";


                $stmt = $con->prepare($gg);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($contenuto);
                $stmt->fetch();


            }

        ?>

        <form action="" method="post" id="f">
            <div style="text-align: center;"><h2>Modifica il tuo Post: </h2></div><br>
            <textarea class="form-control" cols="83" rows="4" name="content"><?php echo $contenuto; ?></textarea><br>
            <input type="submit" name="update" value="Update Post" class="btn btn-info"/>
        </form>
    </div>


    <?php
            if (isset($_POST['update'])){
                $content = $_POST['content'];

                $update_post = "UPDATE posts SET post_content='$content' WHERE post_id='$get_id'";
                $run_update = mysqli_query($con, $update_post);

                if ($run_update){
                    echo "<script>alert('Post modificato correttamente!')</script>";
                    echo "<script>window.open('../home.php', '_self')</script>";

                }
            }

        ?>


    <div class="col-sm-3">


    </div>
</div>

</body>
</html>

