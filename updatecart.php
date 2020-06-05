<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	include "conn.php";
	
	$uid = $_GET['uid'];
	$cartid = $_POST['carid'];
	$nqty = $_POST['newqty'];
	
	
	$sql = "Update cart SET ".
			"ord_quantity='$nqty', ". 
			"car_addtime='".date("Y-m-d H:i:s")."' WHERE car_id=$cartid";
			
	mysqli_query($conn, $sql);
	
	if(mysqli_affected_rows($conn)<=0)
	{
		echo "<script>alert('Unable to update data!');";
		die("window.history.go(-1);</script>");
	}
	else
	{
		echo ("<script>window.location.href='cart.php?uid=".$uid."';</script>");
	}
	
	mysqli_close($conn);	
?>