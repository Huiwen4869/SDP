<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	
	include "conn.php";
	
	$uid = $_GET['uid']; 
	$uname = $_GET['uname'];
		
	if(isset($_POST['submit']))
	{
		$com = $_POST['comment'];
		
		if(empty($com))
		{
			echo ("<script> alert('Unable to submit blank form'); </script>");
		}
		else
		{
			$sql = "INSERT INTO feedback(cus_id, cus_name, fee_comment, fee_time) VALUES 
			('$uid','$uname','$com', '".date("Y-m-d H:i:s")."')"; 
		}
		
		if(!mysqli_query($conn,$sql))
		{
			die('Error:'.mysqli_error($conn));
		}
		
		echo '<script>alert("Dear Customer, Thank You For The Feedback Submission. \nYour Comments Suggestions Would Be Greatly Appreciated!");
		window.location.href="cfeedback.php";</script>';
	}

?>