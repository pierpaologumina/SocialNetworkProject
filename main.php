<!DOCTYPE html>
<html>
<!--INIZIO PARTE RELATIVA AL BOOTSTRAP -->
<head>
    <title>THE GREAT SOCIAL</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<!--FINE PARTE RELATIVA AL BOOTSTRAP -->

<!--INIZIO PARTE CSS-->
<style>
   body{
       overflow-x: hidden;
   }
    #iscriviti{
        width: 30%;
        border-radius: 30px;
    }
   #accedi{
       width: 30%;
       background-color: #fff;
       border: 1px solid #1da1f2;
       color: #1da1f2;
       border-radius: 30px;
   }
    #accedi:hover{
        width: 30%;
        background-color: #fff;
        color: #1da1f2;
        border: 2px solid #1da1f2;
        border-radius: 30px;
    }
    .well{
        background-color: #187FAB;
    }
</style>
<!--FINE PARTE CSS-->

    <div class="row">
        <div class="col-sm-12">
             <div class="well">
                <div style="text-align: center;"><h1 style="color: white">THE GREAT SOCIAL NETWORK</h1></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6" style="left:0.5%;">
            <img src="img/logo2.png" class="img-rounded" title="THE GREAT SOCIAL" >
        </div>


     <div class="color-sm-6" style="left:8%;">
         <img src="img/icon.png" class="img-rounded" title="THE GREAT SOCIAL" width="80px" height="80px">
         <h2><strong>Guarda cosa sta accadendo nel mondo </strong></h2><br><br>
         <h4><strong>Unisciti.</strong></h4>
         <form method="post" action="">
             <button id="iscriviti" class="btn btn-info btn-lg" name="iscriviti">Iscriviti</button><br><br>
             <?php
                if(isset($_POST['iscriviti'])){
                    echo "<script>window.open('iscriviti.php','_self')</script>";
                }
             ?>
             <button id="accedi" class="btn btn-info btn-lg" name="accedi">Accedi</button><br><br>
             <?php
             if(isset($_POST['accedi'])){
                 echo "<script>window.open('accedi.php','_self')</script>";
             }
             ?>
         </form>
     </div>
    </div>
</body>
</html>
