<?php

include "cheader.php";
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

        
} else {
    echo ("<script> alert('Pleas log in first!!!'); </script>");
    echo ("<script> window.location.replace('login.php');</script>");}
?>


<html>

<head>
    <title>Feedback</title>
    
    <link rel="stylesheet" href="asset.css">
    

</head>


<body>
    <h1 style="margin-left:10%;">
        Feedback Form
    </h1>
    <div class="container1">
        <form action="include/feed.inc.php" name="form" method="POST">
            <fieldset style="color:white" ;>
                <h2>Feedback Form<br><small>Your feedback is appreciated</small></h2>
            </fieldset>







            <fieldset style="color:white;padding:5px" ;>
                <legend for="Number">Commend:</legend>
                <div class="form-group">
                    <input type="text" name="fcommend" class="form-control" size="70%">
                </div>
            </fieldset>
            <div>
                <input type="submit" value="submit" name="submit"><br>
            </div>
        </form>
    </div>




</body>