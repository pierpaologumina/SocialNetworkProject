<?php
include("includes/connection.php");
include("funzioni/functions.php");

?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" aria-expanded="false">
                <span class="sr-only">Toggle navgation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">TGSN</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

            <?php
                $user = $_SESSION['user_email'];


                $get_u = "SELECT * FROM prova WHERE email='$user'";
                $run_user = mysqli_query($con, $get_u);
                $row_user = mysqli_fetch_array($run_user);
                $id_utente = $row_user['id_utente'];
                $nome = $row_user['nome'];
                $cognome = $row_user['cognome'];
                $user_name = $row_user['user_name'];
                $email = $row_user['email'];
                $paese = $row_user['paese'];
                $sesso = $row_user['sesso'];
                $compleanno = $row_user['compleanno'];
                $u_status = $row_user['u_status'];
                $u_posts = $row_user['u_posts'];
                $descrizione = $row_user['descrizione'];
                $relazioni = $row_user['relazioni'];
                $user_cover= $row_user['user_cover'];
                $user_image = $row_user['user_image'];
                $user_reg_date = $row_user['user_reg_date'];
                $recovery_account= $row_user['recovery_accont'];
                $facolta = $row_user['facolta'];
                $grado = $row_user['grado'];

                if($nome==""){
                    $user = $_SESSION['user_email'];
                    $get_prof = "SELECT * FROM professori WHERE email='$user'";
                    $run_prof = mysqli_query($con, $get_prof);
                    $row_prof = mysqli_fetch_array($run_prof);
                    $id_utente = $row_prof['id_prof'];
                    $nome = $row_prof['nome'];
                    $cognome = $row_prof['cognome'];
                    $corso = $row_prof['corso'];
                    $data = $row_prof['data'];
                    $email = $row_prof['email'];
                }else{
                    $c="<li><a href=\"home.php\">Home</a></li>";
                    $b="<li><a href='my_post.php?u_id=$id_utente'>My Posts <span class='badge badge-secondary'></span></a></li>";
                    $f="<li><a href='amici.php'>Relazioni</a></li>";
                    $g="<li><a href='libri.php?u_id=$id_utente'>Compra/Vendi Libri</a></li>";
                    $h="<li><a href='bookcrossing.php?u_id=$id_utente'>Bookcrossing</a></li>";
                    $j="<li><a href='condivisione_appunti.php?u_id=$id_utente'>Condivisione Appunti</a></li>";;
                }


                ?>

                <li><a href='profile.php?<?php echo "u_id=$id_utente" ?>'><?php echo $nome; ?></a></li>
                <?php echo $c; ?>
                <li><a href="members.php">Find People</a></li>
                <li><a href="messages.php?u_id=new">Messages</a></li>
                <?php echo $f; ?>
                <li><a href="gestore_canali.php">I Tuoi Canali</a></li>
                <?php echo $g; ?>
                <?php echo $h; ?>
                <?php echo $j; ?>

                <?php
                echo"

						<li class='dropdown'>
							<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span><i class='glyphicon glyphicon-chevron-down'></i></span></a>
							<ul class='dropdown-menu'>
								$b
								<li>
									<a href='edit_profile.php?u_id=$id_utente'>Edit Account</a>
								</li>
								<li role='separator' class='divider'></li>
								<li>
									<a href='logout.php'>Logout</a>
								</li>
							</ul>
						</li>
						";
                ?>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <form class="navbar-form navbar-left" method="get" action="results.php">
                        <div class="form-group">
                            <input type="text" class="form-control" name="user_query" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-info" name="search">Search</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
