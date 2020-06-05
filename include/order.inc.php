<?php

include "conn.inc.php";

if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['oid']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);


    
    $sql = "UPDATE orders SET ord_status= '$status' WHERE ord_id =$id";
    if (mysqli_query($conn, $sql)) {
        echo ("<script> alert('Data Updated!!'); </script>");
        echo ("<script> window.location.replace('../orderlist.php');</script>");
        echo $id;
        echo $sql;
        echo $status;
    } else {
        echo ("<script> alert('Sorry! something wrong!'); </script>");
        
      //  echo ("<script> window.location.replace('../orderlist.php');</script>");
      echo $sql;
    }
}
if(isset($_POST['complete'])){
    $id=mysqli_real_escape_string($conn,$_POST['oid']);
    $status="Complete";

    $sql = "UPDATE orders SET ord_status= '$status' WHERE ord_id =$id";
    if (mysqli_query($conn, $sql)) {
        echo ("<script> alert('Status Updated!!'); </script>");
        echo ("<script> window.location.replace('../bought.php');</script>");

        echo $sql;
        echo $status;
    } else {
        echo ("<script> alert('Sorry! something wrong!'); </script>");
      //  echo ("<script> window.location.replace('../orderlist.php');</script>");
      echo $sql;
    }

}
$output = '';

if (isset($_POST['export'])) {
    $sql = "SELECT * FROM orders  WHERE MONTH(ord_time)=MONTH(CURRENT_DATE())";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0)
        $output .= '
        <table class="table" bordered="1px solid black">  
        <tr>  
            <th>Order ID</th>  
            <th>Customer ID</th>  
            <th>Customer Address</th>
            <th>Customer Phone Number</th>
            <th>Order Quantity</th>
            <th>Order Price</th>
            <th>Order Status</th>
            <th>Order Time</th>


        </tr>
       ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
            <tr>  
                <td>'.$row['ord_id'].'</td>  
                <td>'.$row['cus_id'].'</td>
                <td>'.$row['cus_address'].'</td>  
                <td>'.$row['cus_phone'].'</td> 
                <td>'.$row['ord_quantity'].'</td> 
                <td>'.$row['ord_price'].'</td>  
                <td>'.$row['ord_status'].'</td>
                <td>'.$row['ord_time'].'</td>
       
            </tr>';

           
    }
    $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }

?>
