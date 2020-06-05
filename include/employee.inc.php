<?php

include "conn.inc.php";
session_start();
if (isset($_SESSION['loggedin1']) && $_SESSION['loggedin1'] == true && $_SESSION['role'] == 1) {
} else {
    echo ("<script> alert('Sorry !!Panda say you are not allowed! '); </script>");
    echo ("<script> window.location.replace('sad.php');</script>");
}
?>


    <?php
    include "conn.inc.php";

    if (isset($_POST['delete'])) {
        $eid = mysqli_real_escape_string($conn, $_POST['eid']);
        $ename = mysqli_real_escape_string($conn, $_POST['ename']);
        $sql = "DELETE FROM employee WHERE emp_id= $eid";
        if (mysqli_query($conn, $sql)) {
            echo ("<script> alert('$ename Deleted!'); </script>");
            echo ("<script> window.location.replace('../nemployee.php');</script>");
        } else {
            echo ("<script> alert('Error Occur!'); </script>");
            echo $sql;
        }
    } elseif (isset($_POST['edit'])) {
     
        $eid = mysqli_real_escape_string($conn, $_POST['eid']);
        $ename = mysqli_real_escape_string($conn, $_POST['ename']);

        echo "<div class='arrow'";
        echo "<form method='POST'action='employee.inc.php'>";
        $sql = "SELECT* FROM employee WHERE emp_id=$eid";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $email = $row['emp_email'];
                $phone = $row['emp_phone'];
                $address = $row['emp_address'];
                $gender = $row['emp_gender'];
                $posistion = $row['emp_position'];
                $img = $row['emp_img'];
                $img_src = "../eimg/" . $img;

                echo "<h2 class='profile-title'> My Profile</h2>";
                echo "<center>";
                echo "<div class='card'>";
                echo "<img src='$img_src' style='width:50%;height:50%;'>";
                echo "<h3>$ename</h3>";

                echo "<form method='POST' action=''>";

                echo "</form>";
                echo "</div>";


                echo "<div class='detail'>";
                echo "<center>";
                echo "<form class='pro-form' action='employee.inc.php' method='POST'>";
                echo "<table style='text-align:left'>";

                echo "<tr>";
                echo "<th style='width:200px'>ID: </th>";
                echo "<td><input type='text' value='$eid' name='id'></td>";
                echo "</tr>";


                echo "<tr>";
                echo "<th style='width:200px'>NAME: </th>";
                echo "<td><input type='text' value='$ename' name='name'style='border:1px solid black'></td>";
                echo "</tr>";


                echo "<tr>";
                echo "<th style='width:200px'>PHONE NUMBER: </th>";
                echo "<td><input type='text' value='$phone' name='phone' style='border:1px solid black'></td>";
                echo "</tr>";


                echo "<tr>";
                echo "<th style='width:200px'>EMAIL: </th>";
                echo "<td><input type='text' value='$email' name='email' style='border:1px solid black'></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th style='width:200px'>ADDRESS: </th>";
                echo "<td><input type='text' value='$address' name='address' style='border:1px solid black'></td>";
                echo "</tr>";
                echo "</form>";

                echo "<tr>";
                echo "<th style='width:200px'>POSITION: </th>";
                echo "<td><select name='position'>
                        <option value='manager'> Manager</option>
                        <option value='employee'> Employee</option>    
                       </select></td>";
                echo "</tr>";

                echo "<input type='submit' name='update' value='update'>";
                echo "</form>";
            }
        }
    }

    if (isset($_POST['update'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $position = mysqli_real_escape_string($conn, $_POST['position']);

        if ($position == 'manager') {
            $managerid = 1;
        } else {
            $managerid = 0;
        }



        if (empty($name) || empty($phone) || empty($email) || empty($address)) {
            echo ("<script> alert('Please Insert in the input field!'); </script>");
        }
        $sql = "UPDATE employee SET emp_name='$name',emp_email='$email',emp_phone= '$phone',emp_address='$address',emp_position='$position', manager_id='$managerid'WHERE emp_id=$id";


        if (mysqli_query($conn, $sql)) {
            echo ("<script> alert('Data Updated!!'); </script>");
            echo ("<script> window.location.replace('../nemployee.php');</script>");
            // echo $sql;
        } else {
            echo ("<script> alert('Sorry! something wrong!'); </script>");
            echo ("<script> window.location.replace('../nemployee.php');</script>");
        }
    }



    $output = '';

    if (isset($_POST['export'])) {
        if (isset($_POST['check'])) {
            $sql = "SELECT * FROM employee ORDER BY emp_id ASC";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0)
                $output .= '
        <table class="table" >  
        <tr>  
        <th> ID</th>
        <th> Name</th>
        <th> Email</th>
        <th> Phone Number</th>
        <th> Address</th>
        <th> Gender</th>
        <th> Position</th>

          

        </tr>
       ';
            while ($row = mysqli_fetch_array($result)) {
                $output .= '
            <tr>  
                <td>' . $row['emp_id'] . '</td>  
                <td>' . $row['emp_name'] . '</td>
                <td>' . $row['emp_email'] . '</td>
                <td>' . $row['emp_phone'] . '</td>
                <td>' . $row['emp_address'] . '</td>
                <td>' . $row['emp_gender'] . '</td>
                <td>' . $row['emp_position'] . '</td>
               
            </tr>';
            }
            $output .= '</table>';
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename=download.xls');
            echo $output;
        }
    }
    ?>