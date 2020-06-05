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
		width: 60%;
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
	
	table.tab-cart td.dele{
		text-align:center;
		padding-right:0px;
	}
	
	table.tab-cart td.dele button{
		margin-top: 5px;
	    width: auto;
	    height: auto;
	    min-width: 90px;
	    cursor: pointer;
	    background: #000;
	    color: #fff;
	    border: 1px #000 solid;
	    margin-right: 17px;
	    padding: 4px 6px;
	    border-radius: 3px;
	    font-size: 17px;
	}
	
	table.tab-cart td.dele button i{
		margin-right: 4px;
	}
	
	table.tab-cart td.dele button:hover{
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

		max-width: 90px;
		height: auto;
		float:left;
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
			<h2>Purchased</h2><hr />
			<table class="tab-cart">
				<tr class="tab-title">
					<th>Order</th>
			    </tr>
							
			<?php
				$uid = $_SESSION['userid'];
				
				$sql = "SELECT * FROM orders WHERE cus_id = '$uid' AND ord_status!='Complete' GROUP BY ord_time DESC";			
				$result = mysqli_query($conn, $sql);
				
				if(mysqli_num_rows($result) <= 0)
				{
					echo ("<script> alert('Sorry no item purchased!!!'); </script>");
					echo ("<script> window.location.replace('cart.php');</script>");
					//echo "<div class='no-item'><h1>No items purchased</h1><a href='cart.php'>Go to your cart here</a></div>";
				}
				else
				{
					while($rows=mysqli_fetch_array($result))
					{
					echo "<tr>";
					echo "<td><a href='ordetail.php?time=".$rows['ord_time']."'>".$rows['ord_time']."</a></td>";
					echo "<tr>";
					}
				}

			?>
					
							
						
			</table>			
								
		</div>
	</center>	

</body>

</html>
