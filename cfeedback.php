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
<link rel="stylesheet" href="css/style-feedback.css" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|PT+Sans&display=swap" rel="stylesheet" />
<title>Feedback | Home Furniture</title>
</head>

<body>

	<?php
	 	include "include/conn.inc.php";
	 	
	 	$uid = $_SESSION['userid'];
	 	$uname = $_SESSION['user'];
	 		 	
	 ?>

	<center>
		<div class="fb-box">
			<h1>Comments</h1>
				<?php
					$sql = "SELECT cus_name, fee_comment, fee_time FROM feedback";
	 				$result = mysqli_query($conn, $sql);
	 				
					if(mysqli_num_rows($result)<=0)
				 	{
				 		echo "<p>Empty Comment Section. Be The First To Submit Your Opinion Now</p>";
				 	}
				 	while($rows = mysqli_fetch_array($result))
				 	{ 	
						echo"<div class='fb-container'>";
						echo"<p class='name'>By <span>".$rows['cus_name']."</span></p>";
						echo"<p class='time'>@ ".$rows['fee_time']."</p>";
						echo"<p>".$rows['fee_comment']."</p>";
						echo"</div>";
					}
				?>
		
			<h1 class="write-section">Write A Comment</h1>
			<form action="addfeedback.php?uid=<?php echo $uid; ?>&uname=<?php echo $uname; ?>" method="post" class="fb-form">
	            <textarea name="comment" id="comment" cols="25" rows="10" required="required"></textarea>
				<div>
					<input type="submit" name="submit" value="Submit" />
		            &nbsp;
		            <input type="reset" name="reset" value="Reset" />
				</div>
			</form>
		</div>
	</center>
</body>

</html>
