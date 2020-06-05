<?php
include "header.php";
session_start();
if (isset($_SESSION['loggedin1']) && $_SESSION['loggedin1'] == true) {
} else {
	echo ("<script> alert('Pleas log in first!!!'); </script>");
	echo ("<script> window.location.replace('elogin.php');</script>");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<link rel="stylesheet" href="css/style-emp-panel.css" type="text/css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<?php cssAndBootstrap(); ?>
	<title>Out of stock | Home Furniture</title>
</head>

<body>
	<?php navbar(); ?>
    <div class="arrow">
        <a href="emp-dashboard.php">
            <image src="img\goback.png" style="width:5%;margin-top:2%; margin-left:2%" ; height="6%" />
        </a>
    </div>


    <?php
        include "include/conn.inc.php";
        $sql="SELECT stock.stk_id,stock.stk_name,stock.stk_quantity,stock.man_name,manufacturer.man_name,manufacturer.man_phone,manufacturer.man_email,stock.cat_name,category.cat_name,stock.stk_cost, stock.stk_quantity FROM stock INNER JOIN manufacturer ON stock.man_name=manufacturer.man_name INNER join category on stock.cat_name=category.cat_name WHERE stock.stk_quantity <10";
        echo "<h1 style='color:black; margin-left:10%;margin-top:5%'> Out of stock</h1>";
        if ($result = mysqli_query($conn, $sql)) {
            if (mysqli_num_rows($result) > 0) {
            echo "<table class='table' style='margin-left:10%; width:80%;'>";           
            echo "<tr class='head'style='margin-left:10%;'>";
            echo "<th> ID</th>";
            echo "<th> Name</th>";
            echo "<th> Category</th>";
            echo "<th> Manufacturer</th>";
            echo "<th> Manufacturer Phone</th>";
            echo "<th> Manufacturer Email</th>";
            echo "<th> Purchase Cost</th>";
            echo"<th>Total Number</th>";
          

            echo "</tr>";



            while ($row = mysqli_fetch_array($result)) {
                $sid = $row['stk_id'];
                $sname = $row['stk_name'];
                $category=$row['cat_name'];
                $manufacturer=$row['man_name'];
                $phone=$row['man_phone'];
                $email=$row['man_email'];
                $cost=$row['stk_cost'];
                $quantity=$row['stk_quantity'];




                echo "<tr>";
                
                echo "<td style='text-align:left'>$sid</td>";
                echo "<td style='text-align:left'>$sname</td>";
                echo "<td style='text-align:left'>$category</td>";
                echo "<td style='text-align:left'>$manufacturer</td>";
                echo "<td style='text-align:left'>$phone</td>";
                echo "<td style='text-align:left'>$email</td>";
                echo "<td style='text-align:left'>$cost</td>";
                echo "<td style='text-align:left'>$quantity</td>";
        

                echo "</form>";
                echo "</tr>";
            }
            echo "</table>";
            mysqli_free_result($result);
        } else {
            echo "No product is lesser than 10";
        }
    } else {
        echo "ERROR !!! Could not execute $sql." . mysqli_error($conn);
    }

    mysqli_close($conn);
    ?>
    