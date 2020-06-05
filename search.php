<?php
include "header.php";
include "include/conn.inc.php";
session_start();
if (isset($_SESSION['loggedin1']) && $_SESSION['loggedin1'] == true && $_SESSION['role'] == 1) {
} else {
    echo ("<script> alert('Sorry !!Panda say you are not allowed! '); </script>");
    echo ("<script> window.location.replace('sad.php');</script>");
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
    <title> Report | Home Furniture</title>
</head>

<body>
    <?php navbar(); ?>

    <?php

    if (isset($_POST['searchbtn'])) {


        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $search = preg_replace("#[^0-9a-zA-Z]#i", "", $search);
        //$max_length = 20;
        //if(strlen($search) >= $max_length){
        $search = htmlspecialchars($search);
        $sql = "SELECT * FROM employee WHERE (emp_name LIKE '%" . $search . "%') OR (emp_gender LIKE '%" . $search . "%') OR (emp_position LIKE '%" . $search . "%') OR (emp_id LIKE '%" . $search . "%')";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

            echo "<form action='search.php' method='POST'>";
            echo "<div class='arrow'> <a href='remployee.php'> <img src='img\goback.png' style='width:5%; height:6%;margin-top:2%;margin-left:2%;margin-bottom:-10%;'></a></div>;";
            echo "<input type='text' name='search' style='float:right;margin-top:10%;margin-right:30%;'>";
            echo "<input type='submit' name='searchbtn' value='Search' style='float:right;margin-top:10%;margin-right:-20%;'>";
            echo "</form>";
            echo "<form action='employee.inc.php' method='POST'>";
            echo "<input type='submit' name='export' value='Export report to Excel' style='float:right;margin-top:-6.5%;margin-right:8%;'>";
            echo "<h1 style='color:black; margin-left:10%;margin-top:15%'> Employee Report</h1>";
            echo "<table class='table' style='margin-top:50;margin-left:10%; width:80%;'>";
            echo "<tr class='head'style='margin-left:10%;'>";
            echo "<th></th>";
            echo "<th> ID</th>";
            echo "<th> Name</th>";
            echo "<th> Email</th>";
            echo "<th> Phone Number</th>";
            echo "<th> Address</th>";
            echo "<th> Gender</th>";
            echo "<th> Position</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_array($result)) {
                $eid = $row['emp_id'];
                $ename = $row['emp_name'];
                $email = $row['emp_email'];
                $phone = $row['emp_phone'];
                $address = $row['emp_address'];
                $gender = $row['emp_gender'];
                $position = $row['emp_position'];





                echo "<tr>";
                echo "<td> <input type='checkbox' name='check'/></td>";
                echo "<td style='text-align:left;'>$eid<input type='number' name='eid' value='$eid' hidden></td>";
                echo "<td style='text-align:left;'>$ename<input type='text' name='ename' id='ename' value='$ename' hidden></td>";
                echo "<td style='text-align:left;'>$email<input type='text' name='email' id='email' value='$email' hidden></td>";
                echo "<td style='text-align:left;'>$phone<input type='text' name='phone' id='phone' value='$phone' hidden></td>";
                echo "<td style='text-align:left;'>$address<input type='text' name='address' id='address' value='$address' hidden></td>";
                echo "<td style='text-align:left;'>$gender<input type='text' name='gender' id='gender' value='$gender' hidden></td>";
                echo "<td style='text-align:left;'>$position<input type='text' name='position' id='position' value='$position' hidden></td>";

                echo "</tr>";
            }
        } else {
            echo ("<script> alert('No Result!!!!'); </script>");
            echo ("<script> window.location.replace('remployee.php');</script>");
        }
    }

    if (isset($_POST['searchbtn1'])) {


        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $search = preg_replace("#[^0-9a-zA-Z]#i", "", $search);
        //$max_length = 20;
        //if(strlen($search) >= $max_length){
        $search = htmlspecialchars($search);
        $sql = "SELECT * FROM category WHERE (cat_name LIKE '%" . $search . "%')";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

            echo "<form action='search.php' method='POST'>";
            echo "<div class='arrow'> <a href='rcategory.php'> <img src='img\goback.png' style='width:5%; height:6%;margin-top:2%;margin-left:2%;margin-bottom:3%;'></a></div>;";
            echo "<input type='text' name='search' style='float:right;margin-top:3%;margin-right:30%;'>";
            echo "<input type='submit' name='searchbtn' value='Search' style='float:right;margin-top:3%;margin-right:-20%;'>";
            echo "</form>";
            echo "<form action='category.inc.php' method='POST'>";
            echo "<input type='submit' name='export' value='Export report to Excel' style='float:right;margin-top:-4%;margin-right:3%;'>";
            echo "<h1 style='color:black; margin-left:10%;margin-top:5%'> Category Report</h1>";
            echo "<table class='table' style='margin-left:10%; width:80%;'>";
            echo "<tr class='head'style='margin-left:10%;'>";
            echo "<th></th>";
            echo "<th> ID</th>";
            echo "<th> Name</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_array($result)) {
                $cid = $row['cat_id'];
                $cname = $row['cat_name'];





                echo "<tr>";
                echo "<td> <input type='checkbox' name='check'/></td>";
                echo "<td style='text-align:left'>$cid<input type='number' name='cid' value='$cid' hidden></td>";
                echo "<td style='text-align:left'>$cname<input type='text' name='cname' id='cname' value='$cname' hidden></td>";
                echo "</form>";
                echo "</tr>";
            }
        } else {
            echo ("<script> alert('No Result!!!!'); </script>");
            echo ("<script> window.location.replace('rcategory.php');</script>");
        }
    }



    if (isset($_POST['searchbtn2'])) {


        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $search = preg_replace("#[^0-9a-z]#i", "", $search);
        //$max_length = 20;
        //if(strlen($search) >= $max_length){
        $search = htmlspecialchars($search);
        $sql = "SELECT * FROM manufacturer WHERE (man_name LIKE '%" . $search . "%') OR (man_email LIKE '%" . $search . "%') OR (man_phone LIKE '%" . $search . "%')";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

            echo "<form action='search.php' method='POST'>";
            echo "<div class='arrow'> <a href='rmanufacturer.php'> <img src='img\goback.png' style='width:5%; height:6%;margin-top:2%;margin-left:2%;margin-bottom:1%;'></a></div>;";
            echo "<input type='text' name='search' style='float:right;margin-top:3%;margin-right:30%;'>";
            echo "<input type='submit' name='searchbtn' value='Search' style='float:right;margin-top:3%;margin-right:-20%;'>";
            echo "</form>";
            echo "<form action='include/manufacturer.inc.php' method='POST'>";
            echo "<input type='submit' name='export' value='Export report to Excel' style='float:right;margin-top:-4%;margin-right:5%;'>";
            echo "<h1 style='color:black; margin-left:10%;margin-top:5%'> Manufacturer Report</h1>";
            echo "<table class='table' style='margin-left:10%; width:80%;'>";
            echo "<tr class='head'style='margin-left:10%;'>";
            echo "<th> ID</th>";
            echo "<th> Name</th>";
            echo "<th> Phone Number</th>";
            echo "<th> Email</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_array($result)) {
                $mid = $row['man_id'];
                $mname = $row['man_name'];
                $phone = $row['man_phone'];
                $email = $row['man_email'];





                echo "<tr>";
                echo "<td> <input type='checkbox' name='check'/></td>";
                echo "<td style='text-align:left'>$mid<input type='number' name='mid' value='$mid' hidden></td>";
                echo "<td style='text-align:left'>$mname<input type='text' name='mname' id='mname' value='$mname' hidden></td>";
                echo "<td style='text-align:left'>$phone<input type='text' name='phone' id='phone' value='$phone' hidden></td>";
                echo "<td style='text-align:left'>$email<input type='text' name='email' id='email' value='$email' hidden></td>";

                echo "</tr>";
            }
        } else {
            echo ("<script> alert('No Result!!!!'); </script>");
            echo ("<script> window.location.replace('rmanufacturer.php');</script>");
        }
    }




    if (isset($_POST['searchbtn3'])) {


        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $search = preg_replace("#[^0-9a-z]#i", "", $search);
        //$max_length = 20;
        //if(strlen($search) >= $max_length){
        $search = htmlspecialchars($search);
        $sql = "SELECT * FROM feedback WHERE (fee_comment LIKE '%" . $search . "%') OR (cus_name LIKE '%" . $search . "%') OR (cus_id LIKE '%" . $search . "%')";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

            echo "<form action='search.php' method='POST'>";
            echo "<div class='arrow'> <a href='rfeed.php'> <img src='img\goback.png' style='width:5%; height:6%;margin-top:2%;margin-left:2%;margin-bottom:1%;'></a></div>;";
            echo "<input type='text' name='search' style='float:right;margin-top:2%;margin-right:30%;'>";
            echo "<input type='submit' name='searchbtn' value='Search' style='float:right;margin-top:2%;margin-right:-20%;'>";
            echo "</form>";
            echo "<form action='include/feed.inc.php' method='POST'>";
            echo "<input type='submit' name='export' value='Export report to Excel' style='float:right;margin-top:-4%;margin-right:5%;'>";
            echo "<h1 style='color:black; margin-left:10%;margin-top:5%'> Feedback Report</h1>";
            echo "<table class='table' style='margin-left:10%; width:80%;'>";
            echo "<tr class='head'style='margin-left:10%;'>";
            echo "<th> ID</th>";
            echo "<th> Name</th>";
            echo "<th> Comment</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_array($result)) {
                $fid = $row['fee_id'];
                $cname = $row['cus_name'];
                $comment = $row['fee_comment'];





                echo "<tr>";
                echo "<td> <input type='checkbox' name='check'/></td>";
                echo "<td style='text-align:left'>$fid<input type='number' name='fid' value='$fid' hidden></td>";
                echo "<td style='text-align:left'>$cname<input type='text' name='cname' id='cname' value='$cname' hidden></td>";
                echo "<td style='text-align:left'>$comment<input type='text' name='comment' id='comment' value='$comment' hidden></td>";

                echo "</tr>";
            }
        } else {
            echo ("<script> alert('No Result!!!!'); </script>");
            echo ("<script> window.location.replace('rfeed.php');</script>");
        }
    }



    if (isset($_POST['searchbtn4'])) {


        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $search = preg_replace("#[^0-9a-zA-Z]#i", "", $search);
        //$max_length = 20;
        //if(strlen($search) >= $max_length){
        $search = htmlspecialchars($search);
        $sql = "SELECT * FROM stock WHERE (stk_name LIKE '%" . $search . "%') OR (man_name LIKE '%" . $search . "%') OR (cat_name LIKE '%" . $search . "%')";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

            echo "<form action='search.php' method='POST'>";
            echo "<div class='arrow'> <a href='rstock.php'> <img src='img\goback.png' style='width:5%; height:6%;margin-top:2%;margin-left:2%;margin-bottom:1%;'></a></div>;";
            echo "<input type='text' name='search' style='float:right;margin-top:2.5%;margin-right:30%;'>";
            echo "<input type='submit' name='searchbtn' value='Search' style='float:right;margin-top:2.5%;margin-right:-20%;'>";
            echo "</form>";
            echo "<form action='include/update.inc.php' method='POST'>";
            echo "<input type='submit' name='export' value='Export report to Excel' style='float:right;margin-top:-4%;margin-right:5%;'>";
            echo "<h1 style='color:black; margin-left:10%;margin-top:5%'> Stock Report</h1>";
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





                echo "<tr>";
                echo "<td> <input type='checkbox' name='check'/></td>";
                echo "<td style='text-align:left'>$sid</td>";
                echo "<td style='text-align:left'>$sname</td>";
                echo "<td style='text-align:left'>$category</td>";
                echo "<td style='text-align:left'>$manufacturer</td>";
                echo "<td style='text-align:left'>$date</td>";
                echo "<td style='text-align:left'>$pcost</td>";
                echo "<td style='text-align:left'>$price</td>";
                echo "<td style='text-align:left'>$width</td>";
                echo "<td style='text-align:left'>$height</td>";
                echo "<td style='text-align:left'>$description</td>";

                echo "</tr>";
            }
        } else {
            echo ("<script> alert('No Result!!!!'); </script>");
            echo ("<script> window.location.replace('rstock.php');</script>");
        }
    }


    if (isset($_POST['searchbtn5'])) {


        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $search = preg_replace("#[^0-9a-zA-Z]#i", "", $search);
 
        $search = htmlspecialchars($search);
        $sql = "SELECT actions.act_id,actions.act_name,actions.emp_id,actions.act_date,actions.stk_id,stock.stk_id,stock.stk_name, employee.emp_id, employee.emp_name FROM actions INNER JOIN stock ON actions.stk_id = stock.stk_id INNER JOIN employee ON actions.emp_id = employee.emp_id WHERE (act_name LIKE '%" . $search . "%') OR (emp_name LIKE '%" . $search . "%')";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

            echo "<form action='search.php' method='POST'>";
            echo "<div class='arrow'> <a href='ractions.php'> <img src='img\goback.png' style='width:5%; height:6%;margin-top:2%;margin-left:2%;margin-bottom:1%;'></a></div>;";
            echo "<input type='text' name='search' style='float:right;margin-top:3%;margin-right:30%;'>";
            echo "<input type='submit' name='searchbtn' value='Search' style='float:right;margin-top:3%;margin-right:-20%;'>";
            echo "</form>";
            echo "<form action='include/activity.inc.php' method='POST'>";
            echo "<input type='submit' name='export' value='Export report to Excel' style='float:right;margin-top:-4%;margin-right:5%;'>";
            echo "<h1 style='color:black; margin-left:10%;margin-top:5%'> Activity Report</h1>";
            echo "<table class='table' style='margin-left:10%; width:80%;'>";
            echo "<tr class='head'style='margin-left:10%;'>";
            echo "<th></th>";
            echo "<th> Action ID</th>";
            echo "<th> Employee ID</th>";
            echo "<th> Employee Name</th>";
            echo "<th> Action Name</th>";
            echo "<th> Stock Name</th>";
            echo "<th> Actoion Date</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_array($result)) {
                $aid = $row['act_id'];
                $eid = $row['emp_id'];
                $ename = $row['emp_name'];
                $aname = $row['act_name'];
                $sname = $row['stk_name'];
                $date = $row['act_date'];




                echo "<tr>";
         
                echo "<td><input type='checkbox' name='check'onClick='checkbox();'></td>";
                echo "<td>$aid<input type='number' name='aid' value='$aid' hidden></td></td>";
                echo "<td>$eid<input type='number' name='eid' value='$eid' hidden></td>";
                echo "<td>$ename<input type='text' name='ename' id='ename' value='$ename' hidden></td>";
                echo "<td>$aname<input type='text' name='aname' id='aname' value='$aname' hidden></td>";
                echo "<td>$sname<input type='text' name='sname' id='sname' value='$sname' hidden></td>";
                echo "<td>$date<input type='text' name='date' id='date' value='$date' hidden></td>";
                echo "</tr>";
                echo "</form>";
            }
        } else {
            echo ("<script> alert('No Result!!!!'); </script>");
            //echo $sql;
            echo ("<script> window.location.replace('ractivity.php');</script>");
        }
    }

    if (isset($_POST['searchbtn6'])) {


        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $search = preg_replace("#[^0-9a-zA-Z]#i", "", $search);
        //$max_length = 20;
        //if(strlen($search) >= $max_length){
        $search = htmlspecialchars($search);
        $sql = "SELECT * FROM orders WHERE (ord_id LIKE '%" . $search . "%') OR (ord_price LIKE '%" . $search . "%') OR (ord_status LIKE '%" . $search . "%') OR (ord_quantity LIKE '%" . $search . "%')";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

            echo "<form action='search.php' method='POST'>";
            echo "<div class='arrow'> <a href='rorders.php'> <img src='img\goback.png' style='width:5%; height:6%;margin-top:2%;margin-left:2%;margin-bottom:-10%;'></a></div>;";
            echo "<input type='text' name='search' style='float:right;margin-top:10%;margin-right:30%;'>";
            echo "<input type='submit' name='searchbtn' value='Search' style='float:right;margin-top:10%;margin-right:-20%;'>";
            echo "</form>";
            echo "<form action='include/employee.inc.php' method='POST'>";
            echo "<input type='submit' name='export' value='Export report to Excel' style='float:right;margin-top:-6.5%;margin-right:8%;'>";
            echo "<h1 style='color:black; margin-left:10%;margin-top:15%'> Order Report</h1>";
            echo "<table class='table' style='margin-left:10%; width:80%;'>";
            echo "<tr class='head'style='margin-left:10%;'>";
            echo "<th></th>";
            echo "<th> Order ID</th>";
            echo "<th> Customer ID</th>";
            echo "<th> Customer Address</th>";
            echo "<th> Customer Phone</th>";
            echo "<th> Order Quantity</th>";
            echo "<th> Order Price</th>";
            echo "<th> Order Status</th>";
            echo "<th> Order time </th>";
            echo "</tr>";
            while ($row = mysqli_fetch_array($result)) {
                $oid = $row['ord_id'];
                $cid = $row['cus_id'];
                $address = $row['cus_address'];
                $phone = $row['cus_phone'];
                $quantity = $row['ord_quantity'];
                $price = $row['ord_price'];
                $status = $row['ord_status'];
                $time = $row['ord_time'];





                echo "<tr>";
                echo "<td><input type='checkbox' name='check'onClick='javascript:checkbox();'></td>";
                echo "<td style='text-align:left'>$oid<input type='number' name='oid' value='$oid' hidden></td>";
                echo "<td style='text-align:left'>$cid<input type='number' name='cid' value='$cid' hidden></td>";
                echo "<td style='text-align:left'>$address<input type='text' name='address' id='address' value='$address' hidden></td>";
                echo "<td style='text-align:left'>$phone<input type='text' name='phone' id='phone' value='$phone' hidden></td>";
                echo "<td style='text-align:left'>$quantity<input type='text' name='quantity' id='quantity' value='$quantity' hidden></td>";
                echo "<td style='text-align:left'>RM$price<input type='text' name='price' id='price' value='$price' hidden></td>";
                echo "<td style='text-align:left'>$status</td>";
                echo "<td style='text-align:left'>$time<input type='text' name='time' id='time' value='$time' hidden></td>";




                echo "</tr>";
            }
        } else {
            echo ("<script> alert('No Result!!!!'); </script>");
            echo ("<script> window.location.replace('rorders.php');</script>");
        }
    }

    if (isset($_POST['searchbtn7'])) {


        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $search = preg_replace("#[^0-9a-zA-Z]#i", "", $search);
        //$max_length = 20;
        //if(strlen($search) >= $max_length){
        $search = htmlspecialchars($search);
        $sql = "SELECT * FROM customer WHERE (cus_name LIKE '%" . $search . "%') OR (cus_email LIKE '%" . $search . "%') OR (cus_phone LIKE '%" . $search . "%') OR (cus_address LIKE '%" . $search . "%')";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

            echo "<form action='search.php' method='POST'>";
            echo "<div class='arrow'> <a href='rcustomer.php'> <img src='img\goback.png' style='width:5%; height:6%;margin-top:2%;margin-left:2%;margin-bottom:-10%;'></a></div>;";
            echo "<input type='text' name='search' style='float:right;margin-top:10%;margin-right:30%;'>";
            echo "<input type='submit' name='searchbtn' value='Search' style='float:right;margin-top:10%;margin-right:-20%;'>";
            echo "</form>";
            echo "<form action='include/customer.inc.php' method='POST'>";
            echo "<input type='submit' name='export' value='Export report to Excel' style='float:right;margin-top:-6.5%;margin-right:8%;'>";
            echo "<h1 style='color:black; margin-left:10%;margin-top:15%'> Order Report</h1>";
            echo "<table class='table' style='margin-left:10%; width:80%;'>";
            echo "<tr class='head'style='margin-left:10%;'>";
            echo "<th></th>";
            echo "<th>Customer ID</th>";
            echo "<th>Customer Name</th>";
            echo "<th>Email</th>";
            echo "<th>Address</th>";
            echo "<th>Phone Number</th>";
            echo "<th>Gender</th>";
            echo "<th>Register Date</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_array($result)) {
                $cid = $row['cus_id'];
                $cname = $row['cus_name'];
                $email = $row['cus_email'];
                $address = $row['cus_address'];
                $phone = $row['cus_phone'];
                $gender = $row['cus_gender'];
                $date = $row['cus_date'];





                echo "<tr>";
                echo "<td><input type='checkbox' name='check'onClick='javascript:checkbox();'></td>";
                echo "<td style='text-align:left'>$cid</td>";
                echo "<td style='text-align:left'>$cname</td>";
                echo "<td style='text-align:left'>$email</td>";
                echo "<td style='text-align:left'>$address</td>";
                echo "<td style='text-align:left'>$phone</td>";
                echo "<td style='text-align:left'>$gender</td>";
                echo "<td style='text-align:left'>$date</td>";
                echo "</form>";



                echo "</tr>";
            }
        } else {
            echo ("<script> alert('No Result!!!!'); </script>");
            echo ("<script> window.location.replace('rcustomer.php');</script>");
        }
    }

    ?>