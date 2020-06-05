<?php
include "header.php";
session_start();
if (isset($_SESSION['loggedin1']) && $_SESSION['loggedin1'] == true) {
} else {
	echo ("<script> alert('Pleas log in first!!!'); </script>");
	echo ("<script> window.location.replace('elogin.php');</script>");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<link rel="stylesheet" href="css/style-emp-panel.css" type="text/css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<?php cssAndBootstrap(); ?>
	<title>Dashboard | Home Furniture</title>
</head>

<body >
	<?php navbar(); ?>


	<?php
	include "include/conn.inc.php";
	$sql2="SELECT count(*) AS total FROM stock WHERE stk_quantity <5";
	$resultStock=mysqli_query($conn,$sql2);
	$dataStk=mysqli_fetch_assoc($resultStock);

	$sql3="SELECT count(*) AS total FROM orders WHERE ord_status!= 'Complete'";
	$resultSales= mysqli_query($conn,$sql3);
	$dataSales=mysqli_fetch_assoc($resultSales);


	$sql4 = "SELECT count(cus_id) AS total FROM customer WHERE MONTH(cus_date)=MONTH(CURRENT_DATE())";
	$resultCus = mysqli_query($conn, $sql4);
	$dataCus = mysqli_fetch_assoc($resultCus);


	$sql5 = "SELECT count(emp_id) AS total FROM employee";
	$resultEmp = mysqli_query($conn, $sql5);
	$dataEmp = mysqli_fetch_assoc($resultEmp);
	?>

	<center>


		<div id="right-panel">
			<div class="grid-emp-panel">
				<div class="grid-emp-content box-1">
					<div class="grid-emp-content-detail">
						<?php echo $dataStk['total']; ?>
						<span class="content-title">Out of Stock</span>
						<span class="glyphicon glyphicon-alert"></span>
						<hr />
						<span class="content-link"><i class="fa fa-arrow-right"></i><a href="outstock.php">More info</a></span>
					</div>
				</div>
				<div class="grid-emp-content box-2">
					<div class="grid-emp-content-detail">
						<?php echo $dataSales['total']; ?>
						<span class="content-title">Deals</span>
						<span class="icon i-1"><i class="fa fa-shopping-bag"></i></span>
						<hr />
						<span class="content-link"><i class="fa fa-arrow-right"></i><a href="orderlist.php">More info</a></span>
					</div>
				</div>
				<div class="grid-emp-content box-3">
					<div class="grid-emp-content-detail">
						<?php echo $dataCus['total']; ?>
						<span class="content-title">New Customer</span>
						<span class="icon i-2"><i class="fa fa-user-plus"></i></span>
						<hr />
						<span class="content-link"><i class="fa fa-arrow-right"></i><a href="ncustomer.php">More info</a></span>
					</div>
				</div>
				<div class="grid-emp-content box-4">
					<div class="grid-emp-content-detail">
						<?php echo $dataEmp['total']; ?>
						<span class="content-title">Total Employee</span>
						<span class="icon i-3"><i class="fa fa-user-plus"></i></span>
						<hr />
						<span class="content-link"><i class="fa fa-arrow-right"></i><a href="nemployee.php">More info</a></span>
					</div>
				</div>
			</div>



			<?php
			$sql = "SELECT actions.act_id,actions.act_name,actions.emp_id,actions.act_date,actions.stk_id,stock.stk_id,stock.stk_name, employee.emp_id, employee.emp_name FROM actions INNER JOIN stock ON actions.stk_id = stock.stk_id INNER JOIN employee ON actions.emp_id = employee.emp_id order by act_date DESC LIMIT 3";
			echo "<h1 style='color:black;float:left; margin-left:5%;margin-top:5%'> Activity Report</h1>";
			if ($result = mysqli_query($conn, $sql)) {
				if (mysqli_num_rows($result) > 0) {

					echo "<table class='tab-result'style='width:100%;'>";
					echo "<tr style='background:#4a5c82;color:#fff'>";
					echo "<th> Action ID</th>";
					echo "<th> Employee ID</th>";
					echo "<th> Employee Name</th>";
					echo "<th> Action Name</th>";
					echo "<th> Stock Name</th>";
					echo "<th> Actoion Date</th>";
					echo "</tr>";

					while ($row = mysqli_fetch_array($result)) {
						$aid = $row['act_id'];
						$eid = $row['emp_id'];
						$ename = $row['emp_name'];
						$aname = $row['act_name'];
						$sname = $row['stk_name'];
						$date = $row['act_date'];

						echo "	<tr class='content'>";
						//echo "<td style='padding-left:0px'><img src=' " . $rows['photo_path'] . " ' style='max-height:140px;max-width:140px'/></td>";
					
						echo "<td>$aid<input type='number' name='aid' value='$aid' hidden></td></td>";
						echo "<td>$eid<input type='number' name='eid' value='$eid' hidden></td>";
						echo "<td>$ename<input type='text' name='ename' id='ename' value='$ename' hidden></td>";
						echo "<td>$aname<input type='text' name='aname' id='aname' value='$aname' hidden></td>";
						echo "<td>$sname<input type='text' name='sname' id='sname' value='$sname' hidden></td>";
						echo "<td>$date<input type='text' name='date' id='date' value='$date' hidden></td>";
						echo "</tr>";

						echo "</form>";
					}
					echo "</table>";
				}
			}




			?>

			<?php
			include "include/conn.inc.php";
			$sql = "SELECT * FROM orders WHERE ord_status!='Complete'";
			echo "<h1 style='color:black; float:left;margin-left:5%;margin-top:5%'> Order List  </h1><br><br><br>";
			if ($result = mysqli_query($conn, $sql)) {
				if (mysqli_num_rows($result) > 0) {
					echo "<table class='tab-result'style='width:100%;'>";
					echo "<tr style='background:#4a5c82;color:#fff'>";
					echo "<th> Order ID</th>";
					echo "<th> Customer ID</th>";
					echo "<th> Customer Address</th>";
					echo "<th> Customer Phone</th>";
					echo "<th> Order Quantity</th>";
					echo "<th> Order Price</th>";
					echo "<th> Order Status</th>";
					echo "<th> Order time </th>";
					echo "</tr>";



					while ($row = mysqli_fetch_array($result)) {
						$oid = $row['ord_id'];
						$cid = $row['cus_id'];
						$address = $row['cus_address'];
						$phone = $row['cus_phone'];
						$quantity = $row['ord_quantity'];
						$price = $row['ord_price'];
						$status = $row['ord_status'];
						$time = $row['ord_time'];


						echo "	<tr class='content'>";
						echo "<form action='include/order.inc.php' method='POST'>";
						echo "<td>$oid<input type='number' name='oid' value='$oid' hidden></td>";
						echo "<td>$cid<input type='number' name='cid' value='$cid' hidden></td>";
						echo "<td>$address<input type='text' name='address' id='address' value='$address' hidden></td>";
						echo "<td>$phone<input type='text' name='phone' id='phone' value='$phone' hidden></td>";
						echo "<td>$quantity<input type='text' name='quantity' id='quantity' value='$quantity' hidden></td>";
						echo "<td>RM$price<input type='text' name='price' id='price' value='$price' hidden></td>";
						echo "<td>$status</td>";
						echo "<td>$time<input type='text' name='time' id='time' value='$time' hidden></td>";




						echo "</tr>";
					}
					echo "</table>";
					mysqli_free_result($result);
				} else {
					echo "No result match with the query!!!!";
				}
			} else {
				echo "ERROR !!! Could not execute $sql." . mysqli_error($conn);
			}

			mysqli_close($conn);
			?>



			</table>



		</div>



	</center>


</body>

</html>