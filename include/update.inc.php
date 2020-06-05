<?php
include "conn.inc.php";
session_start();
 if (isset($_POST['update'])) {
  $sid =mysqli_real_escape_string($conn,$_POST['sid']) ;
  $name =mysqli_real_escape_string($conn, $_POST['sname']) ;
  $category =mysqli_real_escape_string($conn,  $_POST['category']);
  $manufacturer =mysqli_real_escape_string($conn,$_POST['manufacturer']);
  $productiondate = mysqli_real_escape_string($conn,$_POST['pdate']);
  $cost = mysqli_real_escape_string($conn,$_POST['cost']);
  $price = mysqli_real_escape_string($conn,$_POST['price']);
  $width = mysqli_real_escape_string($conn,$_POST['width']);
  $height = mysqli_real_escape_string($conn,$_POST['height']);
  $description = mysqli_real_escape_string($conn,$_POST['descrip']);

  $sql="UPDATE stock SET stk_name = '$name', cat_name = '$category', man_name = '$manufacturer', stk_productiondate = '$productiondate', stk_cost = '$cost', stk_price = '$price' , stk_width = '$width', stk_height = '$height' , stk_description = '$description' WHERE stk_id = $sid";

  if (mysqli_query($conn, $sql)) {
    echo ("<script> alert('Data Updated!!'); </script>");
    echo ("<script> window.location.replace('../stock.php');</script>");
    //echo $sql;
} else {
    echo ("<script> alert('Sorry! something wrong!'); </script>");
   // echo ("<script> window.location.replace('../category.php');</script>");
}

$eid=$_SESSION['eid'];
$date = date("Y-m-d H-m-s");
$name ="Update Stock";
$sql1= "INSERT INTO actions (emp_id, act_date, act_name, stk_id) VALUE ('$eid',' $date','$name','$sid')";
echo $sql1;

if(mysqli_query($conn,$sql1)){
    echo ("<script> alert('Action ADDED!!'); </script>");
    echo ("<script> window.location.replace('../stock.php');</script>");
}
else {
    echo ("<script> alert('SORRY!! SOMETHING WRONG 1'); </script>");
}
  
}

?>