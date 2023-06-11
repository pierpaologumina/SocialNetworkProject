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
    <title>Compra/Vendi Libri</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style2.css">

    <style>
        * {
            box-sizing: border-box;
        }
        .zoom {
            padding: 0px;
            background-color: green;
            transition: transform .2s;
            width: 160px;
            height: 250px;
            margin: 0 auto;
        }

        .zoom:hover {
            -ms-transform: scale(2.0); /* IE 9 */
            -webkit-transform: scale(2.0); /* Safari 3-8 */
            transform: scale(2.0);
        }

        * {box-sizing: border-box}

        /* Set height of body and the document to 100% */
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial;
        }

        /* Style tab links */
        .tabpiu {
            background-color: #ff8a80;
            color: white;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            font-size: 17px;
            width: 10%;
        }

        .tabpiu:hover {
            background-color: #ffcdd2;
        }

        /* Style tab links */
        .tablink {
            background-color: #546e7a;
            color: white;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            font-size: 17px;
            width: 45%;
        }

        .tablink:hover {
            background-color: #90a4ae;
        }

    </style>
</head>
<body>
<div class="row">
    <?php echo mostra_feed(); ?>
</div>
<br>
<a href='vendi_libro.php?id=<?php echo $id_utente; ?>'><button class="tabpiu">Vendi</button></a>

<button class="tablink" onclick="openPage('SA', this, '#37474f')" id="defaultOpen">Vetrina Libri</button>
<button class="tablink" onclick="openPage('News', this, '#37474f')">I tuoi libri in vendita</button>
<br>
<br>
<br>
<br>
<form class="navbar-form navbar-center" method="get" action="">
    <center>
        <input required="required" type="text" class="form-control" name="user_query" placeholder="Cerca tra i libri">
        <button type="submit" class="btn btn-info">Cerca</button>
    </center>
</form>

<div id="SA" class="tabcontent">
    <?php mostra_libri_invendita(); ?>
</div>

<div id="News" class="tabcontent">
    <?php mostra_tuoilibri_invendita(); ?>
</div>

<script>
    function openPage(pageName,elmnt,color) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }
        document.getElementById(pageName).style.display = "block";
        elmnt.style.backgroundColor = color;
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();

</script>
</body>
</html>

