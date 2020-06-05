<?php
	session_start();
	include "cheader.php";
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	} else {
		echo ("<script> alert('Pleas log in first!!!'); </script>");
		echo ("<script> window.location.replace('login.php');</script>");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="css/style-cprofile.css" rel="stylesheet" type="text/css" />
<title>Profile | Home Furniture</title>
<script type="text/javascript">
	// When the user clicks on div, open the popup
		function myFunction1() {
		 var popup = document.getElementById("myPopup");
		popup.classList.toggle("show");
		}
	// Get the modal
	var modal = document.getElementById('id001');
	
	var modal = document.getElementById('id002');
	
	var modal = document.getElementById('id003');
	
	
	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	  if (event.target == modal) {
	    modal.style.display = "none";
	  }
	}
</script>
</head>

<body>
	<?php 
	
		include "include/conn.inc.php";
		
		$uid = $_SESSION['userid'];
		
		$sql = "SELECT * FROM customer WHERE cus_id = '$uid' ";
		$result = mysqli_query ($conn,$sql);
		
		while($rows = mysqli_fetch_array($result))
		{
		$id = $rows['cus_id'];
		$uname = $rows['cus_name'];
		$phone = $rows['cus_phone'];
		$email = $rows['cus_email'];
		$address = $rows['cus_address'];
		$gender = $rows['cus_gender'];
		$photo = $rows['cus_img'];
	
	}
	?>


	<h2 class="profile-title">my profile</h2>
	<center>
		<div class="ctn">
			<div class="card">	
				<img src="<?php echo $photo; ?>" style="width:94%;max-height:400px;margin:8px 8px 0px 8px" alt="" />
				<h1><?php echo $uname; ?></h1>
				<p class="title"><?php echo "(".$gender.")"; ?></p>
				<a onclick="document.getElementById('id001').style.display='block'"><button>Edit password</button></a> 
				<a onclick="document.getElementById('id002').style.display='block'"><button>Change profile picture</button></a>
			</div>
			
			<div id="id001" class="modal">
				<form method="post" action="password.php" class="modal-content pro-form" style="text-align:left;">
					<span onclick="document.getElementById('id001').style.display='none'" class="close" title="Close Modal">&times;</span>
					<div class="content">
						<br/><h3>CHANGE PASSWORD</h3><br/>
							
							Current Password:<br/>
							<input type="password" name="currentPassword" required/><br/>	
														
							New Password:<br/>
							<input type="password" name="newPassword" required/><br/>
							
							Confirm Password:<br/>
							<input type="password" name="confirmPassword" required/><br/><br/>
							
							<input type="submit" value="Change Password"/>
					</div>						
				</form>
			</div>
		
		
			<div id="id002" class="modal">					
				<form method="post" action="upimg.php" enctype="multipart/form-data" style="text-align:left;" class="modal-content pro-form" style="text-align:left;">
					<span onclick="document.getElementById('id002').style.display='none'" class="close" title="Close Modal">&times;</span>							
					<div class="content">
						<p hidden><input type="text" value="<?php echo $id; ?>" name="uid" /></p>
						<br/>	
						<h3>Photo upload:</h3><br/>
						<input type="file" name="photo" id="photo"  />
						<br/><br/>
						<input type="submit" value="Upload"/>
					</div>	
				</form>		     												
			</div>
		
		
			<div class="detail">
				<center>
					<form class="pro-form">
						<table style="text-align:left;margin-left:20px">		
							<tr>
								<th width="200px">ID</th>
								<td>
									<input type="text" value="<?php echo $id; ?>" name="uid" readonly="readonly"/>
								</td>
							</tr>
							
							<tr>
								<th>Name:</th>
								<td width="300px">
									<input type="text" name="name" value="<?php echo $uname?>" readonly/>
								</td>
							</tr>
							
							<tr>
								<th>Phone Number:</th>
								<td>
									<input type="text" name="phone" value="<?php echo $phone?>" readonly />
								</td>
							</tr>
							
							<tr>
								<th>Email Address:</th>
								<td>
									<input type="email" name="email" value="<?php echo $email?>" readonly />
								</td>
							</tr>
							
							<tr>
								<th>Home Address:</th>
								<td>
									<textarea name="home_address" readonly class="wt-resize"><?php echo $address?></textarea>
								</td>
							</tr>
							
							
							<tr>
								<th>Gender:</th>
								<td>
									<input type="text" name="gender" value="<?php echo $gender?>" readonly />
								</td>
							</tr>
							
							<tr>
								<td colspan="2">
								<br/>
								<center></center>
								</td>
							</tr>
						</table>
					</form>
				
					<a onclick="document.getElementById('id003').style.display='block'"><button>Edit information</button></a>
					
					<div id="id003" class="modal">
						<form method="post" action="proupdate.php" class="pro-form">
							<span onclick="document.getElementById('id003').style.display='none'" class="close" title="Close Modal">&times;</span>							
							<p hidden><input type="text" value="<?php echo $id; ?>" name="uid" /></p>
							<table style="text-align:left">					
								<tr>
									<th>Name:</th>
									<td width="300px">
										<input type="text" name="name" value="<?php echo $uname?>" required/>
									</td>
								</tr>
								
								<tr>
									<th>Phone Number:</th>
									<td>
										<input type="text" name="phone" value="<?php echo $phone?>" required />
									</td>
								</tr>
								
								<tr>
									<th>Email Address:</th>
									<td>
										<input type="email" name="email" value="<?php echo $email?>" required />
									</td>
								</tr>
								
								<tr>
									<th>Home Address:</th>
									<td>
										<textarea name="home_address" required class="wt-resize"><?php echo $address?></textarea>
									</td>
								</tr>
								
								
								<tr>
									<th>Gender:</th>
									<td>
										<input type="radio" name="gender" value="Male" <?php if($gender == "Male") echo "checked='checked'";?>/>Male
										<input type="radio" name="gender" value="Female" <?php if($gender == "Female") echo "checked='checked'";?>/>Female
									</td>
								</tr>			
								<tr>
									<td colspan="2">
										<br/>
										<center>
											<input type="submit" value="Change"/>&nbsp; &nbsp;
										</center>
									</td>
								</tr>
							</table>
						</form>
					</div>
				</center>
			</div>
		</div>
	</center>
</body>
</html>
