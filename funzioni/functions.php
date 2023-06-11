<?php
$con = new mysqli("localhost", "pier","","social_network");

function insertPost(){
    if(isset($_POST['sub'])){
        global $con;
        global $id_utente;

        $content = htmlentities($_POST['content']);
        $upload_image = $_FILES['upload_image']['name'];
        $image_tmp = $_FILES['upload_image']['tmp_name'];
        $random_number = rand(1,100);

        if(strlen($content) > 200){
            echo "<script>alert('Perfavore inserisci fino a un massimo di 200 caratteri!')</script>";
            echo "<script>window.open('home.php' , '_self')</script>";
        }else{
            if(strlen($upload_image) >= 1 && strlen($content) >= 1){
                move_uploaded_file($image_tmp, "imgpost/$upload_image.$random_number");
                $date=date("Y/m/d");

                $insert = "INSERT INTO posts (user_id, post_content, upload_img, post_date) VALUES ('$id_utente','$content', '$upload_image.$random_number','$date')";
                $stmt = $con->prepare($insert);
                $stmt->execute();
                $stmt->fetch();

                if($stmt){
                    echo "<script>alert('Post pubblicato correttamente!')</script>";
                    echo "<script>window.open('home.php', '_self')</script>";

                    $update = "UPDATE prova SET u_posts='YES' WHERE id_utente='$id_utente'";
                    $stmt = $con->prepare($update);
                    $stmt->execute();
                    $stmt->fetch();

                }
                exit();


            }else{
                if ($upload_image =='' && $content==''){
                    echo "<script>alert('Errore di inserimento. Riprova perfavore!')</script>";
                    echo "<script>window.open('home.php', '_self')</script>";

                }else{
                    if ($content==''){
                        move_uploaded_file($image_tmp, "imgpost/$upload_image.$random_number");
                        $date=date("Y/m/d");

                        $insert = "INSERT INTO posts (user_id, post_content, upload_img, post_date) VALUES ('$id_utente','No', '$upload_image.$random_number','$date')";
                        $stmt = $con->prepare($insert);
                        $stmt->execute();
                        $stmt->fetch();
                        if($stmt){
                            echo "<script>alert('Post pubblicato correttamente!')</script>";
                            echo "<script>window.open('home.php', '_self')</script>";

                            $update = "UPDATE prova SET u_posts='YES' WHERE id_utente='$id_utente'";
                            $stmt = $con->prepare($update);
                            $stmt->execute();
                            $stmt->fetch();

                        }
                        exit();

                    }else{
                        $date=date("Y/m/d");

                        $insert = "INSERT INTO posts (user_id, post_content, upload_img, post_date) VALUES ('$id_utente','$content', '' ,'$date')";
                        $stmt = $con->prepare($insert);
                        $stmt->execute();
                        $stmt->fetch();
                        if($stmt){
                            echo "<script>alert('Post pubblicato correttamente!')</script>";
                            echo "<script>window.open('home.php', '_self')</script>";


                            $update = "UPDATE prova SET u_posts='YES' WHERE id_utente='$id_utente'";
                            $stmt = $con->prepare($update);
                            $stmt->execute();
                            $stmt->fetch();

                        }


                    }
                }


            }
        }

    }
}

function get_posts(){
    global $con;

    $user = $_SESSION['user_email'];
    $get_uni = "select * from prova where email='$user'";
    $run_user = mysqli_query($con,$get_uni);
    $row = mysqli_fetch_array($run_user);
    $uni = $row['facolta'];


    $per_page = 4;

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page=1;
    }

    $start_from = ($page-1) * $per_page;

    $get_posts = "select * from posts ORDER by 1 DESC LIMIT $start_from, $per_page";

    $run_posts = mysqli_query($con, $get_posts);

    while($row_posts = mysqli_fetch_array($run_posts)){

        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $content = substr($row_posts['post_content'], 0,40);
        $upload_image = $row_posts['upload_img'];
        $post_date = $row_posts['post_date'];


        $user = "select * from prova where id_utente='$user_id' AND u_posts='YES'";
        $run_user = mysqli_query($con,$user);
        $row_user = mysqli_fetch_array($run_user);

        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];
        $facolta=$row_user['facolta'];

        //now displaying posts from database
        if($uni == $facolta){

        if($content=="No" && strlen($upload_image) >= 1){
            echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
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
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
        }

        else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
            echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
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
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
        }

        else{
            echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
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
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
        }
    }
    }
    include("pagination.php");
}

function single_post(){
    if (isset($_GET['post_id'])){
        global $con;

        $get_id = $_GET['post_id'];


        $get_posts = "SELECT * FROM posts WHERE post_id=$get_id";

        $run_posts = mysqli_query($con, $get_posts);

        $row_posts = mysqli_fetch_array($run_posts);

        $post_id = $row_posts['post_id'];

        $user_id = $row_posts['user_id'];
        $content = $row_posts['post_content'];
        $upload_image = $row_posts['upload_img'];
        $post_date = $row_posts['post_date'];



        $user = "SELECT * FROM prova WHERE id_utente='$user_id' AND u_posts='YES'";
        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);

        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];


        $user_com = $_SESSION['user_email'];
        $get_com = "SELECT * FROM prova WHERE email='$user_com'";

        $run_com = mysqli_query($con, $get_com);
        $row_com = mysqli_fetch_array($run_com);

        $user_com_id = $row_com['id_utente'];
        $user_com_name = $row_com['user_name'];


        if (isset($_GET['post_id'])){
            $post_id = $_GET['post_id'];

        }

        $get_posts = "SELECT post_id FROM posts WHERE post_id='$post_id'";
        $run_user = mysqli_query($con, $get_posts);

        $post_id = $_GET['post_id'];

        $post = $_GET['post_id'];
        $get_user = "SELECT * FROM posts WHERE post_id='$post'";
        $run_user = mysqli_query($con, $get_user);

        $row = mysqli_fetch_array($run_user);

        $p_id = $row['post_id'];



        if ($p_id != $post_id){
            echo "<script>alert('ERROR')</script>";
            echo "<script>window.open('home.php', '_self')</script>";
        }else {
            if ($content == "No" && strlen($upload_image) >= 1) {
                echo "
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
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
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
            } else if (strlen($content) >= 1 && strlen($upload_image) >= 1) {
                echo "
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
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
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
            } else {
                echo "
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
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
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
            } //else condition ending
        }
            include ("comments.php");

            echo "
                <div class='row'>
                    <div class='col-md-6 col-md-offset-3'>
                        <div class='panel panel-info'>
                            <div class='panel-body'>
                                <form action='' method='post' class='form-inline'>
                                    <textarea placeholder='Scrivi il tuo commento qui!' class='pb-cmnt-textarea' name='comment'></textarea>
                                    <button class='btn btn-info pull-right' name='reply'>Commenta</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            ";

            if (isset($_POST['reply'])){
                $comment = htmlentities($_POST['comment']);


                if ($comment == ""){
                    echo "<script>alert('Inserisci il tuo commento')</script>";
                    echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
                }else{
                    $date=date("Y/m/d");
                    $insert = "INSERT INTO comments (post_id, user_id, comment,comment_author,date) VALUES ('$post_id', '$user_id', '$comment', '$user_com_name', '$date')";

                    $run = mysqli_query($con, $insert);
                    echo "<script>alert('Commento inserito correttamente')</script>";
                    echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";



                }

            }



        }





}

function user_posts(){
    global $con;

    if (isset($_GET['u_id'])){
        $u_id = $_GET['u_id'];
    }

    $get_posts = "SELECT * FROM posts WHERE user_id='$u_id' ORDER BY 1 DESC LIMIT 5";

    $run_posts = mysqli_query($con, $get_posts);

    while ($row_posts=mysqli_fetch_array($run_posts)){
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $content = $row_posts['post_content'];
        $upload_image = $row_posts['upload_img'];
        $post_date = $row_posts['post_date'];

        $user = "SELECT * FROM prova WHERE id_utente='$user_id' AND u_posts='YES'";

        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);

        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];

        if(isset($_GET['u_id'])){
            $u_id = $_GET['u_id'];
        }
        $getuser = "SELECT email FROM prova WHERE id_utente='$u_id'";
        $run_user = mysqli_query($con, $getuser);
        $row = mysqli_fetch_array($run_user);

        $user_email = $row['email'];

        $user = $_SESSION['user_email'];
        $get_user = "SELECT * FROM prova WHERE email='$user'";
        $run_user = mysqli_query($con, $get_user);

        $row = mysqli_fetch_array($run_user);

        $user_id = $row['id_utente'];
        $u_email = $row['email'];

        if ($u_email != $user_email){
            echo "<script>window.open('my_post.php?u_id=$user_id', '_self')</script>";
        }else {
            if ($content == "No" && strlen($upload_image) >= 1) {
                echo "
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
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
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
            } else if (strlen($content) >= 1 && strlen($upload_image) >= 1) {
                echo "
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
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
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
            } else {
                echo "
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
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
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
            }

        }



    }

}

function results(){
    global $con;

    if (isset($_GET['search'])){
       $search_query = htmlentities($_GET['user_query']);
    }

    $get_posts = "SELECT * FROM posts WHERE post_content LIKE '%$search_query%' OR upload_img LIKE '%$search_query%'";

    $run_posts = mysqli_query($con, $get_posts);

    while($row_posts=mysqli_fetch_array($run_posts)){
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
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
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
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
            } else if (strlen($content) >= 1 && strlen($upload_image) >= 1) {
                echo "
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
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
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
            } else {
                echo "
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
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
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
            }


    }

}

function search_user(){
    global $con;

    if (isset($_GET['search_user_btn'])){
        $search_query = htmlentities($_GET['search_user']);
        $get_user = "SELECT * FROM prova WHERE user_name LIKE '%$search_query%'";
    }else{
        $get_user = "SELECT * FROM prova";

    }


    $run_user = mysqli_query($con, $get_user);

    while($row_user = mysqli_fetch_array($run_user)){
        $user_id = $row_user['id_utente'];
        $nome = $row_user['nome'];
        $cognome = $row_user['cognome'];
        $username = $row_user['user_name'];
        $user_image = $row_user['user_image'];



        echo "
            <div class='row'>
                <div class='col-sm-3'>       
                </div>
                <div class='col-sm-6'>
                    <div class='row' id='find_people'>
                       <div class='col-sm-4'>
                            <a href='user_profile.php?u_id=$user_id'>
                            <img src='utenti/$user_image' width='150px' height='140px' title='$username' style='float: left; ,margin: 1px;'/>                
                            </a>
                       </div> <br><br>
                       <div class='col-sm-6'>
                            <a style='text-decoration: none; cursor: pointer; color: #3897f0' href='user_profile.php?u_id=$user_id'>
                            <strong><h2>$nome $cognome</h2></strong>
                            </a>
                       </div>
                       <div class='col-sm-3'>
                       
                       </div>
                    </div>         
                </div>
                <div class='col-sm-4'>
                </div>
            </div><br>
        
        
        
        ";


    }


}

function mostra_feed(){
    global $con;

    $user = $_SESSION['user_email'];
    $get_uni = "select * from prova where email='$user'";
    $run_user = mysqli_query($con,$get_uni);
    $row = mysqli_fetch_array($run_user);
    $uni = $row['facolta'];

    if($uni == "Ingegneria"){
        echo "
            <center>
            <!-- start sw-rss-feed code --> 
            <script type=\"text/javascript\"> 
            <!-- 
            rssfeed_url = new Array(); 
            rssfeed_url[0]=\"https://moodle2.unime.it/rss/file.php/3601813/dda82e13e9083721724a5435a760c01d/mod_forum/2606/rss.xml\";  
            rssfeed_frame_width=\"800\"; 
            rssfeed_frame_height=\"150\"; 
            rssfeed_scroll=\"off\"; 
            rssfeed_scroll_step=\"6\"; 
            rssfeed_scroll_bar=\"on\"; 
            rssfeed_target=\"_blank\"; 
            rssfeed_font_size=\"15\"; 
            rssfeed_font_face=\"\"; 
            rssfeed_border=\"on\"; 
            rssfeed_css_url=\"\"; 
            rssfeed_title=\"off\"; 
            rssfeed_title_name=\"\"; 
            rssfeed_title_bgcolor=\"#3366ff\"; 
            rssfeed_title_color=\"#fff\"; 
            rssfeed_title_bgimage=\"\"; 
            rssfeed_footer=\"off\"; 
            rssfeed_footer_name=\"rss feed\"; 
            rssfeed_footer_bgcolor=\"#fff\"; 
            rssfeed_footer_color=\"#333\"; 
            rssfeed_footer_bgimage=\"\"; 
            rssfeed_item_title_length=\"50\"; 
            rssfeed_item_title_color=\"#666\"; 
            rssfeed_item_bgcolor=\"#fff\"; 
            rssfeed_item_bgimage=\"\"; 
            rssfeed_item_border_bottom=\"on\"; 
            rssfeed_item_source_icon=\"off\"; 
            rssfeed_item_date=\"off\"; 
            rssfeed_item_description=\"on\"; 
            rssfeed_item_description_length=\"120\"; 
            rssfeed_item_description_color=\"#666\"; 
            rssfeed_item_description_link_color=\"#333\"; 
            rssfeed_item_description_tag=\"off\"; 
            rssfeed_no_items=\"0\"; 
            rssfeed_cache = \"2a3c2e7674eadda674a55223001c7e8b\"; 
            //--> 
            </script> 
            <script type=\"text/javascript\" src=\"//feed.surfing-waves.com/js/rss-feed.js\"></script> 
            <!-- The link below helps keep this service FREE, and helps other people find the SW widget. Please be cool and keep it! Thanks. --> 
            <!-- end sw-rss-feed code -->
            </center>
            ";


    }

    if($uni == "Legge"){
        echo "
            <center>
            <!-- start sw-rss-feed code --> 
            <script type=\"text/javascript\"> 
            <!-- 
            rssfeed_url = new Array(); 
            rssfeed_url[0]=\"https://moodle2.unime.it/rss/file.php/3601852/dda82e13e9083721724a5435a760c01d/mod_forum/2640/rss.xml\";  
            rssfeed_frame_width=\"800\"; 
            rssfeed_frame_height=\"150\"; 
            rssfeed_scroll=\"off\"; 
            rssfeed_scroll_step=\"6\"; 
            rssfeed_scroll_bar=\"on\"; 
            rssfeed_target=\"_blank\"; 
            rssfeed_font_size=\"15\"; 
            rssfeed_font_face=\"\"; 
            rssfeed_border=\"on\"; 
            rssfeed_css_url=\"\"; 
            rssfeed_title=\"off\"; 
            rssfeed_title_name=\"\"; 
            rssfeed_title_bgcolor=\"#3366ff\"; 
            rssfeed_title_color=\"#fff\"; 
            rssfeed_title_bgimage=\"\"; 
            rssfeed_footer=\"off\"; 
            rssfeed_footer_name=\"rss feed\"; 
            rssfeed_footer_bgcolor=\"#fff\"; 
            rssfeed_footer_color=\"#333\"; 
            rssfeed_footer_bgimage=\"\"; 
            rssfeed_item_title_length=\"50\"; 
            rssfeed_item_title_color=\"#666\"; 
            rssfeed_item_bgcolor=\"#fff\"; 
            rssfeed_item_bgimage=\"\"; 
            rssfeed_item_border_bottom=\"on\"; 
            rssfeed_item_source_icon=\"off\"; 
            rssfeed_item_date=\"off\"; 
            rssfeed_item_description=\"on\"; 
            rssfeed_item_description_length=\"120\"; 
            rssfeed_item_description_color=\"#666\"; 
            rssfeed_item_description_link_color=\"#333\"; 
            rssfeed_item_description_tag=\"off\"; 
            rssfeed_no_items=\"0\"; 
            rssfeed_cache = \"a01afd2a76bde97768c95a4eab44a3f9\"; 
            //--> 
            </script> 
            <script type=\"text/javascript\" src=\"//feed.surfing-waves.com/js/rss-feed.js\"></script> 
            <!-- The link below helps keep this service FREE, and helps other people find the SW widget. Please be cool and keep it! Thanks. --> 
            <!-- end sw-rss-feed code -->
            </center>
            ";
    }

    if($uni == "Lettere"){
        echo "
            <center>
            <!-- start sw-rss-feed code --> 
            <script type=\"text/javascript\"> 
            <!-- 
            rssfeed_url = new Array(); 
            rssfeed_url[0]=\"https://moodle2.unime.it/rss/file.php/3601797/dda82e13e9083721724a5435a760c01d/mod_forum/2591/rss.xml\";  
            rssfeed_frame_width=\"800\"; 
            rssfeed_frame_height=\"150\"; 
            rssfeed_scroll=\"off\"; 
            rssfeed_scroll_step=\"6\"; 
            rssfeed_scroll_bar=\"on\"; 
            rssfeed_target=\"_blank\"; 
            rssfeed_font_size=\"15\"; 
            rssfeed_font_face=\"\"; 
            rssfeed_border=\"on\"; 
            rssfeed_css_url=\"\"; 
            rssfeed_title=\"off\"; 
            rssfeed_title_name=\"\"; 
            rssfeed_title_bgcolor=\"#3366ff\"; 
            rssfeed_title_color=\"#fff\"; 
            rssfeed_title_bgimage=\"\"; 
            rssfeed_footer=\"off\"; 
            rssfeed_footer_name=\"rss feed\"; 
            rssfeed_footer_bgcolor=\"#fff\"; 
            rssfeed_footer_color=\"#333\"; 
            rssfeed_footer_bgimage=\"\"; 
            rssfeed_item_title_length=\"50\"; 
            rssfeed_item_title_color=\"#666\"; 
            rssfeed_item_bgcolor=\"#fff\"; 
            rssfeed_item_bgimage=\"\"; 
            rssfeed_item_border_bottom=\"on\"; 
            rssfeed_item_source_icon=\"off\"; 
            rssfeed_item_date=\"off\"; 
            rssfeed_item_description=\"on\"; 
            rssfeed_item_description_length=\"120\"; 
            rssfeed_item_description_color=\"#666\"; 
            rssfeed_item_description_link_color=\"#333\"; 
            rssfeed_item_description_tag=\"off\"; 
            rssfeed_no_items=\"0\"; 
            rssfeed_cache = \"af83b25aba27b8f597126558691cefb8\"; 
            //--> 
            </script> 
            <script type=\"text/javascript\" src=\"//feed.surfing-waves.com/js/rss-feed.js\"></script> 
            <!-- The link below helps keep this service FREE, and helps other people find the SW widget. Please be cool and keep it! Thanks. --> 
            <!-- end sw-rss-feed code -->
            </center>
            ";
    }

}

function mostra_studenti(){
    global $con;

    if (isset($_GET['search_user_btn'])){
        $search_query = htmlentities($_GET['search_user']);
        $get_user = "SELECT * FROM prova WHERE user_name LIKE '%$search_query%'";
    }else{
        $get_user = "SELECT * FROM prova";

    }


    $run_user = mysqli_query($con, $get_user);

    while($row_user = mysqli_fetch_array($run_user)){
        $grado = $row_user['grado'];

        if($grado=="Studente"){

        $user_id = $row_user['id_utente'];
        $nome = $row_user['nome'];
        $cognome = $row_user['cognome'];
        $email=$row_user['email'];
        $facolta=$row_user['facolta'];
        $paese=$row_user['paese'];
        $sesso=$row_user['sesso'];
        $user_reg_date=$row_user['user_reg_date'];




        echo "
            <div class='row'>
                <div class='col-sm-3'>       
                </div>
                <div class='col-sm-6'>
                    <div class='row' id='find_people'>
                       
                       <div class='col-sm-6'>
                            <strong>
                            <h2>$nome $cognome</h2>
                            <h5>$facolta - $email - $paese - $sesso</h5>
                            <h6>Registrato il: $user_reg_date</h6>
                            
                            </strong>                      
                       </div>
                       <div class='col-sm-3'>
                            
                       </div>
                            <a href='funzioni/modifica_studente.php?id_studente=$user_id'' style='float:right;'><button class='btn btn-info'>Modifica Account</button></a>
                            <a href='funzioni/elimina_studente.php?id_studente=$user_id' style='float: right;'><button class='btn btn-danger'>Cancella Account</button></a>
                    </div>         
                </div>
                <div class='col-sm-4'>
                </div>
            </div><br>
        
        
        
        ";


    }
    }

}

function mostra_professori(){
    global $con;

    $get_prof = "SELECT * FROM professori";
    $run_prof = mysqli_query($con, $get_prof);

    while($row_prof = mysqli_fetch_array($run_prof)){
        $id_prof = $row_prof['id_prof'];
        $nome = $row_prof['nome'];
        $cognome = $row_prof['cognome'];
        $corso = $row_prof['corso'];
        $data = $row_prof['data'];
        $email = $row_prof['email'];

            echo "
            <div class='row'>
                <div class='col-sm-3'>       
                </div>
                <div class='col-sm-6'>
                    <div class='row' id='find_people'>
                       <div class='col-sm-4'>
                            <a href='user_profile.php?u_id=$id_utente'>
            
                            </a>
                       </div> <br><br>
                       <div class='col-sm-6'>
                       
                            <strong><h2>$nome $cognome</h2></strong>
                            <strong><h4>$corso - $email</h4></strong>
                            <strong><h6>Registrato il: $data</h6></strong>
                       
                       </div>
                       <div class='col-sm-3'>
                            
                       </div>
                            <a href='funzioni/modifica_prof.php?id_prof=$id_prof' style='float:right;'><button class='btn btn-info'>Modifica Account</button></a>
                            <a href='funzioni/elimina_prof.php?id_prof=$id_prof' style='float: right;'><button class='btn btn-danger'>Cancella Account</button></a>
                    </div>         
                </div>
                <div class='col-sm-4'>
                </div>
            </div><br>
        
        
        
        ";


        }
    }

function mostra_canali(){
    global $con;

    $user = $_SESSION['user_email'];
    $get_prof = "select * from professori where email='$user'";
    $run_prof = mysqli_query($con,$get_prof);
    $row_prof = mysqli_fetch_array($run_prof);
    $id_prof= $row_prof['id_prof'];
    $nome_prof= $row_prof['nome'];
    $cognome_prof= $row_prof['cognome'];
    if($id_prof!=""){




    $get_canali = "select * from canali where id_prof='$id_prof'";
    $run_canali = mysqli_query($con,$get_canali);
    while($row_canali = mysqli_fetch_array($run_canali)){

            $id_canale = $row_canali['id_canale'];
            $nome = $row_canali['nome'];
            $id_prof = $row_canali['id_prof'];
            $data = $row_canali['data'];
            $tit = $row_canali['titolo'];



            echo "
            <div class='row'>
                <div class='col-sm-3'>       
                </div>
                <div class='col-sm-6'>
                    <div class='row' id='find_people'>
                       
                       <div class='col-sm-6'>
                        
                            <strong><h2>$nome </h2>$tit<h5>$nome_prof $cognome_prof - $data</h5></strong>
                           
                       </div>
                       <div class='col-sm-3'>
                            
                       </div>   
                       <br><br>
                       
                            <a href='funzioni/elimina_canale.php?id_canale=$id_canale' style='float: right;'><button class='btn btn-danger'>Cancella</button></a>
                            <a href='modifica_canale.php?id_canale=$id_canale' style='float:right;'><button class='btn btn-warning'>Modifica</button></a>                            
                            <a href='visualizza_contenuto_canale.php?id_canale=$id_canale' style='float: right;'><button class='btn btn-info'>Visualizza</button></a>
                            <a href='inserisci_studenti.php?id_canale=$id_canale' style='float: right;'><button class='btn btn-success'>Inserisci/Rimuovi Studenti</button></a>
                    </div>         
                </div>
                <div class='col-sm-4'>
                </div>
            </div><br>
        
        
        
        ";

    }
        }else{
        $user = $_SESSION['user_email'];
        $get_user = "select * from prova where email='$user'";
        $run_user = mysqli_query($con,$get_user);
        $row_user = mysqli_fetch_array($run_user);
        $id_utente= $row_user['id_utente'];


        $get_user_canali = "select * from mebri_canali where id_studente='$id_utente'";
        $run_user_canali = mysqli_query($con,$get_user_canali);

        while($row_user_canali = mysqli_fetch_array($run_user_canali)){

            $id_user_canale = $row_user_canali['id_canale'];

            $get_canali = "select * from canali where id_canale='$id_user_canale'";
            $run_canali = mysqli_query($con,$get_canali);
            $row_canali = mysqli_fetch_array($run_canali);
            $id_canale = $row_canali['id_canale'];
            if($id_canale!=""){
            $nome = $row_canali['nome'];
            $id_prof = $row_canali['id_prof'];
            $data = $row_canali['data'];
            $tit = $row_canali['titolo'];

            $get_prof = "select * from professori where id_prof='$id_prof'";
            $run_prof = mysqli_query($con,$get_prof);
            $row_prof = mysqli_fetch_array($run_prof);

            $nome_prof= $row_prof['nome'];
            $cognome_prof= $row_prof['cognome'];
            echo "
            <div class='row'>
                <div class='col-sm-3'>       
                </div>
                <div class='col-sm-6'>
                    <div class='row' id='find_people'>
                       
                       <div class='col-sm-6'>
                        
                            <strong><h2>$nome </h2>$tit<h5>$nome_prof $cognome_prof - $data</h5></strong>
                           
                       </div>
                       <div class='col-sm-3'>
                            
                       </div>   
                       <br><br>
                       
                                                     
                            <a href='visualizza_contenuto_canale.php?id_canale=$id_canale' style='float: right;'><button class='btn btn-info'>Visualizza</button></a>
                           
                    </div>         
                </div>
                <div class='col-sm-4'>
                </div>
            </div><br>
        
        
        
        ";

        }
        }

    }//fine else

}

function mostra_studenti_non_inseriti(){
    global $con;
    $id_canale = $_GET['id_canale'];
    $user = $_SESSION['user_email'];
    $get_uni = "select * from professori where email='$user'";
    $run_uni = mysqli_query($con,$get_uni);
    $row = mysqli_fetch_array($run_uni);
    $uni = $row['corso'];

    $sql = "select * from prova where facolta='$uni'";
    $run_sql = mysqli_query($con,$sql);

    while($row_sql = mysqli_fetch_array($run_sql)) {
        $id_u = $row_sql['id_utente'];
        $query = "select * from mebri_canali where id_studente='$id_u' AND id_canale='$id_canale'";
        $run_query = mysqli_query($con, $query);
        $row_query = mysqli_fetch_array($run_query);
        $id_stud = $row_query['id_studente'];

        if ($id_stud == "") {


            $nome = $row_sql['nome'];
            $cognome = $row_sql['cognome'];
            $username = $row_sql['user_name'];
            $user_image = $row_sql['user_image'];


            echo "
            <div class='row'>
                <div class='col-sm-3'>       
                </div>
                <div class='col-sm-6'>
                    <div class='row' id='find_people'>
                       <div class='col-sm-4'>
                        
                            <img src='utenti/$user_image' width='150px' height='140px' title='$username' style='float: left; ,margin: 1px;'/>                
                     
                       </div> <br><br>
                       <div class='col-sm-6'>
                            <a style='text-decoration: none; cursor: pointer; color: #3897f0' href='user_profile.php?u_id=$id_u'>
                            <strong><h2>$nome $cognome</h2></strong>
                            </a>
                       </div>
                       <div class='col-sm-3'>
                            
                       </div>
                            <a href='funzioni/inserisci_membro_canale.php?id_studente=$id_u&id_canale=$id_canale' style='float:right;'><button class='btn btn-success'>Aggiungi Al Canale</button></a>
                    </div>         
                </div>
                <div class='col-sm-4'>
                </div>
            </div><br>
        
        
        
        ";
        }

    }



    }

function mostra_studenti_inseriti(){
    global $con;

    if(isset($_GET['id_canale'])){
        $id_canale = $_GET['id_canale'];


    $get_user = "SELECT * FROM mebri_canali WHERE id_canale='$id_canale'";

    $run_user = mysqli_query($con, $get_user);

    while($row_user = mysqli_fetch_array($run_user)){
        $id_stud=$row_user['id_studente'];
        $id_m=$row_user['id_m'];

        $get_u = "SELECT * FROM prova WHERE id_utente='$id_stud'";

        $run_info = mysqli_query($con, $get_u);
        $row_info = mysqli_fetch_array($run_info);

            $user_id = $row_info['id_utente'];
            $nome = $row_info['nome'];

            $cognome = $row_info['cognome'];
            $username = $row_info['user_name'];
            $user_image = $row_info['user_image'];


            echo "
            <div class='row'>
                <div class='col-sm-3'>       
                </div>
                <div class='col-sm-6'>
                    <div class='row' id='find_people'>
                       <div class='col-sm-4'>
                            <a href='user_profile.php?u_id=$user_id'>
                            <img src='utenti/$user_image' width='150px' height='140px' title='$username' style='float: left; ,margin: 1px;'/>                
                            </a>
                       </div> <br><br>
                       <div class='col-sm-6'>
                            <a style='text-decoration: none; cursor: pointer; color: #3897f0' href='user_profile.php?u_id=$user_id'>
                            <strong><h2>$nome $cognome</h2></strong>
                            </a>
                       </div>
                       <div class='col-sm-3'>
                            
                       </div>
                            <a href='funzioni/elimina_membro_canale.php?id_m=$id_m' style='float:right;'><button class='btn btn-danger'>Rimuovi Dal Canale</button></a>
                    </div>         
                </div>
                <div class='col-sm-4'>
                </div>
            </div><br>
        
        
        
        ";


    }

}
}

function mostra_post_canali(){
    global $con;
    if(isset($_GET['id_canale'])){
        $user_com = $_SESSION['user_email'];
        $get_com = "SELECT * FROM professori WHERE email='$user_com'";
        $run_com = mysqli_query($con, $get_com);
        $row_com = mysqli_fetch_array($run_com);
        $user_com_id = $row_com['id_prof'];
        $user_com_nome = $row_com['nome'];
        $user_com_cognome = $row_com['cognome'];

        if($user_com_id!=""){
            $id_canale = $_GET['id_canale'];
            $get_post = "SELECT * FROM post_canali WHERE id_canale='$id_canale'";
            $run_post = mysqli_query($con, $get_post);

            while($row_post = mysqli_fetch_array($run_post)){
                $id_post = $row_post['id_post'];
                $id_canale = $row_post['id_canale'];
                $titolo = $row_post['titolo'];
                $content = $row_post['contenuto'];
                $upload_image = $row_post['post_img'];
                $date = $row_post['date'];

                echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						
						<div class='col-sm-6'>
							<h3>$titolo</h3>
							<h4><small style='color:black;'>Creato il <strong>$date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<h3><p>$content</p></h3>
						</div>
					</div><br>
					
					
				    <a href='' style='float: right;'><button class='btn btn-danger'>Cancella</button></a>
                    <a href='modifica_post_canale.php?post_id=$id_post' style='float:right;'><button class='btn btn-warning'>Modifica</button></a> 
				    <a href='single_canali.php?post_id=$id_post' style='float:right;'><button class='btn btn-info'>Visualizza Commenti</button></a>  
				
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";

            }


        }else{
            $id_canale = $_GET['id_canale'];
            $get_post = "SELECT * FROM post_canali WHERE id_canale='$id_canale'";
            $run_post = mysqli_query($con, $get_post);

            while($row_post = mysqli_fetch_array($run_post)){
                $id_post = $row_post['id_post'];
                $id_canale = $row_post['id_canale'];
                $titolo = $row_post['titolo'];
                $content = $row_post['contenuto'];
                $upload_image = $row_post['post_img'];
                $date = $row_post['date'];

                echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						
						<div class='col-sm-6'>
							<h3>$titolo</h3>
							<h4><small style='color:black;'>Creato il <strong>$date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<h3><p>$content</p></h3>
						</div>
					</div><br>
				
				    <a href='single_canali.php?post_id=$id_post' style='float:right;'><button class='btn btn-info'>Visualizza Commenti</button></a>  
				
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";

            }

        }

    }

}

function single_post_canali(){
    if (isset($_GET['post_id'])){
        global $con;


        $user_com = $_SESSION['user_email'];
        $get_co = "SELECT * FROM professori WHERE email='$user_com'";
        $run_co = mysqli_query($con, $get_co);
        $row_co = mysqli_fetch_array($run_co);
        $prof_com_id = $row_co['id_prof'];
        $prof_com_nome = $row_co['nome'];





        $prof_com_cognome = $row_co['cognome'];
        if($prof_com_id!=""){
            $get_id = $_GET['post_id'];
            $get_comments = "SELECT * FROM commenti_canali WHERE post_id='$get_id'";
            $run_comments = mysqli_query($con, $get_comments);
            while($row_comments = mysqli_fetch_array($run_comments)){
                $id_commento= $row_comments['id_commento'];
                $post_id = $row_comments['post_id'];
                $user_id = $row_comments['user_id'];
                $contenuto = $row_comments['contenuto'];
                $data= $row_comments['data'];

                $user = "SELECT * FROM prova WHERE id_utente='$user_id'";
                $run_user = mysqli_query($con, $user);
                $row_user = mysqli_fetch_array($run_user);

                $nome = $row_user['nome'];
                $cognome = $row_user['cognome'];
                if($nome==""){
                    $nome=$prof_com_nome;
                    $cognome=$prof_com_cognome;
                }

                echo "
            <div class='row'>
              <div class='col-md-6 col-md-offset-3'>
                <div class='panel panel-info'>
                <div class='panel-body'>
                    <div>
                        <h4><strong>$nome $cognome</strong><i> commentato</i> il $data</h4>
                        <p class='text-primary' style='margin-left: 5px; font-size: 20px'>$contenuto</p>
                          <a href='funzioni/elimina_commento_canale.php?id_commento=$id_commento' style='float: right;'><button class='btn btn-danger'>Cancella</button></a>
                    
                    </div>
                </div>
                </div>  
              </div>

            </div>
        ";


            }

            echo "
                <div class='row'>
                    <div class='col-md-6 col-md-offset-3'>
                        <div class='panel panel-info'>
                            <div class='panel-body'>
                                <form action='' method='post' class='form-inline'>
                                    <textarea placeholder='Scrivi il tuo commento qui!' class='pb-cmnt-textarea' name='comment'></textarea>
                                    <button class='btn btn-info pull-right' name='reply'>Commenta</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            ";

            if (isset($_POST['reply'])){
                $comment = htmlentities($_POST['comment']);


                if ($comment == ""){
                    echo "<script>alert('Inserisci il tuo commento')</script>";
                    echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
                }else{
                    $date=date("Y/m/d");
                    $insert = "INSERT INTO commenti_canali (post_id, user_id, contenuto, data) VALUES ('$get_id', '$user_com_id', '$comment', '$date')";

                    $run = mysqli_query($con, $insert);


                    if($run){
                        echo "<script>alert('Commento inserito correttamente')</script>";
                        echo "<script>window.open('single_canali.php?post_id=$get_id', '_self')</script>";
                    }



                }

            }














        }else {
            $user_com = $_SESSION['user_email'];
            $get_com = "SELECT * FROM prova WHERE email='$user_com'";
            $run_com = mysqli_query($con, $get_com);
            $row_com = mysqli_fetch_array($run_com);
            $user_com_id = $row_com['id_utente'];
            $user_com_nome = $row_com['nome'];
            $user_com_cognome = $row_com['cognome'];



        $get_id = $_GET['post_id'];
        $get_comments = "SELECT * FROM commenti_canali WHERE post_id='$get_id'";
        $run_comments = mysqli_query($con, $get_comments);
        while($row_comments = mysqli_fetch_array($run_comments)){
            $id_commento= $row_comments['id_commento'];
            $post_id = $row_comments['post_id'];
            $user_id = $row_comments['user_id'];
            $contenuto = $row_comments['contenuto'];
            $data= $row_comments['data'];

            $user = "SELECT * FROM prova WHERE id_utente='$user_id'";
            $run_user = mysqli_query($con, $user);
            $row_user = mysqli_fetch_array($run_user);

            $nome = $row_user['nome'];
            $cognome = $row_user['cognome'];
            if($nome==""){
                $get_co = "SELECT * FROM professori WHERE id_prof='$user_id'";
                $run_co = mysqli_query($con, $get_co);
                $row_co = mysqli_fetch_array($run_co);

                $nome = $row_co['nome'];
                $cognome = $row_co['cognome'];



            }

            echo "
            <div class='row'>
              <div class='col-md-6 col-md-offset-3'>
                <div class='panel panel-info'>
                <div class='panel-body'>
                    <div>
                        <h4><strong>$nome $cognome</strong><i> commentato</i> il $data</h4>
                        <p class='text-primary' style='margin-left: 5px; font-size: 20px'>$contenuto</p>
                     
                    
                    </div>
                </div>
                </div>  
              </div>

            </div>
        ";


        }

        echo "
                <div class='row'>
                    <div class='col-md-6 col-md-offset-3'>
                        <div class='panel panel-info'>
                            <div class='panel-body'>
                                <form action='' method='post' class='form-inline'>
                                    <textarea placeholder='Scrivi il tuo commento qui!' class='pb-cmnt-textarea' name='comment'></textarea>
                                    <button class='btn btn-info pull-right' name='reply'>Commenta</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            ";

        if (isset($_POST['reply'])){
            $comment = htmlentities($_POST['comment']);


            if ($comment == ""){
                echo "<script>alert('Inserisci il tuo commento')</script>";
                echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
            }else{
                $date=date("Y/m/d");
                $insert = "INSERT INTO commenti_canali (post_id, user_id, contenuto, data) VALUES ('$get_id', '$user_com_id', '$comment', '$date')";

                $run = mysqli_query($con, $insert);


                if($run){
                    echo "<script>alert('Commento inserito correttamente')</script>";
                    echo "<script>window.open('single_canali.php?post_id=$get_id', '_self')</script>";
                }



            }

        }


        }



    }


}

function mostra_sconosciuti(){
    global $con;
    $user = $_SESSION['user_email'];
    $get_utente_info = "SELECT * FROM prova WHERE email='$user'";
    $run_utente_info = mysqli_query($con, $get_utente_info);
    $row_utente_info = mysqli_fetch_array($run_utente_info);
    $id_mio = $row_utente_info['id_utente'];
    $mio_compleanno = $row_utente_info['compleanno'];
    $anno=substr($mio_compleanno, 0, 4);


    $get_user = "SELECT * FROM prova WHERE facolta='Ingegneria' AND compleanno LIKE '%$anno%'";
    $run_user = mysqli_query($con, $get_user);

    while($row_user = mysqli_fetch_array($run_user)){
        $grado = $row_user['grado'];


        if($grado=="Studente") {



            $user_id = $row_user['id_utente'];
            $nome = $row_user['nome'];
            $cognome = $row_user['cognome'];
            $email = $row_user['email'];
            $facolta = $row_user['facolta'];
            $paese = $row_user['paese'];
            $sesso = $row_user['sesso'];
            $user_reg_date = $row_user['user_reg_date'];


                    if ($user != $email) {

                        $verifica = "SELECT * FROM relazioni WHERE id_utente='$id_mio' AND amico_di='$user_id'";
                        $run_verifica = mysqli_query($con, $verifica);
                        $row_verifica = mysqli_fetch_array($run_verifica);
                        $id_relazione = $row_verifica['id_relazione'];
                        if($id_relazione==""){
                            $verifica2 = "SELECT * FROM relazioni WHERE id_utente='$user_id' AND amico_di='$id_mio'";
                            $run_verifica2 = mysqli_query($con, $verifica2);
                            $row_verifica2 = mysqli_fetch_array($run_verifica2);
                            $id_relazione2 = $row_verifica2['id_relazione'];
                            if($id_relazione2==""){



                        echo "
                <div class='row'>
                    <div class='col-sm-3'>       
                    </div>
                    <div class='col-sm-6'>
                        <div class='row' id='find_people'>
                           
                           <div class='col-sm-6'>
                                <strong>
                                <h2>$nome $cognome</h2>
                                <h5>$facolta - $email - $paese - $sesso</h5>
                                <h6>Registrato il: $user_reg_date</h6>
                                
                                </strong>                      
                           </div>
                           <div class='col-sm-3'>
                                
                           </div>
                                <a href='funzioni/invia_richiesta.php?id_utente=$user_id&mestesso=$user'' style='float:right;'><button class='btn btn-info'>Invia richiesta di amicizia</button></a>
                        </div>         
                    </div>
                    <div class='col-sm-4'>
                    </div>
                </div><br>
            
            
            
            ";
                            }}
                    }
                }
            }



}

function mostra_richieste(){
    global $con;
    $user = $_SESSION['user_email'];
    $get_utente_info = "SELECT * FROM prova WHERE email='$user'";
    $run_utente_info = mysqli_query($con, $get_utente_info);
    $row_utente_info = mysqli_fetch_array($run_utente_info);
    $id_mio = $row_utente_info['id_utente'];


    $get_relazioni = "SELECT * FROM relazioni WHERE id_utente='$id_mio'";
    $run_relazioni = mysqli_query($con, $get_relazioni);

    while($row_relazioni = mysqli_fetch_array($run_relazioni)){
        $id_relazione = $row_relazioni['id_relazione'];
        $id_utente = $row_relazioni['id_utente'];
        $amico_di= $row_relazioni['amico_di'];
        $stato = $row_relazioni['stato'];
        $tipo = $row_relazioni['tipo'];


        $get_user = "SELECT * FROM prova WHERE id_utente='$amico_di' ";
        $run_user = mysqli_query($con, $get_user);
        $row_user = mysqli_fetch_array($run_user);

        if($stato==0){

            $user_id = $row_user['id_utente'];
            $nome = $row_user['nome'];
            $cognome = $row_user['cognome'];
            $email=$row_user['email'];
            $facolta=$row_user['facolta'];
            $paese=$row_user['paese'];
            $sesso=$row_user['sesso'];
            $user_reg_date=$row_user['user_reg_date'];

            if($user!=$email) {


                echo "
            <div class='row'>
                <div class='col-sm-3'>       
                </div>
                <div class='col-sm-6'>
                    <div class='row' id='find_people'>
                       
                       <div class='col-sm-6'>
                            <strong>
                            <h2>$nome $cognome</h2>
                            <h5>$facolta - $email - $paese - $sesso</h5>
                            <h6>Registrato il: $user_reg_date</h6>
                            
                            </strong>                      
                       </div>
                       <div class='col-sm-3'>
                            
                       </div>
                            <a href='funzioni/elimina_richiesta.php?id_relazione=$id_relazione' style='float:right;'><button class='btn btn-danger'>Elimina richiesta di amicizia</button></a>
                    </div>         
                </div>
                <div class='col-sm-4'>
                </div>
            </div><br>
        
        
        
        ";

            }
        }
    }

}

function mostra_amici(){
    global $con;

    $utente = $_SESSION['user_email'];
    $get_utente_info = "SELECT * FROM prova WHERE email='$utente'";
    $run_utente_info = mysqli_query($con, $get_utente_info);
    $row_utente_info = mysqli_fetch_array($run_utente_info);
    $id_mio = $row_utente_info['id_utente'];

    $get_relazione = "SELECT * FROM relazioni WHERE id_utente='$id_mio' OR amico_di='$id_mio'";
    $run_relazione = mysqli_query($con, $get_relazione);

    while($row_relazione = mysqli_fetch_array($run_relazione)){
        $user_id_relazione = $row_relazione['id_relazione'];
        $user_rel_utente = $row_relazione['id_utente'];
        $user_rel_amicodi = $row_relazione['amico_di'];
        $user_rel_stato = $row_relazione['stato'];


        if($user_rel_stato==1) {
            if($user_rel_utente==$id_mio) {
                $get_user = "SELECT * FROM prova WHERE id_utente='$user_rel_amicodi'";
                $run_user = mysqli_query($con, $get_user);
                $row_user = mysqli_fetch_array($run_user);

                $user_id = $row_user['id_utente'];
                $nome = $row_user['nome'];

                $cognome = $row_user['cognome'];
                $email = $row_user['email'];
                $facolta = $row_user['facolta'];
                $paese = $row_user['paese'];
                $sesso = $row_user['sesso'];
                $user_reg_date = $row_user['user_reg_date'];

            }else{
                $get_user = "SELECT * FROM prova WHERE id_utente='$user_rel_utente'";
                $run_user = mysqli_query($con, $get_user);
                $row_user = mysqli_fetch_array($run_user);

                $user_id = $row_user['id_utente'];
                $nome = $row_user['nome'];

                $cognome = $row_user['cognome'];
                $email = $row_user['email'];
                $facolta = $row_user['facolta'];
                $paese = $row_user['paese'];
                $sesso = $row_user['sesso'];
                $user_reg_date = $row_user['user_reg_date'];

            }




                if ($utente != $email) {


                    echo "
                <div class='row'>
                    <div class='col-sm-3'>       
                    </div>
                    <div class='col-sm-6'>
                        <div class='row' id='find_people'>
                           
                           <div class='col-sm-6'>
                                <strong>
                                <h2>$nome $cognome</h2>
                                <h5>$facolta - $email - $paese - $sesso</h5>
                                <h6>Registrato il: $user_reg_date</h6>
                                
                                </strong>                      
                           </div>
                           <div class='col-sm-3'>
                                
                           </div>
                                <a href='funzioni/elimina_richiesta.php?id_relazione=$user_id_relazione' style='float:right;'><button class='btn btn-danger'>Cancella Dagli Amici</button></a>
                        </div>         
                    </div>
                    <div class='col-sm-4'>
                    </div>
                </div><br>
            
            
            
            ";

                }
            }
        }


}

function mostra_richieste_ricevute(){
    global $con;
    $utente = $_SESSION['user_email'];
    $get_utente_info = "SELECT * FROM prova WHERE email='$utente'";
    $run_utente_info = mysqli_query($con, $get_utente_info);
    $row_utente_info = mysqli_fetch_array($run_utente_info);
    $id_mio = $row_utente_info['id_utente'];



    $get_relazioni = "SELECT * FROM relazioni WHERE amico_di='$id_mio'";
    $run_relazioni = mysqli_query($con, $get_relazioni);

    while($row_relazioni = mysqli_fetch_array($run_relazioni)){
        $id_relazione = $row_relazioni['id_relazione'];
        $id_utente = $row_relazioni['id_utente'];
        $amico_di= $row_relazioni['amico_di'];
        $stato = $row_relazioni['stato'];
        $tipo = $row_relazioni['tipo'];


        $get_user = "SELECT * FROM prova WHERE id_utente='$id_utente'";
        $run_user = mysqli_query($con, $get_user);
        $row_user = mysqli_fetch_array($run_user);

        if($stato==0){

            $user_id = $row_user['id_utente'];
            $nome = $row_user['nome'];
            $cognome = $row_user['cognome'];
            $email=$row_user['email'];
            $facolta=$row_user['facolta'];
            $paese=$row_user['paese'];
            $sesso=$row_user['sesso'];
            $user_reg_date=$row_user['user_reg_date'];

            if($utente!=$email) {


                echo "
            <div class='row'>
                <div class='col-sm-3'>       
                </div>
                <div class='col-sm-6'>
                    <div class='row' id='find_people'>
                       
                       <div class='col-sm-6'>
                            <strong>
                            <h2>$nome $cognome</h2>
                            <h5>$facolta - $email - $paese - $sesso</h5>
                            <h6>Registrato il: $user_reg_date</h6>
                            
                            </strong>                      
                       </div>
                       <div class='col-sm-3'>
                            
                       </div>
                            <a href='funzioni/elimina_richiesta.php?id_relazione=$id_relazione' style='float:right;'><button class='btn btn-danger'>Elimina richiesta di amicizia</button></a>
                            <a href='funzioni/accetta_richiesta.php?id_relazione=$id_relazione' style='float:right;'><button class='btn btn-info'>Accetta richiesta di amicizia</button></a>
                    </div>         
                </div>
                <div class='col-sm-4'>
                </div>
            </div><br>
        
        
        
        ";

            }
        }
    }

}

function mostra_libri_invendita(){
    global $con;
    $utente = $_SESSION['user_email'];
    $get_utente_info = "SELECT * FROM prova WHERE email='$utente'";
    $run_utente_info = mysqli_query($con, $get_utente_info);
    $row_utente_info = mysqli_fetch_array($run_utente_info);
    $id_mio = $row_utente_info['id_utente'];
    $facolta = $row_utente_info['facolta'];

    $search_query = htmlentities($_GET['user_query']);
    if($search_query==""){
        $get_libri = "SELECT * FROM libri";
    }else{
        $get_libri = "SELECT * FROM libri WHERE titolo_testo LIKE '%$search_query%' OR autore LIKE '%$search_query%'";
        $info_ricerca="Risultati di ricerca per: ".$search_query;
    }

    $run_libri = mysqli_query($con, $get_libri);

    $i=0;
    while($row_libri = mysqli_fetch_array($run_libri)){
        if($i>0){
            $info_ricerca="";
        }
        $id_libro = $row_libri['id_libro'];
        $titolo_testo = $row_libri['titolo_testo'];
        $corso = $row_libri['corso'];
        $edizione = $row_libri['edizione'];
        $autore = $row_libri['autore'];
        $caricato_da = $row_libri['caricato_da'];
        $condizione = $row_libri['condizione'];
        $prezzo = $row_libri['prezzo'];
        $caricato_il = $row_libri['caricato_il'];
        $img_libro = $row_libri['img_libro'];
        $info = $row_libri['info'];

        if($id_mio!=$caricato_da && $facolta==$corso){


                echo "
                <center>$info_ricerca</center>
            <div class='row'>
                    <div class='col-sm-3'>       
                    </div>
                    <div class='col-sm-6'>
                        <div class='row' id='find_people' style='z-index: 1;'>
                      
                        <img class='zoom' src='img_libri/$img_libro' width='160px' height='250px' style='float: left; ,margin: 1px;'/>
                        
                           
                           <div class='col-sm-6' style='z-index: -1'>
                                <strong>
                                <h2>$titolo_testo</h2>
                                <h5>$autore - $edizione</h5>
                                <h6>Prezzo € $prezzo</h6>
                                
                                </strong>                      
                           </div>
                           <div class='col-sm-3'>
                                
                           </div>
                                <a href='payment/paypage.php?id_libro=$id_libro' style='float:right;'><button class='btn btn-success'>Acquista</button></a>
                                <a href='info_libro.php?id_libro=$id_libro' style='float:right;'><button class='btn btn-info'>Vedi piu' informazioni</button></a>
                                
                        </div>         
                    </div>
                    <div class='col-sm-4'>
                    </div>
                </div><br>      

        ";

            }
        $i++;
        }

}

function mostra_tuoilibri_invendita(){
    global $con;
    $utente = $_SESSION['user_email'];
    $get_utente_info = "SELECT * FROM prova WHERE email='$utente'";
    $run_utente_info = mysqli_query($con, $get_utente_info);
    $row_utente_info = mysqli_fetch_array($run_utente_info);
    $id_mio = $row_utente_info['id_utente'];
    $facolta = $row_utente_info['facolta'];

    $search_query = htmlentities($_GET['user_query']);
    if($search_query==""){
        $get_libri = "SELECT * FROM libri";
    }else{
        $get_libri = "SELECT * FROM libri WHERE titolo_testo LIKE '%$search_query%' OR autore LIKE '%$search_query%'";
        $info_ricerca="Risultati di ricerca per: ".$search_query;
    }

    $run_libri = mysqli_query($con, $get_libri);

    $i=0;
    while($row_libri = mysqli_fetch_array($run_libri)){
        if($i>0){
            $info_ricerca="";
        }
        $id_libro = $row_libri['id_libro'];
        $titolo_testo = $row_libri['titolo_testo'];
        $corso = $row_libri['corso'];
        $edizione = $row_libri['edizione'];
        $autore = $row_libri['autore'];
        $caricato_da = $row_libri['caricato_da'];
        $condizione = $row_libri['condizione'];
        $prezzo = $row_libri['prezzo'];
        $caricato_il = $row_libri['caricato_il'];
        $img_libro = $row_libri['img_libro'];
        $info = $row_libri['info'];

        if($id_mio==$caricato_da && $facolta==$corso){


            echo "
                <center>$info_ricerca</center>
            <div class='row'>
                    <div class='col-sm-3'>       
                    </div>
                    <div class='col-sm-6'>
                        <div class='row' id='find_people' style='z-index: 1;'>
                      
                        <img class='zoom' src='img_libri/$img_libro' width='160px' height='250px' style='float: left; ,margin: 1px;'/>
                        
                           
                           <div class='col-sm-6' style='z-index: -1'>
                                <strong>
                                <h2>$titolo_testo</h2>
                                <h5>$autore - $edizione</h5>
                                <h6>Prezzo € $prezzo</h6>
                                
                                </strong>                      
                           </div>
                           <div class='col-sm-3'>
                                
                           </div>
                                <a href='funzioni/elimina_libro.php?id_libro=$id_libro' style='float:right;'><button class='btn btn-danger'>Rimuovi dalla Bacheca</button></a>
                                
                                
                        </div>         
                    </div>
                    <div class='col-sm-4'>
                    </div>
                </div><br>      

        ";

        }
        $i++;
    }

}

function bookcrossing_donazione(){
    global $con;
    $utente = $_SESSION['user_email'];
    $get_utente_info = "SELECT * FROM prova WHERE email='$utente'";
    $run_utente_info = mysqli_query($con, $get_utente_info);
    $row_utente_info = mysqli_fetch_array($run_utente_info);
    $id_mio = $row_utente_info['id_utente'];
    $facolta = $row_utente_info['facolta'];

    $search_query = htmlentities($_GET['user_query']);
    if($search_query==""){
        $get_libri = "SELECT * FROM bookcrossing";
    }else{
        $get_libri = "SELECT * FROM bookcrossing WHERE titolo LIKE '%$search_query%' OR autore LIKE '%$search_query%'";
        $info_ricerca="Risultati di ricerca per: ".$search_query;
    }

    $run_libri = mysqli_query($con, $get_libri);

    $i=0;
    while($row_libri = mysqli_fetch_array($run_libri)){
        if($i>0){
            $info_ricerca="";
        }
        $id_libro = $row_libri['id'];
        $bcid = $row_libri['bcid'];
        $titolo= $row_libri['titolo'];
        $autore = $row_libri['autore'];
        $img_copertina = $row_libri['img_copertina'];
        $utente_inserito = $row_libri['utente_inserito'];
        $data_inserimento = $row_libri['data_inserimento'];
        $stato = $row_libri['stato'];
        $possessore = $row_libri['possessore'];
        $data_possesso = $row_libri['data_possesso'];
        $luogo = $row_libri['luogo'];

        $get_utente_info2 = "SELECT * FROM prova WHERE id_utente='$utente_inserito'";
        $run_utente_info2 = mysqli_query($con, $get_utente_info2);
        $row_utente_info2 = mysqli_fetch_array($run_utente_info2);
        $nome = $row_utente_info2['nome'];
        $cognome = $row_utente_info2['cognome'];

        if($stato=='donazione'){

            echo "
                <center>$info_ricerca</center>
            <div class='row'>
                    <div class='col-sm-3'>       
                    </div>
                    <div class='col-sm-6'>
                        <div class='row' id='find_people' style='z-index: 1;'>
                      
                        <img class='zoom' src='img_libri/$img_copertina' width='160px' height='250px' style='float: left; ,margin: 1px;'/>
                        
                           
                           <div class='col-sm-6' style='z-index: -1'>
                                <strong>
                                <h2>Titolo: $titolo</h2>
                                <h2>Autore: $autore</h2>
                                <h4>Caricato da: $nome $cognome il: $data_inserimento</h4>
                                <h4>Luogo: $luogo - BCID: $bcid</h4>
                                
                                </strong>                      
                           </div>
                           <div class='col-sm-3'>
                                
                           </div>
                                
                                <a href='funzioni/modifica_stato.php?id_libro=$id_libro&metodo=donazione' style='float:right;'><button class='btn btn-success'>Conferma Donazione</button></a><br><br>
                                <h6>*Premi Conferma donazione se hai posato il libro nel luogo indicato della fase di donazione.</h6>
                        </div>         
                    </div>
                    <div class='col-sm-4'>
                    </div>
                </div><br>      

        ";

        }
        $i++;
    }

}

function bookcrossing_disponibili(){
    global $con;
    $utente = $_SESSION['user_email'];
    $get_utente_info = "SELECT * FROM prova WHERE email='$utente'";
    $run_utente_info = mysqli_query($con, $get_utente_info);
    $row_utente_info = mysqli_fetch_array($run_utente_info);
    $id_mio = $row_utente_info['id_utente'];
    $facolta = $row_utente_info['facolta'];


    $search_query = htmlentities($_GET['user_query']);
    if($search_query==""){
        $get_libri = "SELECT * FROM bookcrossing";
    }else{
        $get_libri = "SELECT * FROM bookcrossing WHERE titolo LIKE '%$search_query%' OR autore LIKE '%$search_query%'";
        $info_ricerca="Risultati di ricerca per: ".$search_query;
    }



    $run_libri = mysqli_query($con, $get_libri);
    $i=0;

    while($row_libri = mysqli_fetch_array($run_libri)){
        if($i>0){
            $info_ricerca="";
        }
        $id_libro = $row_libri['id'];
        $bcid = $row_libri['bcid'];
        $titolo= $row_libri['titolo'];
        $autore = $row_libri['autore'];
        $img_copertina = $row_libri['img_copertina'];
        $utente_inserito = $row_libri['utente_inserito'];
        $data_inserimento = $row_libri['data_inserimento'];
        $stato = $row_libri['stato'];
        $possessore = $row_libri['possessore'];
        $data_possesso = $row_libri['data_possesso'];
        $luogo = $row_libri['luogo'];

        $get_utente_info2 = "SELECT * FROM prova WHERE id_utente='$utente_inserito'";
        $run_utente_info2 = mysqli_query($con, $get_utente_info2);
        $row_utente_info2 = mysqli_fetch_array($run_utente_info2);
        $nome = $row_utente_info2['nome'];
        $cognome = $row_utente_info2['cognome'];

            if($stato=='disponibile'){

            echo "
                <center>$info_ricerca</center>
            <div class='row'>
                    <div class='col-sm-3'>       
                    </div>
                    <div class='col-sm-6'>
                        <div class='row' id='find_people' style='z-index: 1;'>
                      
                        <img class='zoom' src='img_libri/$img_copertina' width='160px' height='250px' style='float: left; ,margin: 1px;'/>
                        
                           
                           <div class='col-sm-6' style='z-index: -1'>
                                <strong>
                                <h2>Titolo: $titolo</h2>
                                <h2>Autore: $autore</h2>
                                <h4>Caricato da: $nome $cognome il: $data_inserimento</h4>
                                <h4>Luogo: $luogo - BCID: $bcid</h4>
                                
                                </strong>                      
                           </div>
                           <div class='col-sm-3'>
                                
                           </div>
                             <a href='vedi_recensioni.php?id_libro=$id_libro' style='float:right;'><button class='btn btn-info'>Visualizza Recensioni</button></a>
                                <a href='funzioni/modifica_stato.php?id_libro=$id_libro&metodo=disponibile' style='float:right;'><button class='btn btn-info'>Ottieni</button></a>
                                
                        </div>         
                    </div>
                    <div class='col-sm-4'>
                    </div>
                </div><br>      

        ";

            }
            $i++;
    }

}

function bookcrossing_ritiro(){
    global $con;
    $utente = $_SESSION['user_email'];
    $get_utente_info = "SELECT * FROM prova WHERE email='$utente'";
    $run_utente_info = mysqli_query($con, $get_utente_info);
    $row_utente_info = mysqli_fetch_array($run_utente_info);
    $id_mio = $row_utente_info['id_utente'];
    $facolta = $row_utente_info['facolta'];

    $search_query = htmlentities($_GET['user_query']);
    if($search_query==""){
        $get_libri = "SELECT * FROM bookcrossing";
    }else{
        $get_libri = "SELECT * FROM bookcrossing WHERE titolo LIKE '%$search_query%' OR autore LIKE '%$search_query%'";
        $info_ricerca="Risultati di ricerca per: ".$search_query;
    }

    $run_libri = mysqli_query($con, $get_libri);

    $i=0;
    while($row_libri = mysqli_fetch_array($run_libri)){
        if($i>0){
            $info_ricerca="";
        }
        $id_libro = $row_libri['id'];
        $bcid = $row_libri['bcid'];
        $titolo= $row_libri['titolo'];
        $autore = $row_libri['autore'];
        $img_copertina = $row_libri['img_copertina'];
        $utente_inserito = $row_libri['utente_inserito'];
        $data_inserimento = $row_libri['data_inserimento'];
        $stato = $row_libri['stato'];
        $possessore = $row_libri['possessore'];
        $data_possesso = $row_libri['data_possesso'];
        $luogo = $row_libri['luogo'];

        $get_utente_info2 = "SELECT * FROM prova WHERE id_utente='$utente_inserito'";
        $run_utente_info2 = mysqli_query($con, $get_utente_info2);
        $row_utente_info2 = mysqli_fetch_array($run_utente_info2);
        $nome = $row_utente_info2['nome'];
        $cognome = $row_utente_info2['cognome'];

        if($stato=='ritiro'){

            echo "
            <center>$info_ricerca</center>
            <div class='row'>
                    <div class='col-sm-3'>       
                    </div>
                    <div class='col-sm-6'>
                        <div class='row' id='find_people' style='z-index: 1;'>
                      
                        <img class='zoom' src='img_libri/$img_copertina' width='160px' height='250px' style='float: left; ,margin: 1px;'/>
                        
                           
                           <div class='col-sm-6' style='z-index: -1'>
                                <strong>
                                <h2>Titolo: $titolo</h2>
                                <h2>Autore: $autore</h2>
                                <h4>Caricato da: $nome $cognome il: $data_inserimento</h4>
                                <h4>Luogo: $luogo - BCID: $bcid</h4>
                                
                                </strong>                      
                           </div>
                           <div class='col-sm-3'>
                                
                           </div>
                       
                            <a href='funzioni/modifica_stato.php?id_libro=$id_libro&metodo=cancella_ritiro' style='float:right;'><button class='btn btn-danger'>Cancella Ritiro</button></a>
                           <a href='funzioni/modifica_stato.php?id_libro=$id_libro&metodo=ritiro' style='float:right;'><button class='btn btn-info'>Conferma Ritiro</button></a>
                           
                                <br><br><br><br>
                                <h6>*Premi Conferma Ritiro se hai preso il libro dal luogo indicato.</h6>
                          
                            
                        </div>         
                    </div>
                    <div class='col-sm-4'>
                    </div>
                </div><br>      

        ";

        }
        $i++;
    }

}

function bookcrossing_lettura(){
    global $con;
    $utente = $_SESSION['user_email'];
    $get_utente_info = "SELECT * FROM prova WHERE email='$utente'";
    $run_utente_info = mysqli_query($con, $get_utente_info);
    $row_utente_info = mysqli_fetch_array($run_utente_info);
    $id_mio = $row_utente_info['id_utente'];
    $facolta = $row_utente_info['facolta'];

    $search_query = htmlentities($_GET['user_query']);
    if($search_query==""){
        $get_libri = "SELECT * FROM bookcrossing";
    }else{
        $get_libri = "SELECT * FROM bookcrossing WHERE titolo LIKE '%$search_query%' OR autore LIKE '%$search_query%'";
        $info_ricerca="Risultati di ricerca per: ".$search_query;
    }

    $run_libri = mysqli_query($con, $get_libri);

    $i=0;
    while($row_libri = mysqli_fetch_array($run_libri)){
        if($i>0){
            $info_ricerca="";
        }
        $id_libro = $row_libri['id'];
        $bcid = $row_libri['bcid'];
        $titolo= $row_libri['titolo'];
        $autore = $row_libri['autore'];
        $img_copertina = $row_libri['img_copertina'];
        $utente_inserito = $row_libri['utente_inserito'];
        $data_inserimento = $row_libri['data_inserimento'];
        $stato = $row_libri['stato'];
        $possessore = $row_libri['possessore'];
        $data_possesso = $row_libri['data_possesso'];
        $luogo = $row_libri['luogo'];

        $get_utente_info2 = "SELECT * FROM prova WHERE id_utente='$utente_inserito'";
        $run_utente_info2 = mysqli_query($con, $get_utente_info2);
        $row_utente_info2 = mysqli_fetch_array($run_utente_info2);
        $nome = $row_utente_info2['nome'];
        $cognome = $row_utente_info2['cognome'];

        if($stato=='lettura'){

            echo "
            <center>$info_ricerca</center>
            <div class='row'>
                    <div class='col-sm-3'>       
                    </div>
                    <div class='col-sm-6'>
                        <div class='row' id='find_people' style='z-index: 1;'>
                      
                        <img class='zoom' src='img_libri/$img_copertina' width='160px' height='250px' style='float: left; ,margin: 1px;'/>
                        
                           
                           <div class='col-sm-6' style='z-index: -1'>
                                <strong>
                                <h2>Titolo: $titolo</h2>
                                <h2>Autore: $autore</h2>
                                <h4>Caricato da: $nome $cognome il: $data_inserimento</h4>
                                <h4>Luogo: $luogo - BCID: $bcid</h4>
                                
                                </strong>                      
                           </div>
                           <div class='col-sm-3'>
                                
                           </div>
                             
                               
                                <form id='myform2' method='post' action='funzioni/modifica_stato.php?id_libro=$id_libro&metodo=lettura' enctype='multipart/form-data'>
                         
                             
                                <input hidden='hidden' type='text' name='prova2' id='demo2'>
                            
                                <button type='submit' class='btn btn-info'>Rimetti in giro</button>
                                  </form>
                        
                        </div>         
                    </div>
                    <div class='col-sm-4'>
                    </div>
                </div><br>      

        ";

        }
        $i++;
    }

}

function bookcrossing_rimessa(){
    global $con;
    $utente = $_SESSION['user_email'];
    $get_utente_info = "SELECT * FROM prova WHERE email='$utente'";
    $run_utente_info = mysqli_query($con, $get_utente_info);
    $row_utente_info = mysqli_fetch_array($run_utente_info);
    $id_mio = $row_utente_info['id_utente'];
    $facolta = $row_utente_info['facolta'];

    $search_query = htmlentities($_GET['user_query']);
    if($search_query==""){
        $get_libri = "SELECT * FROM bookcrossing";
    }else{
        $get_libri = "SELECT * FROM bookcrossing WHERE titolo LIKE '%$search_query%' OR autore LIKE '%$search_query%'";
        $info_ricerca="Risultati di ricerca per: ".$search_query;
    }

    $run_libri = mysqli_query($con, $get_libri);

    $i=0;
    while($row_libri = mysqli_fetch_array($run_libri)){
        if($i>0){
            $info_ricerca="";
        }
        $id_libro = $row_libri['id'];
        $bcid = $row_libri['bcid'];
        $titolo= $row_libri['titolo'];
        $autore = $row_libri['autore'];
        $img_copertina = $row_libri['img_copertina'];
        $utente_inserito = $row_libri['utente_inserito'];
        $data_inserimento = $row_libri['data_inserimento'];
        $stato = $row_libri['stato'];
        $possessore = $row_libri['possessore'];
        $data_possesso = $row_libri['data_possesso'];
        $luogo = $row_libri['luogo'];

        $get_utente_info2 = "SELECT * FROM prova WHERE id_utente='$utente_inserito'";
        $run_utente_info2 = mysqli_query($con, $get_utente_info2);
        $row_utente_info2 = mysqli_fetch_array($run_utente_info2);
        $nome = $row_utente_info2['nome'];
        $cognome = $row_utente_info2['cognome'];

        if($stato=='rimessa'){

            echo "
             <center>$info_ricerca</center>
            <div class='row'>
                    <div class='col-sm-3'>       
                    </div>
                    <div class='col-sm-6'>
                        <div class='row' id='find_people' style='z-index: 1;'>
                      
                        <img class='zoom' src='img_libri/$img_copertina' width='160px' height='250px' style='float: left; ,margin: 1px;'/>
                        
                           
                           <div class='col-sm-6' style='z-index: -1'>
                                <strong>
                                <h2>Titolo: $titolo</h2>
                                <h2>Autore: $autore</h2>
                                <h4>Caricato da: $nome $cognome il: $data_inserimento</h4>
                                <h4>Luogo: $luogo - BCID: $bcid</h4>
                                
                                </strong>                      
                           </div>
                           <div class='col-sm-3'>
                                
                           </div>
        
                                <form id='myform' method='post' action='funzioni/modifica_stato.php?id_libro=$id_libro&metodo=rimessa' enctype='multipart/form-data'>
                         
                             
                                <input hidden='hidden' type='text' name='prova' id='demo'>
                            
                                <button type='submit' class='btn btn-info'>Conferma Rimessa</button>
                                  </form>
                                
                                
                                 <h6>*Premi Conferma Rimessa se hai posato il libro nel luogo indicato.</h6>
                        
                        </div>         
                    </div>
                    <div class='col-sm-4'>
                    </div>
                </div><br>      

        ";

        }
        $i++;
    }

}

function bookcrossing_non_disponibili(){
    global $con;
    $utente = $_SESSION['user_email'];
    $get_utente_info = "SELECT * FROM prova WHERE email='$utente'";
    $run_utente_info = mysqli_query($con, $get_utente_info);
    $row_utente_info = mysqli_fetch_array($run_utente_info);
    $id_mio = $row_utente_info['id_utente'];
    $facolta = $row_utente_info['facolta'];

    $search_query = htmlentities($_GET['user_query']);
    if($search_query==""){
        $get_libri = "SELECT * FROM bookcrossing";
    }else{
        $get_libri = "SELECT * FROM bookcrossing WHERE titolo LIKE '%$search_query%' OR autore LIKE '%$search_query%'";
        $info_ricerca="Risultati di ricerca per: ".$search_query;
    }

    $run_libri = mysqli_query($con, $get_libri);

    $i=0;
    while($row_libri = mysqli_fetch_array($run_libri)){
        if($i>0){
            $info_ricerca="";
        }
        $id_libro = $row_libri['id'];
        $bcid = $row_libri['bcid'];
        $titolo= $row_libri['titolo'];
        $autore = $row_libri['autore'];
        $img_copertina = $row_libri['img_copertina'];
        $utente_inserito = $row_libri['utente_inserito'];
        $data_inserimento = $row_libri['data_inserimento'];
        $stato = $row_libri['stato'];
        $possessore = $row_libri['possessore'];
        $data_possesso = $row_libri['data_possesso'];
        $luogo = $row_libri['luogo'];

        $get_utente_info2 = "SELECT * FROM prova WHERE id_utente='$utente_inserito'";
        $run_utente_info2 = mysqli_query($con, $get_utente_info2);
        $row_utente_info2 = mysqli_fetch_array($run_utente_info2);
        $nome = $row_utente_info2['nome'];
        $cognome = $row_utente_info2['cognome'];

        $get_utente_info3 = "SELECT * FROM prova WHERE id_utente='$possessore'";
        $run_utente_info3 = mysqli_query($con, $get_utente_info3);
        $row_utente_info3 = mysqli_fetch_array($run_utente_info3);
        $nome2 = $row_utente_info3['nome'];
        $cognome2 = $row_utente_info3['cognome'];

        if($stato!='disponibile'){

            echo "
            <center>$info_ricerca</center>
            <div class='row'>
                    <div class='col-sm-3'>       
                    </div>
                    <div class='col-sm-6'>
                        <div class='row' id='find_people' style='z-index: 1;'>
                      
                        <img class='zoom' src='img_libri/$img_copertina' width='160px' height='250px' style='float: left; ,margin: 1px;'/>
                        
                           
                           <div class='col-sm-6' style='z-index: -1'>
                                <strong>
                                <h2>Titolo: $titolo</h2>
                                <h2>Autore: $autore</h2>
                                <h4>Caricato da: $nome $cognome il: $data_inserimento</h4>
                                <h4>Luogo: $luogo - BCID: $bcid</h4>
                                <h4>In possesso di: $nome2 $cognome2 - Dal: $data_possesso</h4>
                                
                                </strong>                      
                           </div>
                           <div class='col-sm-3'>
                                
                           </div>
                             
                                <a href='messages.php?u_id=$possessore' style='float:right;'><button class='btn btn-info'>Contatta possessore</button></a>
                                
                        </div>         
                    </div>
                    <div class='col-sm-4'>
                    </div>
                </div><br>      

        ";

        }
        $i++;
    }

}

function mostra_appunti(){
    global $con;
    $utente = $_SESSION['user_email'];
    $get_utente_info = "SELECT * FROM prova WHERE email='$utente'";
    $run_utente_info = mysqli_query($con, $get_utente_info);
    $row_utente_info = mysqli_fetch_array($run_utente_info);
    $id_mio = $row_utente_info['id_utente'];
    $facolta = $row_utente_info['facolta'];



    $search_query = htmlentities($_GET['user_query']);
    if($search_query==""){
        $get_appunti = "SELECT * FROM appunti";
    }else{
        $get_appunti = "SELECT * FROM appunti WHERE materia LIKE '%$search_query%' OR corso LIKE '%$search_query%'";
    }

    $run_appunti = mysqli_query($con, $get_appunti);

    while($row_appunti = mysqli_fetch_array($run_appunti)){
        $id_appunto = $row_appunti['id_appunto'];
        $caricato_da = $row_appunti['caricato_da'];
        $caricato_il = $row_appunti['caricato_il'];
        $link = $row_appunti['link'];
        $materia = $row_appunti['materia'];
        $corso = $row_appunti['corso'];
        $descrizione = $row_appunti['descrizione'];

        $get_utente_info2 = "SELECT * FROM prova WHERE id_utente='$caricato_da'";
        $run_utente_info2 = mysqli_query($con, $get_utente_info2);
        $row_utente_info2 = mysqli_fetch_array($run_utente_info2);
        $nome = $row_utente_info2['nome'];
        $cognome = $row_utente_info2['cognome'];



            echo "

            <div class='row'>
                    <div class='col-sm-3'>       
                    </div>
                    <div class='col-sm-6'>
                        <div class='row' id='find_people' style='z-index: 1;'>
                        
                           
                           <div class='col-sm-6' style='z-index: -1'>
                                <strong>
                                <h2>Materia: $materia</h2>
                                <h2>Corso: $corso</h2>
                                <h4>Caricato da: $nome $cognome il: $caricato_il</h4>
                               
                                <h5>Descrizione: $descrizione </h5>
                                
                                
                                </strong>                      
                           </div>
                           <div class='col-sm-3'>
                                
                           </div>
                             
                                <a href='$link' style='float:right;'><button class='btn btn-info'>Scarica</button></a>
                                
                        </div>         
                    </div>
                    <div class='col-sm-4'>
                    </div>
                </div><br>      

        ";








    }
}

function mostra_tuoi_appunti(){
    global $con;
    $utente = $_SESSION['user_email'];
    $get_utente_info = "SELECT * FROM prova WHERE email='$utente'";
    $run_utente_info = mysqli_query($con, $get_utente_info);
    $row_utente_info = mysqli_fetch_array($run_utente_info);
    $id_mio = $row_utente_info['id_utente'];
    $facolta = $row_utente_info['facolta'];

    $search_query = htmlentities($_GET['user_query']);
    if($search_query==""){
        $get_appunti = "SELECT * FROM appunti";
    }else{
        $get_appunti = "SELECT * FROM appunti WHERE materia LIKE '%$search_query%' OR corso LIKE '%$search_query%'";
    }

    $run_appunti = mysqli_query($con, $get_appunti);

    while($row_appunti = mysqli_fetch_array($run_appunti)){
        $id_appunto = $row_appunti['id_appunto'];
        $caricato_da = $row_appunti['caricato_da'];
        $caricato_il = $row_appunti['caricato_il'];
        $link = $row_appunti['link'];
        $materia = $row_appunti['materia'];
        $corso = $row_appunti['corso'];
        $descrizione = $row_appunti['descrizione'];

        $get_utente_info2 = "SELECT * FROM prova WHERE id_utente='$caricato_da'";
        $run_utente_info2 = mysqli_query($con, $get_utente_info2);
        $row_utente_info2 = mysqli_fetch_array($run_utente_info2);
        $nome = $row_utente_info2['nome'];
        $cognome = $row_utente_info2['cognome'];

        if($caricato_da==$id_mio){

        echo "

            <div class='row'>
                    <div class='col-sm-3'>       
                    </div>
                    <div class='col-sm-6'>
                        <div class='row' id='find_people' style='z-index: 1;'>
                        
                           
                           <div class='col-sm-6' style='z-index: -1'>
                                <strong>
                                <h2>Materia: $materia</h2>
                                <h2>Corso: $corso</h2>
                                <h4>Caricato da: $nome $cognome il: $caricato_il</h4>
                               
                                <h5>Descrizione: $descrizione </h5>
                                
                                
                                </strong>                      
                           </div>
                           <div class='col-sm-3'>
                                
                           </div>
                             
                                <a href='funzioni/cancella_condivisione.php?id_appunto=$id_appunto' style='float:right;'><button class='btn btn-danger'>Cancella condivisione</button></a>
                                
                        </div>         
                    </div>
                    <div class='col-sm-4'>
                    </div>
                </div><br>      

        ";

        }
    }
}

function vedi_recensioni(){
    global $con;
    $utente = $_SESSION['user_email'];
    $get_utente_info = "SELECT * FROM prova WHERE email='$utente'";
    $run_utente_info = mysqli_query($con, $get_utente_info);
    $row_utente_info = mysqli_fetch_array($run_utente_info);
    $id_mio = $row_utente_info['id_utente'];
    $facolta = $row_utente_info['facolta'];

    $libro = $_GET['id_libro'];
    $get_recensioni = "SELECT * FROM recensioni";


    $run_recensioni = mysqli_query($con, $get_recensioni);

    while($row_recensioni = mysqli_fetch_array($run_recensioni)){
        $id_recensione = $row_recensioni['id_recensione'];
        $id_libro = $row_recensioni['id_libro'];
        $id_utente = $row_recensioni['id_utente'];
        $testo = $row_recensioni['testo'];
        $data = $row_recensioni['data'];

        $get_utente_info2 = "SELECT * FROM prova WHERE id_utente='$id_utente'";
        $run_utente_info2 = mysqli_query($con, $get_utente_info2);
        $row_utente_info2 = mysqli_fetch_array($run_utente_info2);
        $nome = $row_utente_info2['nome'];
        $cognome = $row_utente_info2['cognome'];

        if($libro==$id_libro){

            echo "

            <div class='row'>
                    <div class='col-sm-3'>       
                    </div>
                    <div class='col-sm-6'>
                        <div class='row' id='find_people' style='z-index: 1;'>
                        
                           
                           <div class='col-sm-6' style='z-index: -1'>
                                <strong>
                                <h2>$nome $cognome Scrive:</h2>
                                <h4>$testo</h4>
                  
                               
                                <h5>Scritto il: $data</h5>
                                
                                
                                </strong>                      
                           </div>
                           <div class='col-sm-3'>
                                
                           </div>
                             
                                
                                
                        </div>         
                    </div>
                    <div class='col-sm-4'>
                    </div>
                </div><br>      

        ";
        }
    }
}


?>