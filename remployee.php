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
    <title>Employee Report | Home Furniture</title>
</head>

<body>
    <?php navbar(); ?>
    <div class="arrow">
        <a href="emp-dashboard.php">
            <image src="img\goback.png" style="width:5%;margin-top:2%; margin-left:2%" ; height="6%" />
        </a>
    </div>
   
    <?php
    $sql = "SELECT * FROM employee";
    echo "<h1 style='color:black; margin-left:10%;margin-top:5%'> Employee Report</h1>";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            echo "<form action='search.php' method='POST'>";
            echo "<input type='text' name='search' style='float:right;margin-top:-10%;margin-right:30%;'>";
            echo "<input type='submit' name='searchbtn' value='Search' style='float:right;margin-top:-10%;margin-right:23%;'>";
            ECHO "</form>";
            echo "<form action='include/employee.inc.php' method='POST'>";
            echo"<input type='submit' name='export' value='Export report to Excel' style='float:right;margin-top:-10%;margin-right:5%;'>";
            echo "<table class='table' style='margin-left:10%; width:80%;'>";
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
                echo "<td><input type='checkbox' name='check'onClick='javascript:checkbox();'></td>";
                echo "<td style='text-align:left'>$eid<input type='number' name='eid' value='$eid' hidden></td>";
                echo "<td style='text-align:left'>$ename<input type='text' name='ename' id='ename' value='$ename' hidden></td>";
                echo "<td style='text-align:left'>$email<input type='text' name='email' id='email' value='$email' hidden></td>";
                echo "<td style='text-align:left'>$phone<input type='text' name='phone' id='phone' value='$phone' hidden></td>";
                echo "<td style='text-align:left'>$address<input type='text' name='address' id='address' value='$address' hidden></td>";
                echo "<td style='text-align:left'>$gender<input type='text' name='gender' id='gender' value='$gender' hidden></td>";
                echo "<td style='text-align:left'>$position<input type='text' name='position' id='position' value='$position' hidden></td>";
             
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
        function checkbox() {
            var check = document.getElementById($eid);
            
        }
    </script>

