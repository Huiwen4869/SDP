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
<link href="css/style-cart.css" rel="stylesheet" type="text/css" />
<title>Cart | Home Furniture</title>
</head>

<body>
	
	<center>
		<div class="cart-container">
			<h2>Shopping Cart</h2><hr />
							
			<?php
				$uid = $_SESSION['userid'];
				
				$sql = "SELECT c.car_id, c.stk_id, c.stk_name, c.stk_price, s.stk_img, s.stk_quantity, ".
						"c.ord_quantity, c.car_addtime FROM cart c JOIN stock s ".
						"ON c.stk_id = s.stk_id WHERE c.cus_id = '$uid'"; //join table cart and stock.
				$result = mysqli_query($conn, $sql);
				
				if(mysqli_num_rows($result) <= 0)
				{
					echo "<div class='no-item'><h1>No items added to cart</h1><a href='view.php'>Shop for Products Here</a></div>";
				}
				else
				{
					$total_quantity = 0; //set default value to zero
    				$total_price = 0;
			?>
					
						<div class="cart-func">
							<form method="post" action="deletecart?action=empty&uid=<?php echo $uid; ?>">
								<input type="submit" value="empty cart" name="delete"/>
							</form>
						</div>
						
						<table class="tab-cart">
							<tr class="tab-title">
								<th>Name</th>
								<th class="content-width">Quantity</th>
								<th class="content-width">Price / unit ($)</th>
								<th class="content-width">Subtotal ($)</th>
								<th class="content-width">Action</th>
							</tr>
						
			<?php
					while($citem=mysqli_fetch_array($result))
					{						
						$line_cost = $citem['ord_quantity'] * $citem['stk_price']; //calculate line cost of products added by user.
						$pid = $citem['stk_id'];
						$carid = $citem['car_id'];	
			?>
						
							<tr class="content">
								<td>									
									<a href="detail.php?pid=<?php echo $pid; ?>"><img src="<?php echo $citem['stk_img'] ?>" alt="" class="pro-img" /><br />
									<div style="margin-top:7px"><?php echo $citem['stk_name']; ?></div></a>
									<span class="time-text">Modified At:<?php echo $citem['car_addtime']; ?></span>
								</td>
								<td class="inc-dec">
									<form method="post" action="updatecart.php?uid=<?php echo $uid; ?>" id="form-quantity-<?php echo $carid ?>">
										<input type="hidden" name="carid" value="<?php echo $carid; ?>" readonly="readonly" />
										<input type="button" id="downButton" class="btn dec" onClick="downFunction('<?php echo $carid; ?>')" value="-" />
										<input type="number" id="inputField-<?php echo $carid; ?>" value="<?php echo $citem['ord_quantity']; ?>" name="newqty" min="1" max="<?php echo $citem['stk_quantity']; ?>" />
										<input type="button" id="upButton" class="btn inc" onClick="upFunction('<?php echo $citem["car_id"]; ?>')" value="+" />
									</form>
								</td>
								<td style="text-align:right"><?php echo $citem['stk_price']; ?></td>
								<td style="text-align:right"><?php echo number_format($line_cost, 2); ?></td> 
								<td class="dele"><a href='deletecart.php?action=remove&cid=<?php echo $carid; ?>&uid=<?php echo $uid; ?>'><button><i class='fa fa-trash'></i>Remove</button></a></td>
							</tr>
			
			<?php	
						$total_quantity += $citem["ord_quantity"]; //calculate quantity column
						$total_price += ($citem["stk_price"] * $citem["ord_quantity"]); //calculate subtotal column
					}
			?>			
									
							<tr class="content-total">
								<td>Total</td>
								<td style="text-align:center"><?php echo $total_quantity; ?></td>
								<td colspan="2"><?php echo number_format($total_price, 2); ?></td>
								<td class="dele"><a href="checkout.php?value=<?php echo $total_price;?>"><button><i class='fa fa-money'></i>Check Out</button></a></td>
							</tr>
						
						</table>
						
						<script>
							function upFunction(carid) {
								$("#inputField-"+carid)[0].stepUp(); //increase current quantity by 1
  								$('#form-quantity-'+carid).get(0).submit(); //submit form
							}
							
							function downFunction(carid) {
								$("#inputField-"+carid)[0].stepDown(); //decrease current quantity by 1
  								$('#form-quantity-'+carid).get(0).submit();
  							}
						</script>
																
			<?php
				}
			?>					
								
		</div>
	</center>	

</body>

</html>
