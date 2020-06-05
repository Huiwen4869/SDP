<?php
include "header.php";
include "include/conn.inc.php"
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="css/style-emp-panel.css" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?php cssAndBootstrap(); ?>
    <title>Stock Category | Home Furniture</title>
</head>

<body>
    <?php navbar(); ?>
    <div class="arrow">
        <a href="emp-dashboard.php">
            <image src="img\goback.png" style="width:5%;margin-top:2%; margin-left:2%" ; height="6%" />
        </a>
    </div>
    
    <?php
    $sql = "SELECT * FROM stock";
    echo "<h1 style='color:black; margin-left:10%;margin-top:5%'> Add Stock </h1>";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            echo "<table class='table' style='margin-left:10%; width:80%;'>";
            echo "<tr class='head'style='margin-left:10%;'>";
            echo "<th> ID</th>";
            echo "<th> Name</th>";
            echo "<th> Quantity</th>";
            echo "<th> Number</th>";
            echo "<th> Add</th>";
            echo "</tr>";



            while ($row = mysqli_fetch_array($result)) {
                $sid = $row['stk_id'];
                $sname = $row['stk_name'];
                $quantity = $row['stk_quantity'];


                echo "<tr>";
                echo "<form action='include/add.inc.php' method='POST'>";
                echo "<td style='text-align:left'>$sid<input type='number' name='sid' value='$sid' hidden></td>";
                echo "<td style='text-align:left'>$sname<input type='text' name='sname' id='sname' value='$sname' hidden></td>";
                echo "<td style='text-align:left'>$quantity<input type='number' name='quantity' id='quantity' value='$quantity' hidden></td>";
                echo "<td><input type='number' name='number' id='number'/></td>";
                echo "<td style='text-align:left; margin-top:3px;'><input type='submit' name='add' value='ADD' /></td>";
  

    
                echo "</tr>";
                echo"</form>";
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
    <script type="text/javascript">
        function confirmDelete() {
            var status = confirm("Are you sure you want to delete ?");
            return status;
        }
    </script>