<?php
session_start();
include "include/conn.inc.php";
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
	echo ("<script> alert('Pleas log in first!!!'); </script>");
	echo ("<script> window.location.replace('login.php');</script>");
}
$uid = $_SESSION['userid'];



$name=mysqli_real_escape_string($conn,$_POST['cardname']);
$number=mysqli_real_escape_string($conn,$_POST['cardnumber']);
$month=mysqli_real_escape_string($conn,$_POST['expmonth']);
$year=mysqli_real_escape_string($conn,$_POST['expyear']);
$cvv=mysqli_real_escape_string($conn,$_POST['cvv']);

if(empty($name)||empty($number)||empty($month)||empty($year)||empty($cvv)){
	echo ("<script> alert('Please fill in all the field !!!'); </script>");
	echo ("<script> window.location.replace('cart.php');</script>");
}
elseif(!preg_match("/^[a-zA-Z]*$/",$name)){
	echo ("<script> alert('Invalid username'); </script>");
	echo ("<script> window.location.replace('cart.php');</script>");
	exit();
}
elseif(!preg_match("/^[0-9]*$/",$cvv)){
	echo ("<script> alert('Invalid CVV'); </script>");
	echo ("<script> window.location.replace('cart.php');</script>");
	exit();

}
elseif(!preg_match("/^[0-9]*$/",$number)){
	echo ("<script> alert('Invalid Card Number'); </script>");
	echo ("<script> window.location.replace('cart.php');</script>");
	exit();

}
elseif(!preg_match("/^[0-9]*$/",$year)){
	echo ("<script> alert('Invalid Year'); </script>");
	echo ("<script> window.location.replace('cart.php');</script>");
	exit();

}
else{


$sql = "SELECT cart.cus_id,customer.cus_id,customer.cus_address,customer.cus_phone,cart.stk_id,cart.ord_quantity,cart.stk_price,cart.stk_name FROM cart INNER JOIN customer on cart.cus_id=customer.cus_id";

$cart = mysqli_query($conn, $sql);
if (mysqli_num_rows($cart) > 0) {
	while ($row = mysqli_fetch_array($cart)) {
		$sid = $row['stk_id'];
		$cid = $row['cus_id'];
		$qty = $row['ord_quantity'];
		$date = date("Y-m-d H-m-s");
		$price=$row['stk_price'];
		$address=$row['cus_address'];
		$phone=$row['cus_phone'];
		$status="PAID";



		$sql1 = "INSERT INTO orders(stk_id, cus_id, ord_quantity,ord_time,ord_status,ord_price,cus_address,cus_phone) VALUES ('$sid', '$cid', '$qty', '$date','$status','$price','$address','$phone')";

		if (mysqli_query($conn, $sql1)) {
			mysqli_query($conn, "DELETE from cart WHERE cus_id=$uid");
			echo ("<script> alert('Purchase Sucess!!'); </script>");
			echo ("<script> window.location.replace('bought.php');</script>");
			$sql2 = "UPDATE stock SET stk_quantity= stk_quantity - '$qty' WHERE stk_id=$sid"; //update db
			mysqli_query($conn, $sql2);
		} else {
			echo ("<script> alert('wrong!!'); </script>");
		}

	}

}
}