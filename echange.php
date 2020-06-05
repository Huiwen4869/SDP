<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();

include "include/conn.inc.php";



if (isset($_POST['submit'])) {
	$id = $_SESSION['eid'];
	$sql = "SELECT * FROM employee WHERE emp_id = $id ";
	$result = mysqli_query($conn, $sql);

	while ($rows = mysqli_fetch_array($result)) {
		$check = $rows['emp_password'];
	}


	$current = $_POST['currentPassword'];
	$new = $_POST['newPassword']; //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	$confirm = $_POST['confirmPassword'];

	if ($new !== $confirm) {
		echo "<script>alert('Confirmed password is not same! Please try again!');";
		die("window.history.go(-1);</script>");
	}
	if (password_verify($current, $check) !== true) {
		echo "<script>alert('Current password is incorrect! Please try again!');";
		die("window.history.go(-1);</script>");
	}
	$hash = password_hash($new, PASSWORD_DEFAULT);
	$sql1 = "UPDATE employee set emp_password = '$hash' WHERE emp_id = $id";
	mysqli_query($conn, $sql1);

	if (mysqli_affected_rows($conn) <= 0) {
		echo "<script>alert('Failed to change password! Please try again!');";
		die("window.history.go(-1);</script>");
	}


	mysqli_close($conn);

	echo "<script>alert('Password changed succesfully!');</script>";
	echo "<script>window.location.href='eprofile.php';</script>";
}

if (isset($_POST['submit1'])) {
	$id = mysqli_real_escape_string($conn,$_POST['id']);
	$sql = "SELECT * FROM employee WHERE emp_id = $id ";
	$result = mysqli_query($conn, $sql);

	while ($rows = mysqli_fetch_array($result)) {
		$check = $rows['emp_password'];
	}



	$new = $_POST['newPassword']; //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	$confirm = $_POST['confirmPassword'];

	if ($new !== $confirm) {
		echo "<script>alert('Confirmed password is not same! Please try again!');";
		die("window.history.go(-1);</script>");
	}

	$hash = password_hash($new, PASSWORD_DEFAULT);
	$sql1 = "UPDATE employee set emp_password = '$hash' WHERE emp_id = $id";
	mysqli_query($conn, $sql1);

	if (mysqli_affected_rows($conn) <= 0) {
		echo "<script>alert('Failed to change password! Please try again!');";
		die("window.history.go(-1);</script>");
	}


	mysqli_close($conn);

	echo "<script>alert('Password changed succesfully!');</script>";
	echo "<script>window.location.href='emp-dashboard.php';</script>";
	
}

?>