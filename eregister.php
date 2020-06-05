<!DOCTYPE html>
<html lang="en">
<?php
	require "include/conn.inc.php";
	session_start();
    if (isset($_SESSION['loggedin1']) && $_SESSION['loggedin1'] == true &&$_SESSION['role']==1) {
        
    } else {
        echo ("<script> alert('Sorry !!Panda say you are not allowed! '); </script>");
        echo ("<script> window.location.replace('sad.php');</script>");}
    ?>

<head>
	<title>HOME FURNITUR EMPLOYEE</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
<div class="arrow">
        <a href="emp-dashboard.php">
            <image src="img\goback.png" style="width:5%;margin-top:2%; margin-left:2%"; height="6%"/>
        </a>
    </div>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Employee Register Form
					</span>
				</div>

				<form class="login100-form validate-form" action="include/eregister.inc.php" method="POST"enctype="multipart/form-data">
					<div class="wrap-input100 validate-input m-b-26" >
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Enter username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-26" >
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Enter email">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" >
						<span class="label-input100">Confirmed Password</span>
						<input class="input100" type="password" name="cpass" placeholder="Confirmed password">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-26">
						<span class="label-input100">Address</span>
						<input class="input100" type="text" name="address" placeholder="Enter address">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-26">
						<span class="label-input100">Phone Number</span>
						<input class="input100" type="text" name="phone" placeholder="Enter phone number">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-26" >
						<span class="label-input100">Gender</span>
						<select name="gender" style="width:100%;">
							<option value="select">Please Select</option>
							<option value="male">Male</option>
							<option value="female">Female</option>

						</select>
						<span class="focus-input100"></span>

					</div>

					<div class="wrap-input100 validate-input m-b-26" >
						<span class="label-input100">Position</span>
						<select name="position" style="width:100%;">
							<option value="select">Please Select</option>
							<option value="manager">Manager</option>
							<option value="employee">Employee</option>

						</select>
						<span class="focus-input100"></span>

					</div>


					<div class="wrap-input100 validate-input m-b-26" >
						<span class="label-input100">Employee Image</span>
						
						<span class="focus-input100"></span>
						<input type="file" name="file" >

					</div>



					

						
						<input type="submit" name="submit" value="Submit">
					
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="js/main.js"></script>

</body>

</html>