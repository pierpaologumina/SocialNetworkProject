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
    /*
    $user = $_SESSION['email'];
    $get_user = "SELECT * FROM prova WHERE email='$user'";
    $stmt = $con->prepare($get_user);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id_utente,$nome, $cognome,$user_name,$pass,$email,$paese,$sesso,$compleanno,$u_status,$u_posts,$descrizione,$relazioni,$user_cover,$user_image,$user_reg_date,$recovery_account);
    $stmt->fetch();

    $user_posts = "SELECT * FROM prova WHERE id_utente='$id_utente'";
    $stmt = $con->prepare($user_posts);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id_utente,$nome, $cognome,$user_name,$pass,$email,$paese,$sesso,$compleanno,$u_status,$u_posts,$descrizione,$relazioni,$user_cover,$user_image,$user_reg_date,$recovery_account);
    $stmt->fetch();
    */
    ?>
    <title><?php echo $nome ; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>

<style>
    #cover-img{
        height: 400px;
        width: 100%;
    }
    #profile-img{
        position: absolute;
        top: 160px;
        left: 40px;
    }
    #update_profile{
        position: relative;
        top: -33px;
        cursor: pointer;
        left: 93px;
        border-radius: 4px;
        background-color: rgba(0,0,0,0.1);
        transform: translate(-50%, -50%);
    }
    #button_profile{
        position: absolute;
        top: 82%;
        left: 50%;
        cursor: pointer;
        transform: translate(-50%, -50%);
    }

    #own_posts{
        border: 5px solid #e6e6e6;
        padding: 40px 50px;


    }
    #post_img{
        height: 300px;
        width: 100%;
    }


</style>

<body>
    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
            <?php
                if($grado!=""){
                echo "
                    <div>
                        <div><img id='cover-img' class='img-rounded' src='cover/$user_cover' alt='cover'></div>
                            <form action='profile.php?u_id=$id_utente' method='post' enctype='multipart/form-data'>
                               <ul class='nav pull-left' style='position: absolute; top: 10px; left: 40px;'>
                                <li class='dropdown'>
                                    <button class='dropdown-toggle btn btn-default' data-toggle='dropdown'>Cambia immagine di copertina</button>
                                    <div class='dropdown-menu'>
                                        <center>
                                            <p>Click <strong>Selezione immagine di copertina</strong> e premi su <br><strong>Carica Copertina</strong></p>
                                            <label class='btn btn-info'>Seleziona img di copertina
                                            <input type='file' name='u_cover' size='60'>
                                            </label><br><br>
                                            <button name='submit' class='btn btn-info'>Carica Copertina</button>
                                        </center>
                                    
                                    </div>
                                
                                </li>
                               
                               </ul>
                        
                            </form>
                            
                        
                    </div>
                
                    <div id='profile-img'>
                        <img src='utenti/$user_image' alt='Profile' class='img-circle' width='180px' height='185px'>
                        <form action='profile.php?u_id='$id_utente' method='post' enctype='multipart/form-data'>
                        
                        <label id='update_profile'>Seleziona immagine di Profilo
                        <input type='file' name='u_image' size='60' />
                        </label><br><br>
                        <button id='button_profile' name='update' class='btn btn-info'>Carica immagine</button>
                                          
                        
                        </form>
                    </div><br>           
                ";

            ?>

            <?php
                if(isset($_POST['submit'])){
                    $u_cover=$_FILES['u_cover']['name'];
                    $image_tmp = $_FILES['u_cover']['tmp_name'];
                    $random_number=rand(1,100);
                    echo "<script>alert('Benvenuto $u_cover!, cerca i tuoi amici.')</script>";

                    if($u_cover==''){
                        echo "<script>alert('Perfavore seleziona una immagine per la copertina')</script>";
                        echo "<script>window.open('profile.php?u_id=$id_utente' , '_self')</script>";
                        exit();
                        }else{
                            move_uploaded_file($image_tmp,"cover/$u_cover.$random_number");
                            $update="UPDATE prova SET user_cover='$u_cover.$random_number' WHERE id_utente='$id_utente'";
                            $stmt = $con->prepare($update);
                            $stmt->execute();
                            $stmt->fetch();
                            if($stmt){
                                echo "<script>alert('Copertina inserita correttamente')</script>";
                                echo "<script>window.open('profile.php?u_id=$id_utente' , '_self')</script>";
                            }
                        }
                     }


            ?>

        </div>


        <?php
        if(isset($_POST['update'])){
            $u_image=$_FILES['u_image']['name'];
            $image_tmp = $_FILES['u_image']['tmp_name'];
            $random_number=rand(1,100);

            echo "<script>alert('Benvenuto $u_image!, cerca i tuoi amici.')</script>";
            if($u_image==''){
                echo "<script>alert('Perfavore seleziona una immagine per il profilo')</script>";
                echo "<script>window.open('profile.php?u_id=$id_utente' , '_self')</script>";
                exit();
            }else{
                move_uploaded_file($image_tmp,"utenti/$u_image.$random_number");
                $update="UPDATE prova SET user_image='$u_image.$random_number' WHERE id_utente='$id_utente'";
                $stmt = $con->prepare($update);
                $stmt->execute();
                $stmt->fetch();
                if($stmt){
                    echo "<script>alert('Immagine di profilo inserita correttamente')</script>";
                    echo "<script>window.open('profile.php?u_id=$id_utente' , '_self')</script>";
                }
            }
        }

        ?>

        <div class="col-sm-2">

        </div>
    </div>
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-2" style="background-color: #e6e6e6; text-align: center; left: 0.8%; border-radius: 5px;">
                <?php

                    echo"
                        <center><h2><strong>Riguardo</strong></h2></center>
                        <center><h4><strong>$nome $cognome</strong></h4></center>
                        <p><strong><i style='color: grey;'>$descrizione</i></strong></p><br>
                        <p><strong>Stato Relazioni: </strong> $relazioni</p><br>
                        <p><strong>Paese: </strong> $paese</p><br>                    
                        <p><strong>Registrato il: </strong> $user_reg_date</p><br>
                        <p><strong>Sesso: </strong> $sesso</p><br>
                        <p><strong>Data di nascita: </strong> $compleanno</p><br>
                        
                    ";

                ?>
            </div>

    <div>
        <div class="col-sm-6">
            <?php
                global $con;
                if (isset($_GET['u_id'])){
                    $u_id = $_GET['u_id'];

                }
                $get_posts ="SELECT * FROM posts WHERE user_id='$u_id' ORDER BY 1 DESC LIMIT 5";

                $run_posts = mysqli_query($con, $get_posts);

                while ($row_post = mysqli_fetch_array($run_posts)){
                    $post_id = $row_post['post_id'];
                    $user_id = $row_post['user_id'];
                    $content = $row_post['post_content'];
                    $upload_image = $row_post['upload_img'];
                    $post_date = $row_post['post_date'];

                    $user = "SELECT * FROM prova WHERE id_utente=$user_id AND u_posts='YES'";

                    $run_user = mysqli_query($con, $user);
                    $row_user = mysqli_fetch_array($run_user);

                    $user_name = $row_user['user_name'];
                    $user_image = $row_user['user_image'];

                    if($content=="No" && strlen($upload_image) >= 1){
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
                                        <img id='posts-img' src='imgpost/$upload_image' style='height:350px;'>
                                    </div>
                                    
                                </div><br>
                                <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>Visualizza</button></a>
                                <a href='funzioni/delete_post.php?post_id=$post_id' style='float: right;'><button class='btn btn-danger'>Cancella</button></a>
                            
                            </div><br><br>
                        
                        
                        
                        ";


                    }
                    else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
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


                    }
                    else {
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
                                    <div class='col-sm-2'>
                                    
                                    </div>
                                    <div class='col-sm-6'>
                                        <h3><p>$content</p></h3>
                                    </div>
                                    <div class='col-sm-4'>
                                    

                                    </div>
                               
                            
                            </div>
                        
                        
                        
                        ";

                        global $con;
                        if (isset($_GET['u_id'])) {
                            $u_id = $_GET['u_id'];
                        }
                        $get_posts = "SELECT email FROM prova WHERE id_utente='$u_id'";
                        $run_user = mysqli_query($con, $get_posts);
                        $row = mysqli_fetch_array($run_user);

                        $user_email = $row['email'];

                        $user = $_SESSION['user_email'];
                        $get_user = "SELECT * FROM prova WHERE email='$user'";
                        $run_user = mysqli_query($con, $get_user);
                        $row = mysqli_fetch_array($run_user);

                        $user_id = $row['id_utente'];
                        $u_email = $row['email'];

                        if($u_email != $user_email){
                            echo "<script>window.open('profile.php?u_id=$user_id', '_self')</script>";

                        }else{
                            echo "
                            <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>Visualizza</button></a>
                            <a href='funzioni/edit_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Modifica</button></a>
                                <a href='funzioni/delete_post.php?post_id=$post_id' style='float: right;'><button class='btn btn-danger'>Cancella</button></a>
                             </div><br><br><br>
                             ";
                        }

                    }

                    include("funzioni/delete_post.php");
                }
            
            ?>

    </div>
        <div class='col-sm-2'>


        </div>
<?php }else{
               echo"      
      <div class=\'col-sm-2\'>

        </div>
    </div>
      
      <div class='row'>
            <div class='col-sm-2'>
            </div>
            <div class='col-sm-2' style='background-color: #e6e6e6; text-align: center; left: 0.8%; border-radius: 5px;'>
                
                        <center><h2><strong>Riguardo Prof.</strong></h2></center><br>  
                        
                        <p><strong>Nome: </strong> $nome</p><br>    
                        <p><strong>Cognome: </strong> $cognome</p><br>   
                        <p><strong>Corso: </strong> $corso</p><br>               
                        <p><strong>Registrato il: </strong> $data</p><br>
                        <p><strong>Email: </strong> $email</p><br>
        
                        
                   
    </div>

            <div>      
                    
";

} ?>

    </div>



</body>
</html>