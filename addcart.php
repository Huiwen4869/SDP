<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

include "include/conn.inc.php";
session_start();
$uid = $_SESSION['userid'];

if (isset($_POST['add'])) {


	$addqty = mysqli_real_escape_string($conn, $_POST['quantity']);
	$pname = mysqli_real_escape_string($conn, $_POST['pname']);
	$pprice = mysqli_real_escape_string($conn, $_POST['pprice']);
	$pro_id = mysqli_real_escape_string($conn, $_POST['id']);
	$date = date("Y-m-d H:i:s");

	$check2 = mysqli_query($conn, "SELECT * FROM cart WHERE cus_id = '$uid' AND stk_id = '$pro_id'"); //check if the product added to cart already exist in database
	$checkexist = mysqli_num_rows($check2);

	if ($checkexist > 0) {
		$qty_query = $check2;

		while ($rows = mysqli_fetch_array($qty_query)) {
			$curqty = $rows['ord_quantity'];
			$carid = $rows['car_id'];
			$newqty = $addqty + $curqty; //sum up new qty to current qty

			$sql = "UPDATE cart SET ord_quantity='$newqty',car_addtime='$date' WHERE car_id=$carid "; //update db

			mysqli_query($conn, $sql);
			echo ("<script> alert('Stock added sucessfully'); </script>");
			echo ("<script> window.location.replace('view.php');</script>");
			exit();
		}
	} else {
		$sql1 = "SELECT stk_name FROM stock WHERE stk_name=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql1)) {
			echo ("<script> alert('SQL error 1'); </script>");
			exit();
		} else {
			$sql = "INSERT INTO cart(stk_id, cus_id, stk_name, ord_quantity, stk_price, car_addtime) VALUES (?,?,?,?,?,?)";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				echo ("<script> alert('SQL error 2'); </script>");

				exit();
			} else {
				mysqli_stmt_bind_param($stmt, "iissss", $pro_id, $uid, $pname, $addqty, $pprice, $date);
				mysqli_stmt_execute($stmt);
				echo ("<script> alert('Stock added sucessfully'); </script>");
				echo ("<script> window.location.replace('view.php');</script>");
				exit();
			}

			//insert new data
		}
	}
} else {
	echo ("<script> window.location.replace('view.php');</script>");
}

?>