<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	$conn = mysqli_connect("localhost","root","","sdp");	
	
	//Check connection
	if(mysqli_connect_errno())
	{
		echo"Failed to connect to MySQL:".mysqli_connect_error();
	}
?>