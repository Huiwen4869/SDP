<?php
include "conn.inc.php";
$output = '';

if (isset($_POST['export'])) {
    $sql = "SELECT * FROM customer ORDER BY cus_id ASC";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0)
        $output .= '
        <table class="table" bordered="1px solid black">  
        <tr>  
        <th>Customer ID</th>
        <th>Customer Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Gender</th>
        <th>Register Date</th>

        </tr>
       ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
            <tr>  
                <td>'.$row['cus_id'].'</td>  
                <td>'.$row['cus_name'].'</td>
                <td>'.$row['cus_email'].'</td>  
                <td>'.$row['cus_address'].'</td> 
                <td>'.$row['cus_phone'].'</td> 
                <td>'.$row['cus_gender'].'</td>  
                <td>'.$row['cus_date'].'</td>
              
            </tr>';

           
    }
    $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }

?>





<?php
/*

/*
<?php
$filename = "Stock Detail Report" . date('Ymd') . ".xls";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");
$show_coloumn = false;

?>

*/
?>
