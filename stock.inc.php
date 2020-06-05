<?php
include "header.php";
include "include/conn.inc.php";
session_start();
if (isset($_SESSION['loggedin1']) && $_SESSION['loggedin1'] == true) {
} else {
  echo ("<script> alert('Sorry !!Panda say you are not allowed! '); </script>");
  echo ("<script> window.location.replace('sad.php');</script>");
}
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
  <title>Stock List | Home Furniture</title>
</head>

<body>
  <?php navbar(); ?>
  <div class="arrow">
    <a href="stock.php">
      <image src="img\goback.png" style="width:5%;margin-top:2%; margin-left:2%" ; height="6%" />
    </a>
  </div>
  <?php
  if(isset($_POST['update'])){
  $sid = mysqli_real_escape_string($conn, $_POST['sid']);
  $sql = "SELECT * FROM stock WHERE stk_id =$sid";
  $result = mysqli_query($conn, $sql);
  if ($rows = mysqli_fetch_array($result)) {
  ?>
    <center>
      <form method="post" action="include/update.inc.php">
        <table class="table" style="margin-left:5%; width:50%;height:20%;">
          <thead>
            <tr>
              <th>Stock ID</th>
              <th>Name</th>
              <th>Category</th>
              <th>Manufacturer</th>
              <th>Production Date</th>
              <th>Total Cost</th>
              <th>Price(Unit)</th>
              <th>Width</th>
              <th>Height</th>
              <th>Description</th>
              <th>Update</th>
            </tr>
          </thead>
          <tbody>
            <tr style="height:50%;">
              <td><?php echo "$sid"; ?><input type="text" name="sid" hidden value="<?php echo "$sid"; ?>"></td>
              <td><input type="text" name="sname" value="<?php echo $rows['stk_name'] ?>" required /></td>
              <td>
                <select name="category" name="category" style="width:100%;">
                  <option>Please Select</option>
                  <?php
                  include "include/conn.inc.php";

                  $sql = "SELECT * FROM category ";

                  $query_sql = mysqli_query($conn, $sql);

                  while ($row = mysqli_fetch_assoc($query_sql)) {
                    $category = $row['cat_name'];

                    $_SESSION['catid'] = $row['cat_id'];
                    echo "<option value='$category'>$category </option>";
                  }
                  ?>
                </select>
              </td>
              <td>
                <select name="manufacturer" name="manufacturer" style="width:100%;">
                  <option>Please Select</option>
                  <?php
                  include "include/conn.inc.php";

                  $sql = "SELECT * FROM manufacturer ";

                  $query_sql = mysqli_query($conn, $sql);

                  while ($row = mysqli_fetch_assoc($query_sql)) {
                    $manufacturer = $row['man_name'];
                    $_SESSION['manid'] = $row['man_id'];
                    echo "<option value='$manufacturer'>$manufacturer </option>";
                  }
                  ?>
                </select>
              </td>
              <td><input type="date" name="pdate" value="<?php echo $rows['stk_productiondate'] ?>" required /></td>
              <td><input type="text" name="cost" value="<?php echo $rows['stk_cost'] ?>" required /></td>
              <td><input type="text" name="price" value="<?php echo $rows['stk_price'] ?>" required /></td>
              <td><input type="text" name="width" value="<?php echo $rows['stk_width'] ?>" required /></td>
              <td><input type="text" name="height" value="<?php echo $rows['stk_height'] ?>" required /></td>
              <td><input type="text" name="descrip" value="<?php echo $rows['stk_description'] ?>" required /></td>
              <td class="add-pr">
                <input type="submit" value="UpdateStock" name="update" />
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </center>
  <?php
  } else {
    die("<script>alert('Unable to edit');window.location.href='viewstock.php'</script>");
  }
}
  ?>
</body>

</html>

<?php
if (isset($_POST['delete'])) {

  if (isset($_SESSION['loggedin1']) && $_SESSION['loggedin1'] == true && $_SESSION['role'] == 1) {
  } else {
    die("<script>alert('Sorry you are not allowed to delete');window.location.href='sad.php'</script>");
  }

  $sid = mysqli_real_escape_string($conn, $_POST['sid']);
  $sql = "DELETE FROM stock WHERE stk_id= $sid";
  if (mysqli_query($conn, $sql)) {
    echo ("<script> alert(' Deleted!'); </script>");
     echo ("<script> window.location.replace('stock.php');</script>");
  } else {
    echo ("<script> alert('Error Occur!'); </script>");
    echo $sql;
  }

  $name = "Delete Stock ";
  $eid = $_SESSION['eid'];
  $date = date("Y-m-d H-m-s");

  $sql1 = "INSERT INTO actions (emp_id, act_date, act_name, stk_id) VALUE ('$eid',' $date','$name','$sid')";
  if (mysqli_query($conn, $sql1)) {
    echo ("<script> alert('Action ADDED!!'); </script>");
    echo ("<script> window.location.replace('../stock.php');</script>");
  } else {
    echo ("<script> alert('SORRY!! SOMETHING WRONG 1'); </script>");
  }
}

?>