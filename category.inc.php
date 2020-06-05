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

    if (isset($_POST['delete'])) {
        
        if ( $_SESSION['role'] == 1) {
        } else {
            echo ("<script> alert('Sorry !!Panda say you are not allowed to delete ! '); </script>");
            echo ("<script> window.location.replace('sad.php');</script>");
        }

        $cid = mysqli_real_escape_string($conn, $_POST['cid']);
        $cname = mysqli_real_escape_string($conn, $_POST['cname']);
        $sql = "DELETE FROM category WHERE cat_id= $cid";
        if (mysqli_query($conn, $sql)) {
            echo ("<script> alert('$cname Deleted!'); </script>");
            echo ("<script> window.location.replace('category.php');</script>");
        } else {
            echo ("<script> alert('Error Occur!'); </script>");
            echo $sql;
        }
        //delete proses
    } elseif (isset($_POST['update'])) {

        $cid = mysqli_real_escape_string($conn, $_POST['cid']);
        $cname = mysqli_real_escape_string($conn, $_POST['cname']);

        echo "<center>";
        echo "<div class='container1' style='right:100%;'>";
        echo "<form method='POST'action='category.inc.php'  style='display:hidden' >";
        echo "<div>";
        echo "<label>Update Category</label>";
        echo "</div>";
        echo "<div>";
        echo "<lable>NAME:</label>";
        echo "</div>";
        echo "<div style='margin-bottom: 10px'>";
        echo "<input type='number' name=id value=$cid hidden>";
        echo "<input type='text'name='name' value=$cname><br><br>";
        echo "</div>";
        echo "<input type='submit' name='submit' value='Update'>";
        echo "</form>";
        echo "</div>";
        echo "</center>";
    }
    if (isset($_POST['submit'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        if (empty($name)) {
            echo ("<script> alert('Please Insert in the input field!'); </script>");
        }
        $sql = "UPDATE category SET cat_name= '$name' WHERE cat_id=$id";
        $sql1="UPDATE stock SET cat_name='$name' WHERE cat_id=$id";

        if (mysqli_query($conn, $sql)) {
            echo ("<script> alert('Data Updated!!'); </script>");
            echo ("<script> window.location.replace('category.php');</script>");
            // echo $sql;
        } else {
            echo ("<script> alert('Sorry! something wrong!'); </script>");
            echo ("<script> window.location.replace('category.php');</script>");
        }
        
        if (mysqli_query($conn, $sql1)) {
            echo ("<script> alert('Data in stock updated!!'); </script>");
            echo ("<script> window.location.replace('category.php');</script>");
            // echo $sql;
        } else {
            echo ("<script> alert('Sorry! something wrong 1!'); </script>");
            echo ("<script> window.location.replace('category.php');</script>");
        }
    }




    $output = '';

    if (isset($_POST['export'])) {
        $sql = "SELECT * FROM category ORDER BY cat_id ASC";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0)
            $output .= '
        <table class="table" >  
        <tr>  
            <th>ID</th>  
            <th>Category Name</th>  

          

        </tr>
       ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
            <tr>  
                <td>' . $row['cat_id'] . '</td>  
                <td>' . $row['cat_name'] . '</td>

  
            </tr>';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=download.xls');
        echo $output;
    }
