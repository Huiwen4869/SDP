<?php
include "conn.inc.php";
session_start();
if(isset($_POST['add'])) {
    $id=mysqli_real_escape_string($conn,$_POST['sid']);
    $number=mysqli_real_escape_string($conn,$_POST['number']);
  if(empty($number)){
        echo ("<script> alert('Please Fill in the number!!'); </script>");
    }

    $sql="UPDATE stock SET stk_quantity= stk_quantity + '$number' WHERE stk_id=$id";

    if(mysqli_query($conn,$sql)){
        echo ("<script> alert('Stock ADDED!!'); </script>");
        //echo ("<script> window.location.replace('../addstock.php');</script>");
    }
    else {
        echo ("<script> alert('SORRY!! SOMETHING WRONG'); </script>");
}


$eid=$_SESSION['eid'];
$name="ADD Stock";
$date = date("Y-m-d H:m:s");

$sql1= "INSERT INTO actions(act_name, emp_id, act_date, stk_id) VALUE ('$name','$eid','$date','$id')";
if(mysqli_query($conn,$sql1)){
    
    echo ("<script> alert('Action ADDED!!'); </script>");
    echo ("<script> window.location.replace('../addstock.php');</script>");
}
else {
    echo ("<script> alert('SORRY!! SOMETHING WRONG 1'); </script>");
    echo $sql1;
}
}
    ?>