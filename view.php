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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link href="https://fonts.googleapis.com/css?family=Cinzel&display=swap" rel="stylesheet" />
<link href="css/style-view.css" rel="stylesheet" type="text/css" />
<title>Products | Home Furniture</title>
</head>

<body style="background: white">

	<center>

		<!-- Use any element to open/show the overlay navigation menu -->
		<div class="cat-btn-container">
			<span onclick="openNav()" class="cat-txt">Category</span>
		</div>

		<?php
		include "conn.php";
		if (!isset($_GET['type'])) {
			if ($result = $conn->query("SELECT stk_id, stk_name, stk_img FROM stock ")) {
				if ($count = $result->num_rows) {
					while ($rows = $result->fetch_object()) {
		?>

						<div class="product-grid">
							<div class="product-grid-content">
								<a href='detail.php?pid=<?php print_r($rows->stk_id); ?>'>
									<img src="<?php print_r($rows->stk_img); ?>" alt="" class="pro-img" /><br />
									<span>
										<?php print_r($rows->stk_name); ?>
									</span>
								</a>

								<div class="product-link">
									<a href='detail.php?pid=<?php print_r($rows->stk_id); ?>'>View More Details&nbsp;<i class="fa fa-angle-right"></i></a>
								</div>
							</div>
						</div>

					<?php
					}
					$result->free();
				}
			}
		} else {
			$category = $_GET['type'];

			if ($result = $conn->query("SELECT stk_id, stk_name, stk_img FROM stock WHERE cat_name = '" . $category . "'")) {
				if ($count = $result->num_rows) {
					while ($rows = $result->fetch_object()) {
					?>

						<div class="product-grid">
							<div class="product-grid-content">
								<a href='detail.php?pid=<?php print_r($rows->stk_id); ?>'>
									<img src="<?php print_r($rows->stk_img); ?>" alt="" class="pro-img" /><br />
									<span>
										<?php print_r($rows->stk_name); ?>
									</span>
								</a>

								<div class="product-link">
									<a href='detail.php?pid=<?php print_r($rows->stk_id); ?>'>View More Details&nbsp;<i class="fa fa-angle-right"></i></a>
								</div>
							</div>
						</div>

		<?php
					}
					$result->free();
				}
			}
		}
		?>

		<!-- The overlay -->
		<div id="myNav" class="overlay">

			<!-- Button to close the overlay navigation -->
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

			<!--Overlay content -->
			<div class="overlay-content">
				<a href="view.php">All</a>
				<a href="view.php?type=sofa">Sofa</a>
				<a href="view.php?type=bed">Bed</a>
				<a href="view.php?type=chair">Chair</a>
				<a href="view.php?type=table">Table</a>
			</div>

		</div>


		<script>
			function openNav() {
				document.getElementById("myNav").style.width = "100%";
			}

			function closeNav() {
				document.getElementById("myNav").style.width = "0%";
			}
		</script>

	</center>

</body>

</html>