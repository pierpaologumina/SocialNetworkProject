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
    <title>Bookcrossing</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style2.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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

        .tablink {
            background-color: #546e7a;
            color: white;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            font-size: 17px;
            width: 30%;
        }

        .tablink:hover {
            background-color: #90a4ae;
        }

        .tabpiu:hover {
            background-color: #ffcdd2;
        }











        * {box-sizing: border-box}
        body {font-family: "Lato", sans-serif;}

        /* Style the tab */
        .tab {
            float: left;

            background-color: #f1f1f1;
            width: 20%;
            height: 100px;
        }

        /* Style the buttons inside the tab */
        .tab button {
            display: block;
            background-color: inherit;
            color: black;
            padding: 22px 16px;
            width: 60%;
            border: none;
            outline: none;
            text-align: left;
            cursor: pointer;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current "tab button" class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcont {
            float: left;
            padding: 0px 12px;

            width: 80%;
            border-left: none;
            height: 300px;
        }
    </style>
</head>
<body>
<div class="row">
    <?php echo mostra_feed(); ?>
</div>
<br>
<a href='dona_libro.php?id=<?php echo $id_utente; ?>'><button class="tabpiu">Dona ♥</button></a>


<button class="tablink" onclick="openPage('SA', this, '#37474f')" id="defaultOpen">Libri disponibili</button>
<button class="tablink" onclick="openPage('News', this, '#37474f')">Libri al momento non disponibili</button>
<button class="tablink" onclick="openPage('Contact', this, '#37474f')">Libri in mio possesso</button>
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
<?php echo bookcrossing_disponibili(); ?>
</div>

<div id="News" class="tabcontent">
    <?php echo bookcrossing_non_disponibili(); ?>
</div>

<div id="Contact" class="tabcontent">


    <div class="tab">
        <button class="tabb" onclick="openCity(event, 'Donazione')" id="defaultOpenn">Libri in fase di donazione</button>
        <button class="tabb" onclick="openCity(event, 'Ritiro')">Libri in fase di ritiro</button>
        <button class="tabb" onclick="openCity(event, 'Lettura')">Libri in fase di lettura</button>
        <button class="tabb" onclick="openCity(event, 'Rimessa')">Libri in fase di rimessa</button>
    </div>

    <div id="Donazione" class="tabcont">
        <?php echo bookcrossing_donazione(); ?>
    </div>

    <div id="Ritiro" class="tabcont">
        <?php echo bookcrossing_ritiro(); ?>
    </div>

    <div id="Lettura" class="tabcont">
        <?php echo bookcrossing_lettura(); ?>
    </div>

    <div id="Rimessa" class="tabcont">
        <?php echo bookcrossing_rimessa(); ?>
    </div>

    <script>
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcont");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tabb");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpenn").click();
    </script>


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


    $('#myform').submit(function() {
        document.getElementById("demo").value = prompt("Inserisci il luogo di rilascio del libro:");
        return true; // return false to cancel form action
    });


    $('#myform2').submit(function() {
        document.getElementById("demo2").value = prompt("Recensisci il libro:");
        return true; // return false to cancel form action
    });



</script>
</body>


</html>