<?php
	session_start();
	include "include/conn.inc.php";
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
<title>Order Detail</title>
<style>
	.cart-container{
		width: 70%;
		margin-top: 105px;
	}
	
	table.tab-cart{
		width: 100%;
		margin: 40px auto;
		border-collapse: collapse;
		font-size: 18px;
		font-family: 'PT Sans', serif;
		text-align: center;
	}
	
	table.tab-cart tr.tab-title{
		background:#00264d;
		color:#fff;
		margin-left:5px;
	}
		
	table.tab-cart th, td{
		padding: 5px 20px;
	  	border: 1px solid #000;
	}
	
	table.tab-cart td{
		height: 100px;
	}
	
	table.tab-cart th.content-width{
		width: 15%;
	}
		
	table.tab-cart tr.content:hover{
		background: #f2f2f2;
	}
	
	table.tab-cart a,
	.no-item a{
		text-decoration: none;
		color: #000;
	}
	
	table.tab-cart a:visited,
	no-item a:visited{
		text-decoration: none;
	}
	
	table.tab-cart input[type=submit]{
		text-align:center;
		padding-right:0px;
	}
	
	table.tab-cart input[type=submit]{
		margin-top: 5px;
	    width: auto;
	    height: auto;
	    min-width: 90px;
	    cursor: pointer;
	    background: #000;
	    color: #fff;
	    border: 1px #000 solid;
	 	padding: 4px 6px;
	    border-radius: 3px;
	    font-size: 17px;
	}
	
	table.tab-cart td.dele button i{
		margin-right: 4px;
	}
	
	table.tab-cart input[type=submit]:hover{
	    background-color: #e6e6e6;
	    border: 1px #3498db solid;
	    color: #000;
	}
	
	table.tab-cart td.inc-dec input[type=button]{
		padding: 1px 10px;
		display: inline;
		cursor: pointer;
		font-family: 'PT Sans',serif;
		font-size: 17px;
	}
	
	table.tab-cart td.inc-dec{
		text-align: center;
	}
		
	td.inc-dec input[type=number]{
		outline: none;
		font-size: 17px;
		font-family: 'PT Sans',serif;
		text-align: center;
		min-width: 40px;
		margin: 3px auto;
	}
	
	table.tab-cart tr.content-total{
		text-align:right;
		font-weight:bold;
	}
	
	table.tab-cart td span.time-text{
		font-size: 14px;
		color: #737373;
	}
	
	.pro-img{
		max-width: 150px;
		height: auto;
	}
	
	/* Chrome, Safari, Edge, Opera */
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	  -webkit-appearance: none;
	  margin: 0;
	}
	
	/* Firefox */
	input[type=number] {
	  -moz-appearance: textfield;
	}
	
	.cart-func{
		width: 100%;
		height: auto;
		margin: 20px auto;
		padding-bottom: 20px;
	}
	
	.cart-func input[type=submit]{
		outline: none;
		background: transparent;
		font-size: 18px;
		font-family: 'PT Sans', serif;
		float: right;
		padding: 10px;
		color: #e60000;
		border: 1px solid #e60000;
		text-transform: uppercase;
		cursor: pointer;
	}
	
	.no-item{
		font-size: 18px;
		font-family: 'PT Sans', serif;
	}
	
</style>

</head>

<body>
	
	<center>
		<div class="cart-container">
			<h2>Order detail</h2><hr />
			<table class="tab-cart">
				<tr class="tab-title">
					<th colspan="6"><?php echo $_GET['time']; ?></th>
			    </tr>
			    <tr class="tab-title">
			    	<th>QUANTITY</th>
			    	<th>PRODUCT IMG</th>
			    	<th>NAME</th>
			    	<th>PRICE(per unit)</th>
					<th>STATUS</th>
					<th>COMFIRM</th>
			    </tr>
							
			<?php
				$time = $_GET['time'];
				$uid = $_SESSION['userid'];
				$sql = "SELECT o.ord_id,o.stk_id, o.ord_quantity, o.ord_status, s.stk_img, s.stk_name, s.stk_price FROM orders o JOIN stock s ON o.stk_id = s.stk_id WHERE o.cus_id = '$uid' AND o.ord_status!='Complete'";
				//$sql = "SELECT * FROM orders WHERE cus_id = '$uid' GROUP BY ord_time DESC";			
				$result = mysqli_query($conn, $sql);
				
				if(mysqli_num_rows($result) <= 0)
				{
					echo "<div class='no-item'><h1>ERROR</h1></div>";
				}
				else
				{
					while($row=mysqli_fetch_array($result))
					{
						$id=$row['ord_id'];
						$quantity=$row['ord_quantity'];
						$img=$row['stk_img'];
						$name=$row['stk_name'];
						$price=$row['stk_price'];
						$status=$row['ord_status'];

						echo"<form action='include/order.inc.php' method='POST'>";
						echo "<tr>";
						echo "<input type='number' value='$id' name='oid' hidden/>";
						echo "<td>$quantity</td>";
						echo "<td><img src='$img' class='pro-img'></td>";
						echo "<td>$name</td>";
						echo "<td>$price</td>";
						echo "<td>$status</td>";
						echo "<td> <input type='submit' value='Complete' name='complete'/></td>";
						echo "<tr>";
						echo"</form>";
					}
				}

			?>
					
					
						
			</table>			
								
		</div>
	</center>	

</body>

</html>
