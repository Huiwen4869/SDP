<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	include ("conn.php");
	
	$uid = $_GET['uid'];
	$action = $_GET['action'];
	
	if(! empty($action))
	{
		switch ($action)
		{
			case "remove";
			
				$cid = intval($_GET['cid']);
				
				mysqli_query($conn, "DELETE from cart WHERE car_id=$cid");
			
			break;
			
			case "empty";
			
				mysqli_query($conn, "DELETE from cart WHERE cus_id=$uid");
				
			break;
		}
		if (mysqli_affected_rows($conn)<=0)
		{
			echo "<script>alert('Unable to delete item!');";
			die ("window.location.href='cart.php?uid=".$uid."';</script>");
		}
	}
	
	mysqli_close($conn);
	echo "<script>window.location.href='cart.php?uid=".$uid."';</script>";
?>
