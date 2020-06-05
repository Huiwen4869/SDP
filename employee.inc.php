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

    <?php
    include "include/conn.inc.php";

   

    if (isset($_POST['searchbtn'])) {


        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $search = preg_replace("#[^0-9a-z]#i", "", $search);
        //$max_length = 20;
        //if(strlen($search) >= $max_length){
        $search = htmlspecialchars($search);
        $sql = "SELECT * FROM employee WHERE (emp_name LIKE '%" . $search . "%') OR (emp_gender LIKE '%" . $search . "%') OR (emp_position LIKE '%" . $search . "%') OR (emp_id LIKE '%" . $search . "%')";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<form action='employee.inc.php' method='POST'>";
            echo "<div class='arrow'> <a href='remployee.php'> <img src='img\goback.png' style='width:5%; height:6%;margin-top:2%;margin-left:2%;margin-bottom:-10%;'></a></div>;";
            echo "<input type='text' name='search' style='float:right;margin-top:10%;margin-right:30%;'>";
            echo "<input type='submit' name='searchbtn' value='Search' style='float:right;margin-top:10%;margin-right:-20%; margin-left:30%;'>";
            echo "<input type='submit' name='export' value='Export report to Excel' style='float:right;margin-top:10%;margin-right:-50%;'>";
            echo "<table class='table' style='margin-left:10%; width:80%;margin-top:15%;'>";
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
                echo "<td><input type='checkbox' name='check'></td>";
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
    }/*else{
        echo ("<script> alert('SORRY!!!! Maximum length is $max_length'); </script>");
        echo ("<script> window.location.replace('../remployee.php');</script>");
    }*/


    $output = '';

    if (isset($_POST['export'])) {
        $check=mysqli_real_escape_string($conn,$_POST['check']);
        if ($check = ) {
            $sql = "SELECT * FROM employee ORDER BY emp_id ASC";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0)
                $output .= '
        <table class="table" >  
        <tr>  
        <th> ID</th>
        <th> Name</th>
        <th> Email</th>
        <th> Phone Number</th>
        <th> Address</th>
        <th> Gender</th>
        <th> Position</th>

          

        </tr>
       ';
            while ($row = mysqli_fetch_array($result)) {
                $output .= '
            <tr>  
                <td>' . $row['emp_id'] . '</td>  
                <td>' . $row['emp_name'] . '</td>
                <td>' . $row['emp_email'] . '</td>
                <td>' . $row['emp_phone'] . '</td>
                <td>' . $row['emp_address'] . '</td>
                <td>' . $row['emp_gender'] . '</td>
                <td>' . $row['emp_position'] . '</td>
               
            </tr>';
            }
            $output .= '</table>';
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename=download.xls');
            echo $output;
        }
    }
    ?>