<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

include "conn.php";

$target_dir = "img/";

$target_file = $target_dir.basename($_FILES["photo"]["name"]);

$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

$check = getimagesize($_FILES["photo"]["tmp_name"]);
if($check !== false)
{
	echo"<script>alert('File is an image - " .$check["mime"]. ".');</script>";
}
else
{
	echo"<script>alert('File is not an image. Please try again!');</script>";
	die("<script>window.history.go(-1);</script>");
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif")
{
	echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.Please try again!');</script>";
	die("<script>window.history.go(-1);</script>");
}

if(!move_uploaded_file($_FILES["photo"]["tmp_name"],$target_file))
{
	echo "<script>alert('Unable to upload photo.Please try again!');</script>";
	die("<script>window.history.go(-1);</script>");
}




$uid = $_POST['uid'];
$sql = "UPDATE customer SET cus_img = '$target_file' Where cus_id = $uid ";

if(!mysqli_query($conn,$sql))
	{
	die('Error:'.mysqli_error($conn));
	}
	
echo '<script>alert("Profile picture uploaded!");
window.location.href = "profile.php";
</script>';

mysqli_close($conn);
?>
	
