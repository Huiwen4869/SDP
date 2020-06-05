<?php
include "conn.inc.php";
$output = '';

if (isset($_POST['export'])) {
    $sql = "SELECT * FROM stock ORDER BY stk_id ASC";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0)
        $output .= '
        <table class="table" bordered="1px solid black">  
        <tr>  
            <th>ID</th>  
            <th>Name</th>  
            <th>Category ID</th>
            <th>Category</th>
            <th>Manufacturer ID</th>
            <th>Manufacturer</th>
            <th>Purchase Date</th>
            <th>Purchase Cost</th>
            <th>Price</th>
            <th>Width</th>
            <th>Height</th>
            <th>Description</th>

        </tr>
       ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
            <tr>  
                <td>'.$row['stk_id'].'</td>  
                <td>'.$row['stk_name'].'</td>
                <td>'.$row['cat_id'].'</td>  
                <td>'.$row['cat_name'].'</td> 
                <td>'.$row['man_id'].'</td> 
                <td>'.$row['man_name'].'</td>  
                <td>'.$row['stk_productiondate'].'</td>
                <td>'.$row['stk_cost'].'</td>
                <td>'.$row['stk_price'].'</td>
                <td>'.$row['stk_width'].'</td>
                <td>'.$row['stk_height'].'</td>
                <td>'.$row['stk_description'].'</td>
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
