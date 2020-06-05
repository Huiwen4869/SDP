<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	
	include "include/conn.inc.php";
	$uid = $_SESSION['userid'];
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	} else {
		echo ("<script> alert('Pleas log in first!!!'); </script>");
		echo ("<script> window.location.replace('login.php');</script>");
	}
	//$uid = '7';
	
	$sql = "SELECT * FROM customer WHERE cus_id = '$uid' ";
	$result = mysqli_query ($conn,$sql);
	 
	 while($rows = mysqli_fetch_array($result))
	 {
	 	$check = $rows['cus_password'];
	 	
	 }

	
	$current = $_POST['currentPassword'];
	$new = $_POST['newPassword'];//$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	$confirm = $_POST['confirmPassword'];
	
	if($new !== $confirm)
	{
		echo "<script>alert('Confirmed password is not same! Please try again!');";
		die ("window.history.go(-1);</script>");
	}
	if(password_verify($current, $check) !== true)
		 {
		echo "<script>alert('Current password is incorrect! Please try again!');";
		die ("window.history.go(-1);</script>");

		 }
	$hash = password_hash($new, PASSWORD_DEFAULT);
	$sql1 = "UPDATE customer set cus_password = '$hash' WHERE cus_id = '$uid'";
	mysqli_query($conn, $sql1);
			
if(mysqli_affected_rows($conn) <= 0)
	{
		echo "<script>alert('Failed to change password! Please try again!');";
		die ("window.history.go(-1);</script>");
	}


mysqli_close($conn);

echo "<script>alert('Password changed succesfully!');</script>";
echo "<script>window.location.href='profile.php';</script>";

?>