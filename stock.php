<?php
include "header.php";
include "include/conn.inc.php";
session_start();
if (isset($_SESSION['loggedin1']) && $_SESSION['loggedin1'] == true) {
} else {
    echo ("<script> alert('Sorry !!Panda say you are not allowed! '); </script>");
    echo ("<script> window.location.replace('sad.php');</script>");
}
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
    <title>Stock List | Home Furniture</title>
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
    echo "<h1 style='color:black; margin-left:10%;margin-top:5%'> Stock List </h1>";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {

            echo "<table class='table' style='margin-left:10%; width:80%;'>";
            echo "<tr class='head'style='margin-left:10%;'>";
            echo "<th> ID</th>";
            echo "<th> Name</th>";
            echo "<th> Category</th>";
            echo "<th> Manufacturer</th>";
            echo "<th> Purchase Date</th>";
            echo "<th> Purchase Cost</th>";
            echo "<th> Price</th>";
            echo "<th>Width</th>";
            echo "<th>Height</th>";
            echo "<th>Description</th>";
            echo "<th> Edit</th>";
            echo "<th> Delete</th>";
            echo "<th> Quantity</th>";


            echo "</tr>";



            while ($row = mysqli_fetch_array($result)) {
                $sid = $row['stk_id'];
                $sname = $row['stk_name'];
                $category = $row['cat_name'];
                $manufacturer = $row['man_name'];
                $date = $row['stk_productiondate'];
                $pcost = $row['stk_cost'];
                $price = $row['stk_price'];
                $width = $row['stk_width'];
                $height = $row['stk_height'];
                $description = $row['stk_description'];
                $quantity = $row['stk_quantity'];



                echo "<tr>";
                echo "<form action='stock.inc.php' method='POST'>";
                echo "<td style='text-align:left'>$sid<input type='number' name='sid' id='sid' value='$sid' hidden></td>";
                echo "<td style='text-align:left'>$sname<input type='number' name='sname' value='$sname' hidden></td>";
                echo "<td style='text-align:left'>$category</td>";
                echo "<td style='text-align:left'>$manufacturer</td>";
                echo "<td style='text-align:left'>$date</td>";
                echo "<td style='text-align:left'>$pcost</td>";
                echo "<td style='text-align:left'>$price</td>";
                echo "<td style='text-align:left'>$width</td>";
                echo "<td style='text-align:left'>$height</td>";
                echo "<td style='text-align:left'>$description</td>";
                echo "<td style='text-align:left'>$quantity</td>";
                echo "<td style='text-align:left; margin-top:3px;'><input name='update' type='submit' value='Update' /></td>";
                echo "<td style='text-align:left; padding-inline:unset'><input type='submit' name='delete' onClick='javascript:confirmDelete();' value='Delete'/></td>";

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

    <script type="text/javascript">
        function confirmDelete() {
            var status = confirm("Are you sure you want to delete ?");
            return status;
        }
    </script>