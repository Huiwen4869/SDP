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
    <title>New Employee | Home Furniture</title>
</head>

<body>
    <?php navbar(); ?>
    <div class="arrow">
        <a href="emp-dashboard.php">
            <image src="img\goback.png" style="width:5%;margin-top:2%; margin-left:2%" ; height="6%" />
        </a>
    </div>
    <?php
    $sql = "SELECT emp_id,emp_name,emp_phone,emp_address,emp_gender,emp_position FROM employee ";
    echo "<h1 style='color:black; margin-left:10%;margin-top:5%;'> Employee Detail </h1>";

    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
          //  echo "<form action='include/employee.inc.php' method='POST'>";
            echo "<table class='table' style='margin-left:5%'>";
            echo "<tr class='head'>";
            echo "<th>Employee ID</th>";
            echo "<th>Employee Name</th>";
            echo "<th>Phone Number</th>";
            echo "<th>Address</th>";
            echo "<th> Gender</th>";
            echo "<th> Position</th>";
            echo "<th> Edit </th>";
            echo "<th> Delete </th>";
            echo "</tr>";


            while ($row = mysqli_fetch_array($result)) {
                $eid = $row['emp_id'];
                $ename = $row['emp_name'];
                $phone = $row['emp_phone'];
                $address = $row['emp_address'];
                $gender = $row['emp_gender'];
                $position = $row['emp_position'];



                echo "<tr>";
                echo "<form action='eedit.php' method='POST'>";
                echo "<td style='text-align:left'>$eid<input type='number' name='eid' value='$eid' hidden></td>";
                echo "<td style='text-align:left'>$ename<input type'text' name='ename' value='$ename'hidden></td>";
                echo "<td style='text-align:left'>$phone<input type'text' name='phone' value='$phone'hidden></td></td>";
                echo "<td style='text-align:left'>$address<input type'text' name='address' value='$address'hidden></td></td>";
                echo "<td style='text-align:left'>$gender<input type'text' name='gender' value='$gender'hidden></td></td>";
                echo "<td style='text-align:left'>$position<input type'text' name='position' value='$position'hidden></td></td>";
                echo "<td style='text-align:left'><input type='submit' name='edit' value='Edit'></a></td>";
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