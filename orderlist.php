<?php
include "header.php";
include "include/conn.inc.php";
session_start();
if (isset($_SESSION['loggedin1']) && $_SESSION['loggedin1'] == true) {
    
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
    <title>Order List | Home Furniture</title>
</head>

<body>
    <?php navbar(); ?>
    <div class="arrow">
        <a href="emp-dashboard.php">
            <image src="img\goback.png" style="width:5%;margin-top:2%; margin-left:2%" ; height="6%" />
        </a>
    </div>
   
    <?php
    $sql = "SELECT * FROM orders WHERE ord_status != 'complete' ORDER BY ord_time ASC";
    echo "<h1 style='color:black; margin-left:10%;margin-top:5%'> Order List  </h1>";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0){
            echo "<table class='table' style='margin-left:10%; width:80%;'>";
            echo "<tr class='head'style='margin-left:10%;'>";
            echo "<th> Order ID</th>";
            echo "<th> Customer ID</th>";
            echo "<th> Customer Address</th>";
            echo "<th> Customer Phone</th>";
            echo"<th> Order Quantity</th>";
            echo"<th> Order Price</th>";
            echo"<th> Order Status</th>";
            echo"<th> Order time </th>";
            echo "</tr>";



            while ($row = mysqli_fetch_array($result)) {
                $oid = $row['ord_id'];
                $cid = $row['cus_id'];
                $address=$row['cus_address'];
                $phone=$row['cus_phone'];
                $quantity=$row['ord_quantity'];
                $price=$row['ord_price'];
                $status=$row['ord_status'];
                $time=$row['ord_time'];


                echo "<tr>";
                echo "<form action='include/order.inc.php' method='POST'>";
                echo "<td style='text-align:left'>$oid<input type='number' name='oid' id='oid' value='$oid' hidden></td>";
                echo "<td style='text-align:left'>$cid<input type='number' name='cid' value='$cid' hidden></td>";
                echo "<td style='text-align:left'>$address<input type='text' name='address' id='address' value='$address' hidden></td>";
                echo "<td style='text-align:left'>$phone<input type='text' name='phone' id='phone' value='$phone' hidden></td>";
                echo "<td style='text-align:left'>$quantity<input type='text' name='quantity' id='quantity' value='$quantity' hidden></td>";
                echo "<td style='text-align:left'>RM$price<input type='text' name='price' id='price' value='$price' hidden></td>";
                echo "<td style='text-align:left'><select name='status'>
                            <option value='Paid'>PAID</option>
                            <option value='Shipped'> Shipped</option>
                            <option value='Complete'> Complete</option>
                             </select></td>";
                echo "<td style='text-align:left'>$time<input type='text' name='time' id='time' value='$time' hidden></td>";
                echo "<td style='text-align:left; margin-top:3px;'><input name='update' type='submit' value='Update' /></td>";
  

    
                echo "</tr>";
                echo"</form>";
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