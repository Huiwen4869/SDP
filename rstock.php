<?php
include "header.php";
include "include/conn.inc.php";
session_start();
if (isset($_SESSION['loggedin1']) && $_SESSION['loggedin1'] == true &&$_SESSION['role']==1) {
    
} else {
    echo ("<script> alert('Sorry !!Panda say you are not allowed! '); </script>");
    echo ("<script> window.location.replace('sad.php');</script>");}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="css/style-emp-panel.css" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?php cssAndBootstrap(); ?>
    <title>Stock Report | Home Furniture</title>
</head>

<body>
    <?php navbar(); ?>
    <div class="arrow">
        <a href="emp-dashboard.php">
            <image src="img\goback.png" style="width:5%;margin-top:2%; margin-left:2%" ; height="6%" />
        </a>
    </div>
   
    <?php
    $sql = "SELECT * FROM stock ORDER BY stk_id ASC";
    echo "<h1 style='color:black; margin-left:10%;margin-top:5%'> Stock Report </h1>";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            echo "<form action='search.php' method='POST'>";
            echo "<input type='text' name='search' style='float:right;margin-top:-10%;margin-right:30%;'>";
            echo "<input type='submit' name='searchbtn4' value='Search' style='float:right;margin-top:-10%;margin-right:23%;'>";
            echo "</form>";
            echo "<form action='include/export.inc.php' method='POST'>";
            echo"<input type='submit' name='export' value='Export report to Excel' style='float:right;margin-top:-10%;margin-right:5%;'>";
            echo "<table class='table' style='margin-left:10%; width:80%;'>";           
            echo "<tr class='head'style='margin-left:10%;'>";
            echo "<th></th>";
            echo "<th> ID</th>";
            echo "<th> Name</th>";
            echo "<th> Category</th>";
            echo "<th> Manufacturer</th>";
            echo "<th> Purchase Date</th>";
            echo "<th> Purchase Cost</th>";
            echo "<th> Price</th>";
            echo"<th>Width</th>";
            echo"<th>Height</th>";
            echo"<th>Description</th>";
          

            echo "</tr>";



            while ($row = mysqli_fetch_array($result)) {
                $sid = $row['stk_id'];
                $sname = $row['stk_name'];
                $category=$row['cat_name'];
                $manufacturer=$row['man_name'];
                $date=$row['stk_productiondate'];
                $pcost=$row['stk_cost'];
                $price=$row['stk_price'];
                $width=$row['stk_width'];
                $height=$row['stk_height'];
                $description=$row['stk_description'];



                echo "<tr>";
                
                echo "<td style='text-align:left'><ol><li></li></ol></td>";
                echo "<td> <input type='checkbox' name='check'/></td>";
                echo "<td style='text-align:left'>$sname</td>";
                echo "<td style='text-align:left'>$category</td>";
                echo "<td style='text-align:left'>$manufacturer</td>";
                echo "<td style='text-align:left'>$date</td>";
                echo "<td style='text-align:left'>$pcost</td>";
                echo "<td style='text-align:left'>$price</td>";
                echo "<td style='text-align:left'>$width</td>";
                echo "<td style='text-align:left'>$height</td>";
                echo"<td style='text-align:left'>$description</td>";
                echo "<form action='include/cdelete.inc.php'>";
            
                echo "</form>";

                echo "</form>";
                echo "</tr>";
            }
            echo "</table>";
            mysqli_free_result($result);
        } else {
            echo "No result match with the query!!!!";
        }
    } else {
        echo "ERROR !!! Could not execute $sql." . mysqli_error($conn);
    }

    mysqli_close($conn);
    ?>
