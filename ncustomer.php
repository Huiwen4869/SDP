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
<title>New Customer | Home Furniture</title>
</head>

<body>
    <?php navbar();?>

    <div class="arrow">
        <a href="emp-dashboard.php">
            <image src="img\goback.png" style="width:5%;margin-top:2%; margin-left:2%"; height="6%"/>
        </a>
    </div>

    <?php

    $sql="SELECT * FROM customer WHERE MONTH(cus_date)=MONTH(CURRENT_DATE())";
    echo"<h1 style='color:black; margin-left:10%;margin-top:5%;'> Customer Detail </h1>";


    if($result=mysqli_query($conn,$sql)){
        if(mysqli_num_rows($result)>0){
            echo "<table class='table' style='margin-left:5%;'>";
               echo"<tr class='head'>";
               echo"<th>Customer ID</th>";
               echo"<th>Customer Name</th>";
               echo"<th>Email</th>";
               echo"<th>Address</th>";
               echo"<th>Phone Number</th>";
               echo"<th>Gender</th>";
               echo"<th>Register Date</th>";
               echo"</tr>";


               while($row=mysqli_fetch_array($result)){
                $cid=$row['cus_id'];
                $cname=$row['cus_name'];
                $email=$row['cus_email'];
                $address=$row['cus_address'];
                $phone=$row['cus_phone'];
                $gender=$row['cus_gender'];
                $date=$row['cus_date'];



                   echo"<tr>";
                   echo"<form action='include/signup.inc.php' method='POST'>";
                   echo"<td style='text-align:left'>$cid</td>";
                   echo"<td style='text-align:left'>$cname</td>";
                   echo"<td style='text-align:left'>$email</td>";
                   echo"<td style='text-align:left'>$address</td>";
                   echo"<td style='text-align:left'>$phone</td>";
                   echo"<td style='text-align:left'>$gender</td>";
                   echo"<td style='text-align:left'>$date</td>";
                   echo"</form>";
                   echo"</tr>";
               }
               echo"</table>";
               mysqli_free_result($result);
        }else{
            echo"No result match with the query!!!!";
        }
       }else{
           echo "ERROR !!! Could not execute $sql.".mysqli_error($conn);
        }

        mysqli_close($conn);
    

    ?>