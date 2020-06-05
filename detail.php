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
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|PT+Sans&display=swap" rel="stylesheet" />
<link href="css/style-detail.css" rel="stylesheet" type="text/css" />
<title>Product Details | Home Furniture</title>
</head>

<body style="background:white">

	<?php
	include "conn.php";

	$uid = $_SESSION['userid'];

	$pid = $_GET['pid'];
	$sql = "Select * from stock where stk_id = '" . $pid . "'"; //add a new sql query
	$result = mysqli_query($conn, $sql); //run the sql query and all the data store in variable result

	if (mysqli_num_rows($result) <= 0) //if no result, then run the die() code
	{
		die("<script>alert('No data from database!');</script>");
	}

	//if got result, extract the data in $row[] array (column by column)
	while ($rows = mysqli_fetch_array($result)) {

		$img = $rows['stk_img'];
		$name = $rows['stk_name'];
		$pri = $rows['stk_price'];
		$cat = $rows['cat_name'];
		$man = $rows['man_name'];
		$des = $rows['stk_description'];
		$pro = $rows['stk_productiondate'];
		$height = $rows['stk_height'];
		$width = $rows['stk_width'];
		$qty = $rows['stk_quantity'];
	}
	$img_src = "upload/" . $img;

	?>

	<center>
		<h1>detail</h1>
	</center>

	<form action="addcart.php" method="POST">
		<div class="profile">
			<div class="row">
				<div class="leftcolumn">
					<div class="card" style="text-align:center;">
						<div class="img"><img src="<?php echo $img; ?>" alt="" style="height:382px; width:325px" /></div>
						<br />
						<input type="hidden" value="<?php echo $pid; ?>" readonly="readonly" name="id" />
					</div>


					<div class="card cart-action">
						<input type="number" class="product-quantity" name="quantity" value="1" min="1" max="<?php echo $qty; ?>" required="required" />&nbsp;unit
						<input type="submit" value="Add to Cart" class="button" name="add" />
					</div>
				</div>

				<div class="rightcolumn">
					<div class="card">
						<div class="responsive-form clearfix">

							<div class="item-name">
								<input type="text" name="pname" value="<?php echo $name; ?>" />
								<span>Stock Left&nbsp;:&nbsp;<input type="text" name="sqty" value="<?php echo $qty; ?>" readonly="readonly" /></span>
							</div>


							<div class="line1"></div>
							<br />

							<div class="form-row">
								<label>Price:</label>&nbsp;
								<input class="uname" name="pprice" value="<?php echo $pri; ?>" readonly="readonly" />
							</div>

							<br />

							<div class="form-row">
								<div class="column-half">
									<label>Size:</label>
									<input type="text" name="psize" value="<?php echo $width . 'x' . $height; ?>" readonly />
								</div>

								<div class="column-half">
									<label>Category:</label>
									<input type="text" name="pcat" value="<?php echo $cat; ?>" readonly />
								</div>
							</div>

							<div class="form-row">
								<div class="column-half">
									<label>Manufacturer:</label>
									<input type="text" name="pman" value="<?php echo $man; ?>" readonly />
								</div>

								<div class="column-half">
									<label>Production Date:</label>
									<input type="text" name="ppro-date" value="<?php echo $pro; ?>" readonly />
								</div>
							</div>

							<div class="form-row">
								<div class="column-full">
									<label>Description:</label>
									<textarea name="pdes" readonly><?php echo $des; ?></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>

</body>

</html>