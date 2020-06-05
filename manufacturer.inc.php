<?php
include "header.php";
include "include/conn.inc.php";
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title> Edit Category</title>
    <link rel="stylesheet" href="css/asset.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|PT+Sans&display=swap" rel="stylesheet">
    <?php cssAndBootstrap(); ?>
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


    if (isset($_POST['delete'])) {
        if ($_SESSION['role'] == 1) {
        } else {
            echo ("<script> alert('Sorry !!Panda say you are not allowed to delete ! '); </script>");
            echo ("<script> window.location.replace('../sad.php');</script>");
        }
        $mid = mysqli_real_escape_string($conn, $_POST['mid']);
        $mname = mysqli_real_escape_string($conn, $_POST['mname']);

        $sql = "DELETE FROM manufacturer WHERE man_id=$mid";

        if (mysqli_query($conn, $sql)) {
            echo ("<script> alert('$mname Deleted!'); </script>");
            echo ("<script> window.location.replace('manufacturer.php');</script>");
        } else {
            echo ("<script> alert('Sorry! Error Occur!'); </script>");
            echo ("<script> window.location.replace('manufacturer.php');</script>");
        }
    } elseif (isset($_POST['update'])) {
        $mid = mysqli_real_escape_string($conn, $_POST['mid']);
        $mname = mysqli_real_escape_string($conn, $_POST['mname']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        echo "<div class='arrow'";
        echo "<center>";

        echo "<div class='container1' >";
        echo "<h1>Update Manufacturer</h1>";
        echo "<form method='POST'action='manufacturer.inc.php'>";
        echo "<input type='number' name=id value=$mid hidden>";
        echo "<div>";
        echo "<lable>NAME:</label>";
        echo "</div>";
        echo "<div class='fld'>";
        echo "<input type='text'name='name' value=$mname>";
        echo "</div>";
        echo "<div style='padding:20px'>";
        echo "<lable>PHONE NUMBER:</label>";
        echo "</div>";
        echo "<div class='fld'>";
        echo "<input type='text' name='phone' value=$phone><br><br>";
        echo "</div>";
        echo "<div style='padding:20px'>";
        echo "<lable>EMAIL:</label>";
        echo "</div>";
        echo "<div class='fld'>";
        echo "<input type='text' name='email' value=$email><br><br>";
        echo "</div>";
        echo "<input type='submit' name='submit' value='Update'>";


        echo "</form>";
        echo "</div>";
        echo "</center>";
    }
    if (isset($_POST['submit'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        if (empty($name) || empty($phone) || empty($email)) {
            echo ("<script> alert('Please Insert in the input field!'); </script>");
            echo ("<script> window.location.replace('manufacturer.php');</script>");
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo ("<script> alert('Invalid email'); </script>");
            echo ("<script> window.location.replace('manufacturer.php');</script>");
            exit();
        } elseif (!filter_var($phone, FILTER_SANITIZE_NUMBER_INT) && !preg_match("/^[0-9]*$/", $phone)) {
            echo ("<script> alert('Invalid phone number'); </script>");
            echo ("<script> window.location.replace('manufacturer.php');</script>");
            exit();
        }

        $sql = "UPDATE manufacturer SET man_name='$name',man_phone='$phone',man_email='$email'WHERE man_id=$id";
        $sql1 = "UPDATE stock SET man_name='$name' WHERE man_id=$id";
    

        if (mysqli_query($conn, $sql)) {
            echo ("<script> alert('Data Updated!!'); </script>");
            //echo ("<script> window.location.replace('manufacturer.php');</script>");
        } else {
            echo ("<script> alert('Sorry! something wrong!'); </script>");
            echo ("<script> window.location.replace('manufacturer.php');</script>");
        }
        
        if (mysqli_query($conn, $sql1)) {
            echo ("<script> alert('Data in stock updated!!'); </script>");
            echo ("<script> window.location.replace('manufacturer.php');</script>");
        } else {
            echo ("<script> alert('Sorry! something wrong 1!'); </script>");
            echo ("<script> window.location.replace('manufacturer.php');</script>");
           
        }
    }

    $output = '';

    if (isset($_POST['export'])) {
        $sql = "SELECT * FROM manufacturer ORDER BY man_id ASC";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0)
            $output .= '
        <table class="table" >  
        <tr>  
            <th>ID</th>  
            <th>Manufacturer Name</th>  
            <th>Phone Number</th>
            <th>Email</th>
          

        </tr>
       ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
            <tr>  
                <td>' . $row['man_id'] . '</td>  
                <td>' . $row['man_name'] . '</td>
                <td>' . $row['man_phone'] . '</td>  
                <td>' . $row['man_email'] . '</td>  
  
            </tr>';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=download.xls');
        echo $output;
    }

    ?>