<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	include "include/conn.inc.php";
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	} else {
		echo ("<script> alert('Pleas log in first!!!'); </script>");
		echo ("<script> window.location.replace('login.php');</script>");
	}
	
	$uid = $_POST['uid'];
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$address = $_POST['home_address'];
	$gender = $_POST['gender'];
	
	 $sql="Update customer SET ".
	 		"cus_name = '$name',".
	 		"cus_phone = '$phone',".
	 		"cus_email = '$email',".
	 		"cus_address = '$address',".
	 		"cus_gender = '$gender' Where cus_id = $uid";
			
	mysqli_query($conn, $sql);
	
	if(mysqli_affected_rows($conn) <= 0)
	{
		die("<script>alert('Unable to update info!');</script>");
		echo "<script>window.location.href='profile.php?id=$uid';</script>";
	}
	
	mysqli_close($conn);
	
	echo "<script>alert('Data updated succesfully!');</script>";
	echo "<script>window.location.href='profile.php';</script>";
?>	