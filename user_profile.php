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
    <title>Cerca</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<style>
    #own_posts{
        border: 5px solid #e6e6e6;
        padding: 40px 50px;
        width: 90%;
    }

    #posts_img{
        height: 300px;
        width: 100%;
    }


</style>

<body>
<div class="row">
    <?php
        if (isset($_GET['u_id'])){
            $u_id = $_GET['u_id'];
        }

        if($u_id < 0 || $u_id == ""){
            echo "<script>window.open('home.php', '_self')</script>";

        }else{

    ?>

    <div class="col-sm-12">
        <?php
        if (isset($_GET['u_id'])) {
            global $con;

            $user_id = $get['u_id'];

            $select = "SELECT * FROM prova WHERE id_utente='$user_id'";
            $run = mysqli_query($con, $select);
            $row = mysqli_fetch_array($run);

            $name = $row['user_name'];
        }
        ?>

        <?php
        if (isset($_GET['u_id'])) {
            global $con;

            $user_id = $_GET['u_id'];

            $select = "SELECT * FROM prova WHERE id_utente='$user_id'";
            $run = mysqli_query($con, $select);
            $row = mysqli_fetch_array($run);


            $id = $row['id_utente'];
            $image = $row['user_image'];
            $u_name = $row['user_name'];
            $nome = $row['nome'];
            $cognome = $row['cognome'];
            $describe_user = $row['descrizione'];
            $paese = $row['paese'];
            $sesso = $row['sesso'];
            $register_date = $row['user_reg_date'];

            $user = $_SESSION['user_email'];
            $get_user = "SELECT * FROM prova WHERE email='$user'";
            $run_user = mysqli_query($con, $get_user);

            $row = mysqli_fetch_array($run_user);

            $userown_id = $row['id_utente'];


            if ($id == $userown_id) {
                $e= "<a href='edit_profile.php?u_id=$userown_id' class='btn btn-success' />Modifica il Tuo Profilo</a><br><br><br>";

            }


            echo "
                    <div class='row'>
                        <div class='col-sm-1'>
                        </div>
                        <center>
                        <div style='background-color: #e6e6e6'; class='col-sm-3'>
                        <h2>Informazioni riguardo</h2>
                        <img class='img-circle' src='utenti/$image' width='150' height='150'>
                        <br><br>
                        <ul class='list-group'>
                            <li class='list-group-item' title='Username'><strong>$nome $cognome</strong></li>
                            
                            <li class='list-group-item' title='User Status'><strong style='color: gray;'>$describe_user</strong></li>
                            
                            <li class='list-group-item' title='Gender'><strong>$sesso</strong></li>
                            
                            <li class='list-group-item' title='Country'><strong>$paese</strong></li>
                            
                            <li class='list-group-item' title='User Registration Date'><strong>$register_date</strong></li>
                             <br> $e
                        </ul>
                         </div>
                    </center>
     
                
                ";




        }
        ?>
        <div class="col-sm-8">
            <center><h1><strong><?php echo "$nome $cognome"; ?></strong> Posts</h1></center>
            <?php
                global $con;
                if (isset($_GET['u_id'])){
                    $u_id = $_GET['u_id'];
                }
                $get_posts = "SELECT * FROM posts WHERE user_id='$u_id' ORDER BY 1 DESC LIMIT 5";

                 $run_posts = mysqli_query($con, $get_posts);


                 while($row_posts = mysqli_fetch_array($run_posts)) {
                     $post_id = $row_posts['post_id'];
                     $user_id = $row_posts['user_id'];
                     $content = $row_posts['post_content'];
                     $upload_image = $row_posts['upload_img'];
                     $post_date = $row_posts['post_date'];


                     $user = "SELECT * FROM prova WHERE id_utente='$user_id' AND u_posts='YES'";

                     $run_user = mysqli_query($con, $user);
                     $row_user = mysqli_fetch_array($run_user);

                     $user_name = $row_user['user_name'];
                     $nome = $row_user['nome'];
                     $cognome = $row_user['cognome'];
                     $user_image = $row_user['user_image'];

                     if ($content == "No" && strlen($upload_image) >= 1) {
                         echo "
                            <div id='own_posts'>
                                <div class='row'>
                                    <div class='col-sm-2'>
                                        <p><img src='utenti/$user_image' class='img-circle' width='100px' height='100px'></p>
                                    </div>
                                    <div class='col-sm-6'>
                                        <h3><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
                                        <h4><small style='color: black;'>Pubblicato il <strong>$post_date</strong></small></h4>
                                    </div>
                                    <div class='col-sm-4'>
                                        
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-sm-12'>
                                        <img id='posts-img' src='imgpost/$upload_image' style='height: 350px'>
                                    </div>
                                </div><br>
                                <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>Visualizza</button></a>
                                <a href='funzioni/delete_post.php?post_id=$post_id' style='float: right;'><button class='btn btn-danger'>Cancella</button></a>
                            
                            </div><br><br>
                        
                        
                        
                        ";

                     } else if (strlen($content) >= 1 && strlen($upload_image) >= 1) {
                         echo "
                            <div id='own_posts'>
                                <div class='row'>
                                    <div class='col-sm-2'>
                                        <p><img src='utenti/$user_image' class='img-circle' width='100px' height='100px'></p>
                                    
                                    </div>
                                        <div class='col-sm-6'>
                                            <h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='profile.php?u_id=$user_id'>$user_name</a></h3>
							                <h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
                                    
                                        </div>
                                        <div class='col-sm-4'>
                                        </div>                                
                                </div>
                                <div class='row'>
                                    <div class='col-sm-12'>
                                        <h3><p>$content</p></h3>
							<img id='posts-img' src='imgpost/$upload_image' style='height:350px;'>
                                    </div>
                                    
                                </div><br>
                                <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>Visualizza</button></a>
                                <a href='funzioni/delete_post.php?post_id=$post_id' style='float: right;'><button class='btn btn-danger'>Cancella</button></a>
                            
                            </div><br><br>
                        
                        
                        
                        ";


                     } else {
                         echo "
                            <div id='own_posts'>
                                <div class='row'>
                                    <div class='col-sm-2'>
                                        <p><img src='utenti/$user_image' class='img-circle' width='100px' height='100px'></p>
                                    
                                    </div>
                                        <div class='col-sm-6'>
                                            <h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='profile.php?u_id=$user_id'>$user_name</a></h3>
							                <h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
                                    
                                        </div>
                                        <div class='col-sm-4'>
                                        </div>                                
                                </div>
                                <div class='row'>
                                   
                                    <div class='col-sm-12'>
                                        <h3><p>$content</p></h3>
                                    </div>
                                    </div><br>   
                                    <a href='single.php?post_id=$post_id' style='float: right;'><button class='btn btn-info'>Commenta</button></a><br>                     
                            </div><br><br>
                        
                        
                        
                        ";

                     }

                 }



            ?>
        </div>

    </div>
</div>

<?php
}
?>

</body>
</html>