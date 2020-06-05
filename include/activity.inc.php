<?php
include "conn.inc.php";
$output = '';

if (isset($_POST['export'])) {
    $sql = "SELECT actions.act_id,actions.act_name,actions.emp_id,actions.act_date,actions.stk_id,stock.stk_id,stock.stk_name, employee.emp_id, employee.emp_name FROM actions INNER JOIN stock ON actions.stk_id = stock.stk_id INNER JOIN employee ON actions.emp_id = employee.emp_id  ORDER BY act_id ASC";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0)
        $output .= '
        <table class="table" bordered="1px solid black">  
        <tr>  
            <th>Actioin ID</th>  
            <th>Employee ID</th>  
            <th>Employee Name</th>
            <th>Action Name</th>
            <th>Stock Name ID</th>
            <th>Action Date</th>
            

        </tr>
       ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
            <tr>  
                <td>'.$row['act_id'].'</td>  
                <td>'.$row['emp_id'].'</td>
                <td>'.$row['emp_name'].'</td> 
                <td>'.$row['act_name'].'</td> 
                <td>'.$row['stk_name'].'</td>  
                <td>'.$row['act_date'].'</td>
               
            </tr>';

           
    }
    $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }

?>


