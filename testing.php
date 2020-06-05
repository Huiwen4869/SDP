<?php
include "cheader.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link href="https://fonts.googleapis.com/css?family=Cinzel&display=swap" rel="stylesheet" />
	<title>Products | Home Furniture</title>
	<style>
		/*category-btn*/
		.cat-btn-container {
			margin-top: 82px;
			height: 60px;
			border-bottom: 1px solid grey;
			padding-top: 40px;
			text-align: right;
			padding-right: 40px;
		}

		.cat-txt {
			border-radius: 20px;
			border: 1px solid #e6e6e6;
			background: #e6e6e6;
			width: 100px;
			padding: 7px 10px;
			height: 50px;
			font-size: 18px;
			font-family: sans-serif;
			font-weight: bold;
		}

		.cat-txt:hover {
			background: #cccccc;
			cursor: pointer;
		}

		/*product-grid*/
		.product-grid img {
			margin: 7px auto;
			height: 310px;
			width: 310px;
			transition: transform .2s;
		}

		.pro-img:hover {
			-ms-transform: scale(1.05);
			/* IE 9 */
			-webkit-transform: scale(1.05);
			/* Safari 3-8 */
			transform: scale(1.05);
		}

		.product-grid {
			display: inline-block;
			font-family: sans-serif;
			font-size: 25px;
			margin-top: 40px;
		}

		.product-grid-content {
			display: grid;
			grid-auto-flow: dense;
			grid-template-columns: repeat(auto-fill, min(420px));
			grid-auto-rows: minmax(100px, auto);
			grid-gap: 10px;
			outline-color: none;
		}

		.product-grid-content a {
			text-decoration: none;
			color: black;
		}

		.product-grid-content a span {
			letter-spacing: 0.1em;
			font-weight: 100;
			font-family: 'Cinzel', serif;
		}

		.product-grid-content a:hover {}

		.product-link {
			margin-top: 15px;
		}

		.product-link a {
			border: 0.5px solid black;
			padding: 10px;
			font-size: 16px;

		}

		.product-link a:hover {
			color: white;
			background: black;
			border: 0.5px solid white;
			text-decoration: none;
		}

		/* The Overlay (background) */
		.overlay {
			/* Height & width depends on how you want to reveal the overlay (see JS below) */
			height: 100%;
			width: 0;
			position: fixed;
			/* Stay in place */
			z-index: 1;
			/* Sit on top */
			left: 0;
			top: 0;
			background-color: rgb(0, 0, 0);
			/* Black fallback color */
			background-color: rgba(0, 0, 0, 0.9);
			/* Black w/opacity */
			overflow-x: hidden;
			/* Disable horizontal scroll */
			transition: 0.5s;
			/* 0.5 second transition effect to slide in or slide down the overlay (height or width, depending on reveal) */
		}

		/* Position the content inside the overlay */
		.overlay-content {
			position: relative;
			top: 25%;
			/* 25% from the top */
			width: 100%;
			/* 100% width */
			text-align: center;
			/* Centered text/links */
			margin-top: 30px;
			/* 30px top margin to avoid conflict with the close button on smaller screens */
		}

		/* The navigation links inside the overlay */
		.overlay a {
			padding: 8px;
			text-decoration: none;
			font-size: 36px;
			color: #818181;
			display: block;
			/* Display block instead of inline */
			transition: 0.3s;
			/* Transition effects on hover (color) */
		}

		/* When you mouse over the navigation links, change their color */
		.overlay a:hover,
		.overlay a:focus {
			color: #f1f1f1;
		}

		/* Position the close button (top right corner) */
		.overlay .closebtn {
			position: absolute;
			top: 20px;
			right: 45px;
			font-size: 60px;
		}

		/* When the height of the screen is less than 450 pixels, change the font-size of the links and position the close button again, so they don't overlap */
		@media screen and (max-height: 450px) {
			.overlay a {
				font-size: 20px
			}

			.overlay .closebtn {
				font-size: 40px;
				top: 15px;
				right: 35px;
			}
		}
	</style>
</head>

<body style="background: white">

	<center>

		<!-- Use any element to open/show the overlay navigation menu -->
		<div class="cat-btn-container">
			<span onclick="openNav()" class="cat-txt">Category</span>
		</div>

		<?php
		include "conn.php";
		$img_src="upload/".$img;
		if (!isset($_GET['type'])) {
			if ($result = $conn->query("SELECT stk_id, stk_name, stk_img FROM stock ")) {
				if ($count = $result->num_rows) {
					while ($rows = $result->fetch_object()) {
		?>

						<div class="product-grid">
							<div class="product-grid-content">
								<a href='detail.php?id=<?php print_r($rows->stk_id); ?>'>
									<img src="<?php print_r($rows->stk_img); ?>" alt="" class="pro-img" /><br />
									<span>
										<?php print_r($rows->stk_name); ?>
									</span>
								</a>

								<div class="product-link">
									<a href='detail.php?id=<?php print_r($rows->stk_id); ?>'>View More Details&nbsp;<i class="fa fa-angle-right"></i></a>
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
								<a href='detail.php?id=<?php print_r($rows->stk_id); ?>'>
									<img src="<?php print_r($rows->stk_img); ?>" alt="" class="pro-img" /><br />
									<span>
										<?php print_r($rows->stk_name); ?>
									</span>
								</a>

								<div class="product-link">
									<a href='detail.php?id=<?php print_r($rows->stk_id); ?>'>View More Details&nbsp;<i class="fa fa-angle-right"></i></a>
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