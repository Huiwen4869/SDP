<?php
include 'conn.inc.php';
session_start();
if (isset($_POST['submit'])) {
 
    $commend = mysqli_real_escape_string($conn, $_POST['fcommend']);
 
    if (isset($_SESSION['userid'])) {

        $name = $_SESSION['user'];
        $id = $_SESSION['userid'];
        //var_dump($name);
        //$_SESSION['role'] = $row['cus_role'];
        if (empty($commend)) {
            echo "command is empty!";
            //echo "<script> alert('Please fill in all the field'); </script>";
            //echo "<script> window.history.go(-1);</script>";
        } else {
            $sql = "SELECT fee_id from feedback where fee_id=? ";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo ("<script> alert('SQL error 1'); </script>");
                exit();
            } else {
                $sql1 = "INSERT INTO feedback(cus_id,cus_name,fee_comment) VALUES (?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql1)) {
                    echo ("<script> alert('SQL error 2'); </script>");
                    echo $sql1;


                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "iss", $id, $name, $commend);
                    mysqli_stmt_execute($stmt);

                    echo ("<script> alert('Feedback submitted'); </script>");
                    //echo $id.$name.$commend;
                    echo ("<script> window.location.replace('../index-cus.php');</script>");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo ("<script> window.location.replace('../cstock.php');</script>");
}




$output = '';

if (isset($_POST['export'])) {
    $sql = "SELECT * FROM feedback ORDER BY fee_id ASC";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        $output .= '
        <table class="table" bordered="1px solid black">  
        <tr>  
            <th>ID</th>  
            <th>Customer Name</th>  
            <th>Comment</th>
          

        </tr>
       ';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
            <tr>  
                <td>' . $row['fee_id'] . '</td>  
                <td>' . $row['cus_name'] . '</td>
                <td>' . $row['fee_comment'] . '</td>  
  
            </tr>';
    }
    $output .= '</table>';
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=download.xls');
    echo $output;
}
