<?php
include "header.php";
include "include/conn.inc.php";
session_start();
if (isset($_SESSION['loggedin1']) && $_SESSION['loggedin1'] == true &&$_SESSION['role']==1) {
    
} else {
    echo ("<script> alert('Sorry !!Panda say you are not allowed! '); </script>");
    echo ("<script> window.location.replace('sad.php');</script>");}
    
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
<title>Employee Report | Home Furniture</title>
</head>

<body>
    <?php navbar();?>
    <div class="arrow">
        <a href="emp-dashboard.php">
            <image src="img\goback.png" style="width:5%;margin-top:2%; margin-left:2%"; height="6%"/>
        </a>
    </div>

    <?php

			$sql = "SELECT actions.act_id,actions.act_name,actions.emp_id,actions.act_date,actions.stk_id,stock.stk_id,stock.stk_name, employee.emp_id, employee.emp_name FROM actions INNER JOIN stock ON actions.stk_id = stock.stk_id INNER JOIN employee ON actions.emp_id = employee.emp_id ";
			echo "<h1 style='color:black; margin-left:10%;margin-top:5%'> Activity Report</h1>";
			if ($result = mysqli_query($conn, $sql)) {
				if (mysqli_num_rows($result) > 0) {
					
                    echo "<form action='search.php' method='POST'>";
                    echo "<input type='text' name='search' style='float:right;margin-top:-10%;margin-right:30%;'>";
                    echo "<input type='submit' name='searchbtn5' value='Search' style='float:right;margin-top:-10%;margin-right:23%;'>";
                    echo"</form>";
                    echo "<form action='include/activity.inc.php' method='POST'>";
                    echo "<input type='submit' name='export' id='export' value='Export report to Excel' style='float:right;margin-top:-10%;margin-right:5%;'>";
                    echo "<table class='table' id='report' style='margin-left:10%; width:80%;'>";
                    echo "<tr class='head'style='margin-left:10%;'>";
                    echo "<th></th>";
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
                        $date=$row['act_date'];

						echo "<tr class='content'>";
                        //echo "<td style='padding-left:0px'><img src=' " . $rows['photo_path'] . " ' style='max-height:140px;max-width:140px'/></td>";
                        echo "<td><input type='checkbox' name='check'onClick='checkbox();'></td>";
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