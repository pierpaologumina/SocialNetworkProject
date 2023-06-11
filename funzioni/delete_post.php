<?php
$con = new mysqli("localhost", "pier","","social_network");


if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];

    $delete_post = "DELETE FROM posts WHERE post_id='$post_id'";

    $run_delete = mysqli_query($con,$delete_post);

    if($run_delete){
        echo "<script>alert('Post eliminato correttamente!')</script>";
        echo "<script>window.open('../home.php', '_self')</script>";

    }
}

?>